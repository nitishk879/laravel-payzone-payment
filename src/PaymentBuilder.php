<?php


namespace Svodya\Payzone;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class PaymentBuilder extends PaymentDebug{
    public $merchantid;
    public $resultdeliverymethod;
    public $transactiontype;
    public $serverresulturl;
    public $echoavs;
    public $echocv2;
    public $echothreed;
    public $echocardtype;
    public $cv2mandatory;
    public $address1mandatory;
    public $citymandatory;
    public $postcodemandatory;
    public $statemandatory;
    public $countrymandatory;
    public $paymentformsdisplaysresult;
    public $serverresulturlcookievariables;
    public $serverresulturlformvariables;
    public $serverresulturlquerystringvariables;

    public function __construct()
    {
        parent::__construct();
        $paymentHelper = new PaymentHelper;
        $paymentDebug = new PaymentDebug;

        //Global Config
        $paymentHelper->setDebugMode(config('payzone.debugMode'));
        $paymentHelper->setIntegrationMethod(config('payzone.integrationType'));//
        //Merchant Details
        $paymentHelper->setMerchantId(config('payzone.merchantId'));
        $paymentHelper->setMerchantPassword(config('payzone.merchantPass'));
        $paymentDebug->setMerchantId(config('payzone.merchantId'));
        $paymentDebug->setMerchantPassword(config('payzone.merchantPass'));
        $paymentHelper->setPresharedKey(config('payzone.merchantKey'));
        $paymentHelper->setHashMethod(config('payzone.hashMethod'));  //ALLOWS SHA1, MD5, HMACSHA1, HMACSHA256, HMACSHA512
        //Transaction settings
        $paymentHelper->setResultDeliveryMethod(config('payzone.resultDeliveryMethod')); // Allows SERVER, SERVER_PULL or POST
        $paymentHelper->setTransactionType(config('payzone.transactionType'));// Allows PREAUTH or SALE
        $paymentHelper->setCallbackUrl(config('payzone.callback_url'));
        $paymentHelper->setProcessUrl(config('payzone.process_url'));
        $paymentHelper->setServerResultUrl(config('payzone.server_result_url'));
        //Transaction Config variables
        $this->echoavs = PaymentHelper::getEchoAvs();
        $this->echocv2 = PaymentHelper::getEchoCv2();
        $this->echothreed = PaymentHelper::getEchoThreed();
        $this->echocardtype = PaymentHelper::getEchoCardType();
        $this->cv2mandatory = PaymentHelper::getCv2Mandatory();
        $this->address1mandatory = PaymentHelper::getAddress1Mandatory();
        $this->citymandatory = PaymentHelper::getCityMandatory();
        $this->postcodemandatory = PaymentHelper::getPostcodeMandatory();
        $this->statemandatory = PaymentHelper::getStateMandatory();
        $this->countrymandatory = PaymentHelper::getCountryMandatory();
        $this->serverresulturl = PaymentHelper::getServerResultUrl();
        $this->paymentformsdisplaysresult = PaymentHelper::getPaymentFormsDisplaysResult();
        $this->serverresulturlcookievariables = PaymentHelper::getServerResultUrlCookieVariables();
        $this->serverresulturlformvariables = PaymentHelper::getServerResultUrlFormVariables();
        $this->serverresulturlquerystringvariables = PaymentHelper::getServerResultUrlQueryStringVariables();
    }

    function passToMerchantSystem($transactionResult)
    {

        //THe below switch statement allows for custom handling of the transaction response, for success / decline etc
        switch ($transactionResult->getStatusCode()) {
            case config('payzone.SUCCESSFUL'): //Transaction Successful
                break;
            case config('payzone.DECLINED'): //Transaction Declined
                break;
            case config('payzone.DUPLICATE'): //Duplicate Transaction
                break;
            case config('payzone.ERROR'): //Unknown Error
            default:
                break;
        }
        return true; //return true to spoof saving to the database for merchant demo
    }
}
