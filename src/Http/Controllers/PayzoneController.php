<?php

namespace Svodya\Payzone\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Svodya\Payzone\Mail\OrderShipped;
use Svodya\Payzone\Models\Customer;
use Svodya\Payzone\Models\Order;
use Svodya\Payzone\PaymentBuilder;
use Svodya\Payzone\PaymentDebug;
use Svodya\Payzone\PaymentHelper;

class PayzoneController extends Controller
{
    public $integrationType;
    public $hashMethod;
    public $resultDeliveryMethod;
    public $transactionType;

    public function __construct()
    {
        $this->integrationType = config('payzone.integrationType');
        $this->hashMethod = config('payzone.hashMethod');
        $this->resultDeliveryMethod = config('payzone.resultDeliveryMethod');
        $this->transactionType = config('payzone.transactionType');
    }

    public function payment(Request $request)
    {
        $checkout = $request->session()->has('cart') ? $request->session()->get('cart') : '';

        if($checkout==null){
            return redirect('/')->with("error", "You don't have any product in your cart");
        }

        $order = $this->generateOrder($checkout);

        return view('Payzone::payzone', compact('order'));
    }

    public function process(Request $request)
    {

        $integrationType = $this->integrationType;
        $paymentBuilder = new PaymentBuilder;

        switch ($this->integrationType) {
            case 'hosted':
                //Generate the string to hash from the demo cart payment variables
                $stringToHash = PaymentHelper::generateStringToHash_HostedForm(
                    $request->Amount,
                    $request->CurrencyCode,
                    $request->OrderID,
                    $request->transactionType,
                    $request->TransactionDateTime,
                    $request->OrderDescription,
                    $request->CustomerName,
                    $request->Address1,
                    $request->Address2,
                    $request->Address3,
                    $request->Address4,
                    $request->City,
                    $request->State,
                    $request->PostCode,
                    $request->CountryCode
                );
                break;
            case 'transparent':
                //Generate the string to hash from the demo cart payment variables
                $stringToHash = PaymentHelper::generateStringToHash_TransparentForm(
                    $request->Amount,
                    $request->CurrencyCode,
                    $request->OrderID,
                    $request->transactionType,
                    $request->TransactionDateTime,
                    $request->OrderDescription
                );
                break;
            case 'direct':
                if(!isset($request->PaRes) && !isset($request->PaReq)) {
                    $stringToHash = PaymentHelper::generateStringToHash_DirectForm(
                        $request->Amount,
                        $request->CurrencyCode,
                        $request->OrderID,
                        $request->transactiontype,
                        $request->TransactionDateTime,
                        $request->OrderDescription
                    );
                    //Process direct API Transaction
                    $processed = PaymentHelper::processDirectTransaction($transactionResult, $errorMsg);
                    $this->newCustomer($request);

                }
                elseif(isset($request->PaRes)) {
                    $stringToHash = PaymentHelper::generateStringToHash_Direct3d($request->MD, $request->PaRes);
                    $processed = PaymentHelper::processDirect3DTransaction($transactionResult, $errorMsg, $request->MD, $request->PaRes);
                }
                else {
                    $processed = false;
                }
                break;
        }

        $HashDigest = PaymentHelper::generateHashDigest($stringToHash, config('payzone.merchantKey'), $this->hashMethod);

        $card = array(
            'echoavs' => $paymentBuilder->echoavs,
            'echocv2' => $paymentBuilder->echocv2,
            'echothreed' => $paymentBuilder->echothreed,
            'echocardtype' => $paymentBuilder->echocardtype,
            'cv2mandatory' => $paymentBuilder->cv2mandatory,
            'address1mandatory' => $paymentBuilder->address1mandatory,
            'citymandatory' => $paymentBuilder->citymandatory,
            'postcodemandatory' => $paymentBuilder->postcodemandatory,
            'statemandatory' => $paymentBuilder->statemandatory,
            'countrymandatory' => $paymentBuilder->countrymandatory,
            'resultdeliverymethod' => $paymentBuilder->resultdeliverymethod,
            'paymentformsdisplaysresult' => $paymentBuilder->paymentformsdisplaysresult,
            'serverresulturlcookievariables' => $paymentBuilder->serverresulturlcookievariables,
            'serverresulturlformvariables' => $paymentBuilder->serverresulturlformvariables,
            'serverresulturlquerystringvariables' => $paymentBuilder->serverresulturlquerystringvariables
        );

        return view('Payzone::process', compact('integrationType', 'HashDigest', 'request', 'card', 'processed', 'transactionResult'));
    }

