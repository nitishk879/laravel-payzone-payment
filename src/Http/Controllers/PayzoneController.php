<?php

namespace Svodya\Payzone\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Svodya\Payzone\Events\OrderShipped;
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

        if($checkout!=null){
            $this->generateOrder($checkout);
            $order = Order::latest()->first();
            event(new OrderShipped($order));
        }

        $integrationType = $this->integrationType;
        $transactionType = $this->transactionType;

        return view('Payzone::payzone', compact('integrationType', 'transactionType', 'checkout', 'order'));
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
                    //Generate the string to hash from the demo cart payment variables
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
                elseif (isset($request->PaRes)) {
                    $stringToHash = PaymentHelper::generateStringToHash_Direct3d($_POST['MD'], $_POST['PaRes']);
                    $processed = PaymentHelper::processDirect3DTransaction($transactionResult, $errorMsg, $_POST['MD'], $_POST['PaRes']);
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
                        //validate the transaction and passes back the $hashdigest for further checks, $transactionresult object and $errors
                        //validate also returns a boolean response - true for validated, false for error
                        $validated = $paymentHelper::validateResponseTransparent($_POST, $hashdigest, $transactionresult, $errors);
                    }
                    if ($validated) {
                        //This is just a dummy function - this would usually the be merchatns CMS/ DB or Order system
                        $saved = $paymentBuilder->passToMerchantSystem($transactionresult);
                    }
                    //End of transparent
                    break;
                case 'direct':
                    $validated = $paymentHelper::validateResponseDirect($_POST, $hashdigest, $transactionresult, $errors);
                    if ($validated) {
                        $saved = $paymentBuilder->passToMerchantSystem($transactionresult);
                        $this->updateOrCreateOrder($transactionresult);
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }

        return view('Payzone::callback', compact('validated', 'transactionresult', 'errors'));
    }

    public function callbackServer(Request $request)
    {
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

    public function generateOrder($checkout)
    {
        $lastOrder  = Order::latest()->firstOrFail();

        $description = collect($checkout)->flatten(1)->values()->flatten()->whereNotNull('title')->values();

        return Order::firstOrCreate([
            'amount' => $checkout->totalPrice,
            'product_detail' => $description->implode('title', ', '),
        ],
            [
                'order_id' => $lastOrder->id + 1,
                'cross_reference' => 'cross_reference',
                'product_detail' => $description->implode('title', ', '),
                'amount' => $checkout->totalPrice,
                'status_code' => '',
                'currency_code' => config('payzone.currencyCode')
            ]);
    }

    public function newCustomer($request)
    {
        /**
         * "CustomerName":"Geoff Wayne","Address1":"113 Broad Street West","Address2":null,"Address3":null,"Address4":null,
         * "City":"Oldpine","State":"Strongbarrow","PostCode":"SB42 1SX","CountryCode":"826",
         * "CardName":"Geoff Wayne","CardNumber":"4976350000006891","CV2":"341","ExpiryDateMonth":"1","ExpiryDateYear":"25"}
        */
        return Customer::firstOrCreate([
            'name' => $request->CustomerName,
            'address' => $request->Address1,
        ],
            [
                'name' => $request->CustomerName,
                'city' => $request->City,
                'address' => $request->Address1,
                'state' => $request->State,
                'postcode' => $request->PostCode,
                'country' => $request->CountryCode,
            ]);
    }

    public function updateOrCreateOrder($result){
        return Order::updateOrCreate([
            'order_id' => $result->OrderID
        ],
            [
                'order_id' => $result->OrderID,
                'cross_reference' => $result->CrossReference,
                'product_detail' => $result->OrderDescription,
                'amount' => $result->Amount,
                'status_code' => $result->Amount
            ]);
    }
}