    public function callback(Request $request)
    {
        $paymentHelper = new PaymentHelper;
        $paymentBuilder = new PaymentBuilder;

        if (isset($request->PaRes) || isset($request->PaREQ) || isset($request->StatusCode) || isset($request->CrossReference) || isset($request->DirectCallback)) {
            switch ($this->integrationType) {
                case 'hosted':
                    $validated = $paymentHelper::validateResponseHosted($_GET, $_POST, $hashdigest, $transactionresult, $errors);
                    if ($validated) {
                        //This is just a dummy function - this would usually the be merchatns CMS/ DB or Order system
                        $saved = $paymentBuilder->passToMerchantSystem($transactionresult);
                    }
                    //End of hosted
                    break;
                case 'transparent':
                    //If PaRes has been sent, then 3D secure has been processed and returned for authentication / hash checks
                    if (isset($_POST['PaRes'])) {
                        $transactiondatetime = date('Y-m-d H:i:s P');
                        $crossreference = $_POST['MD']; // MD returned is the cross reference ID
                        $pares = $_POST['PaRes'];
                        $processing = true; //manually override hash validation to send hashdigest into form for submission
                        $validated = false; //manually override hash validation to send hashdigest into form for submission
                        $stringtohash = $paymentHelper::generateStringToHash_Transparent3dSecure($crossreference, $transactiondatetime, $pares);
                        $hashdigest = $paymentHelper::generateHashDigest($stringtohash, config('payzone.merchantKey'), $hashmethod);
                        $errors = ""; //manually override hash validation to send hashdigest into form for submission
                    } else {
                        $validated = $paymentHelper::validateResponseTransparent($_POST, $hashdigest, $transactionresult, $errors);
                    }
                    if ($validated) {
                        $paymentBuilder->passToMerchantSystem($transactionresult);
                    }
                    //End of transparent
                    break;
                case 'direct':
                    $validated = $paymentHelper::validateResponseDirect($_POST, $hashdigest, $transactionresult, $errors);
                    if ($validated) {
                        $paymentBuilder->passToMerchantSystem($transactionresult);
                        $this->updateOrCreateOrder($request);
                        $request->session()->forget('cart');
                        $request->session()->flush();
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }

        return view('Payzone::callback', compact('validated', 'transactionresult', 'errors'));
    }

    public function callbackServer(Request $request){
        $paymentHelper = new PaymentHelper();
        $paymentBuilder = new PaymentBuilder;

        if ($this->resultDeliveryMethod === "SERVER") {
            if (!isset($_GET['CrossReference'])) {
                $validated = $paymentHelper::validateResponseHostedServer($_POST, $hashdigest, $transactionresult, $errors);
                $paymentHelper::Logger($_POST, "_POST");
                $paymentHelper::Logger($_GET, "_GET");
                if ($validated) {
                    $saved = $paymentBuilder->passToMerchantSystem($transactionresult);
                    $saved = true; //manually set saved status - this would typically be a response from a function to save the transaction
                    // response in the merchants system - below is an overview of some methods that provide the key information needed to
                    // record the transaction
                }
                if ($validated && $saved) {
                    //echo back the status code (0 for successfully recorded) and message to the gateway to let the gateway know that the results have been received and processed
                    echo("StatusCode=0&Message=Transaction Recorded");
                } else {
                    //if the transaction was not recorded and validated correctly, send a non 0 StatusCode to direct the gateway to show the results on the gateway
                    echo("StatusCode=5&Message=Transaction Recording Failed");
                }
            } else {
                $paymentHelper::Logger("Server Response Callback Page hit without SERVER method being set", "Hosted - SERVER ");
            }

        } else {
            $paymentHelper::Logger('error', 'Unknown Result Delivery Method selected');
        }
    }

    public function log()
    {

        $PayzoneDebug = new PaymentDebug;
        $PayzoneHelper = new PaymentHelper;

        return view('Payzone::logs', compact('PayzoneDebug', "PayzoneHelper"));
    }

    public function debug()
    {

        $PayzoneDebug = new PaymentDebug;
        $PayzoneHelper = new PaymentHelper;

        return view('Payzone::debug', compact('PayzoneDebug', "PayzoneHelper"));
    }

    /**
     * Generate New order
     * @param $order
     *
     * @return Order
     */
    public function generateOrder($order)
    {
        $description = collect($order)->flatten(1)->values()->flatten()->whereNotNull('title')->values();

        return Order::firstOrCreate([
            'total_price' => $order->totalPrice,
            'order_details' => $description->implode('title', ', '),
        ],
            [
                'order_status' => 'process',
                'order_price' => $order->totalPrice*100,
                'order_type' => 'buy',
                'total_price' => $order->totalPrice,
                'order_details' => $description->implode('title', ', '),
                'cross_reference' => 'cross_reference',
                'customer_id' => 1
            ]);
    }

    /**
     * Add new Customer
     * @param $customer
     * @return Customer
    */
    public function newCustomer($customer)
    {
        $firstName = strstr($customer->CustomerName, ' ', true) ?? null;
        $lastName = strstr($customer->CustomerName, ' ', false) ?? null;
        return Customer::firstOrCreate([
            'first_name' => $firstName,
            'address_line_1' => $customer->Address1,
        ],
            [
                'first_name' => $firstName ?? $customer->CustomerName,
                'last_name' => $lastName ?? null,
                'email' => $customer->Email ?? null,
                'phone' => $customer->Phone ?? null,
                'address_line_1' => $customer->Address1,
                'address_line_2' => $customer->Address2,
                'city' => $customer->City,
                'county' => $customer->State,
                'postal_code' => $customer->PostCode,
                'country' => $customer->CountryCode,
                'payment_method'    => $customer->Direct ?? 'direct'
            ]);
    }

    /**
     * Add or Update Order
     * @param $result
     *
    */
    public function updateOrCreateOrder($result){

        Order::updateOrCreate([
            'id' => $result->OrderID
        ],
            [
                'cross_reference' => $result->CrossReference,
                'total_price' => $result->Amount/100,
                'order_status' => $result->StatusCode
            ]);

        $order = Order::find($result->OrderID);

        Mail::to(config('mail.from.address'))->send(new OrderShipped($order));

//        event(new OrderShipped($order));
    }
}
