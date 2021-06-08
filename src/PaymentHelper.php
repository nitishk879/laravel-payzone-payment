<?php


namespace Svodya\Payzone;


class PaymentHelper
{

    #region class variables
    /**
    Declare class variables
     */
    //Global Config
    private static $debug_mode;
    private static $integrationmethod;

    //Merchant Details
    private static $merchantid;
    private static $merchantpassword;
    private static $presharedkey;
    private static $hashmethod;

    //URLS
    private static $paymentformresulthandler;
    private static $serverresulturl;
    private static $callbackurl;
    private static $processurl;

    //Transaction settings
    private static $resultdeliverymethod;
    private static $transactiontype;

    //Hosted Payment form Config Settings
    private static $echoavs;
    private static $echocv2;
    private static $echothreed;
    private static $echocardtype;
    private static $cv2mandatory;
    private static $address1mandatory;
    private static $citymandatory;
    private static $postcodemandatory;
    private static $statemandatory;
    private static $countrymandatory;
    private static $paymentformsdisplaysresult;
    private static $serverresulturlformvariables;
    private static $serverresulturlcookievariables;
    private static $serverresulturlquerystringvariables;
    #endregion

    #region __construct
    public function __construct()
    {

        /**
        Set values for class variables
         */

        // urls and handlers
        self::$paymentformresulthandler = "https://mms.payzoneonlinepayments.com/Pages/PublicPages/PaymentFormResultHandler.ashx";
        // self::$serverresulturl          = self::getSiteUrl()."/callback.php";
        //self::$callbackurl              = self::getSiteUrl()."/callback.php";

        //Hosted Payment form Config Settings
        self::$echoavs                             = 'true';
        self::$echocv2                             = 'true';
        self::$echothreed                          = 'true';
        self::$echocardtype                        = 'true';
        self::$cv2mandatory                        = 'true';
        self::$address1mandatory                   = 'true';
        self::$citymandatory                       = 'true';
        self::$postcodemandatory                   = 'true';
        self::$statemandatory                      = 'true';
        self::$countrymandatory                    = 'true';
        self::$paymentformsdisplaysresult          = 'false';
        self::$serverresulturlformvariables        = "";
        self::$serverresulturlcookievariables      = "";
        self::$serverresulturlquerystringvariables = "";
    }
    #endregion

    #region getter / setters
    /**
    Getter functions for class variables
     */

    //Global Config
    public static function getDebugMode()
    {
        return self::$debug_mode;
    }
    public function setDebugMode($debug_mode)
    {
        self::$debug_mode = $debug_mode;
    }

    public static function getIntegrationMethod()
    {
        return self::$integrationmethod;
    }
    public function setIntegrationMethod($integrationmethod)
    {
        self::$integrationmethod = $integrationmethod;
    }

    //Merchant Details

    public static function getMerchantId()
    {
        return self::$merchantid;
    }
    public function setMerchantId($mid)
    {
        self::$merchantid = $mid;
    }
    public static function getMerchantPassword()
    {
        return self::$merchantpassword;
    }
    public function setMerchantPassword($merchantpassword)
    {
        self::$merchantpassword = $merchantpassword;
    }
    public static function getPresharedKey()
    {
        return self::$presharedkey;
    }
    public function setPresharedKey($presharedkey)
    {
        self::$presharedkey = $presharedkey;
    }
    public static function getHashMethod()
    {
        return self::$hashmethod;
    }
    public function setHashMethod($hashmethod)
    {
        self::$hashmethod = $hashmethod;
    }

    //URLS
    public static function getServerResultUrl()
    {
        return self::$serverresulturl;
    }
    public function setServerResultUrl($serverresulturl)
    {
        self::$serverresulturl = $serverresulturl;
    }
    public static function getCallbackUrl()
    {
        return self::$callbackurl;
    }
    public function setCallbackUrl($callbackurl)
    {
        self::$callbackurl = $callbackurl;
    }
    public static function getProcessUrl()
    {
        return self::$processurl;
    }
    public function setProcessUrl($processurl)
    {
        self::$processurl = $processurl;
    }
    public static function getPaymentFormResultHandler()
    {
        return self::$paymentformresulthandler;
    }
    public function setPaymentFormResultHandler($paymentformresulthandler)
    {
        self::$paymentformresulthandler = $paymentformresulthandler;
    }

    //Transaction settings
    public static function getResultDeliveryMethod()
    {
        return self::$resultdeliverymethod;
    }
    public function setResultDeliveryMethod($resultdeliverymethod)
    {
        self::$resultdeliverymethod = $resultdeliverymethod;
    }
    public static function getTransactionType()
    {
        return self::$transactiontype;
    }
    public function setTransactionType($transactiontype)
    {
        self::$transactiontype = $transactiontype;
    }

    //Hosted Payment form Config Settings
    public static function getEchoAvs()
    {
        return self::$echoavs;
    }
    public static function getEchoCv2()
    {
        return self::$echocv2;
    }
    public static function getEchoThreed()
    {
        return self::$echothreed;
    }
    public static function getEchoCardType()
    {
        return self::$echocardtype;
    }
    public static function getCv2Mandatory()
    {
        return self::$cv2mandatory;
    }
    public static function getAddress1Mandatory()
    {
        return self::$address1mandatory;
    }
    public static function getCityMandatory()
    {
        return self::$citymandatory;
    }
    public static function getPostcodeMandatory()
    {
        return self::$postcodemandatory;
    }
    public static function getStateMandatory()
    {
        return self::$statemandatory;
    }
    public static function getCountryMandatory()
    {
        return self::$countrymandatory;
    }
    public static function getPaymentFormsDisplaysResult()
    {
        return self::$paymentformsdisplaysresult;
    }
    public static function getServerResultUrlFormVariables()
    {
        return self::$serverresulturlformvariables;
    }
    public static function getServerResultUrlCookieVariables()
    {
        return self::$serverresulturlcookievariables;
    }
    public static function getServerResultUrlQueryStringVariables()
    {
        return self::$serverresulturlquerystringvariables;
    }

    #endregion

    #region Payzone logging
    /**
    Payzone Logger Function - for information and debugging
     * @method Logger
     * @param  [String]       $type = 'info' or 'debug'
     * @param  [Object][Array][String] $data
     * @return none
     */
    public static function Logger($data, $desc)
    {
        $log_location = storage_path("/logs/payzone.log");
        if (self::getDebugMode()) {
            $datetime = date('Y-m-d H:i:s');
            $trace    = debug_backtrace();
            error_log("{$datetime} ~ {$trace[0]['file']} | {$trace[0]['line']} " . "\n", 3, $log_location);
            error_log(print_r('Debug - ' . $desc, true) . "\n", 3, $log_location);
            error_log(print_r($data, true) . "\n", 3, $log_location);
        }
    }

    #endregion

    #region hashing functions

    /**
    Generate Hash Function - for information and debugging
     * @method generateHashDigest
     * @param  [String] - $StringToHash - string to be hashed and sent to gateway
     * @param  [String] - $key - PreSharedKey from gateway
     * @param  [String] - $hashmethod - Hash Method option as defined in the MMS
     * @return [String] - $hash - hashed payment object
     */
    public static function generateHashDigest($stringtohash, $key, $hashmethod)
    {
        switch ($hashmethod) {
            case "MD5":
                $hash = md5("PreSharedKey=$key&$stringtohash");
                break;
            case "SHA1":
                $hash = sha1("PreSharedKey=$key&$stringtohash");
                break;
            case "HMACMD5":
                $hash = hash_hmac("md5", $stringtohash, $key);
                break;
            case "HMACSHA1":
                $hash = hash_hmac("sha1", $stringtohash, $key);
                break;
            case "HMACSHA256":
                $hash = hash_hmac("sha256", $stringtohash, $key);
                break;
            case "HMACSHA512":
                $hash = hash_hmac("sha512", $stringtohash, $key);
                break;
        }
        self::Logger($hash, 'generateHashDigest - $hash');
        return ($hash);
    }

    /**
    Generate Hosted Payment Form Hash String Function - for information and debugging
     * @method generateStringToHash_HostedForm
     * @param  [String] - $amt,$currencycode,$orderid,$transactiontype,$transactiondatetime,$callbackurl,$orderdesc,$customername,$address1,$address2,$address3,$address4,$city,$state,$postcode,$countrycode - varaiables to pass into string for hashing
     * @return [String] - $stringtohash - string payment object
     */
    public static function generateStringToHash_HostedForm($amt, $currencycode, $orderid, $transactiontype, $transactiondatetime, $orderdesc, $customername, $address1, $address2, $address3, $address4, $city, $state, $postcode, $countrycode)
    {
        $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&Amount=$amt&CurrencyCode=$currencycode&EchoAVSCheckResult=" . self::$echoavs . "&EchoCV2CheckResult=" . self::$echocv2 . "&EchoThreeDSecureAuthenticationCheckResult=" . self::$echothreed . "&EchoCardType=" . self::$echocardtype . "&OrderID=$orderid&TransactionType=$transactiontype&TransactionDateTime=$transactiondatetime&CallbackURL=" . self::$callbackurl . "&OrderDescription=$orderdesc&CustomerName=$customername&Address1=$address1&Address2=$address2&Address3=$address3&Address4=$address4&City=$city&State=$state&PostCode=$postcode&CountryCode=$countrycode&CV2Mandatory=" . self::$cv2mandatory . "&Address1Mandatory=" . self::$address1mandatory . "&CityMandatory=" . self::$citymandatory . "&PostCodeMandatory=" . self::$postcodemandatory . "&StateMandatory=" . self::$statemandatory . "&CountryMandatory=" . self::$countrymandatory . "&ResultDeliveryMethod=" . self::$resultdeliverymethod . "&ServerResultURL=" . self::$serverresulturl . "&PaymentFormDisplaysResult=" . self::$paymentformsdisplaysresult . "&ServerResultURLCookieVariables=" . self::$serverresulturlcookievariables . "&ServerResultURLFormVariables=" . self::$serverresulturlformvariables . "&ServerResultURLQueryStringVariables=" . self::$serverresulturlquerystringvariables;
        self::Logger($stringtohash, 'generateStringToHash_HostedForm - $stringtohash');
        return ($stringtohash);
    }

    /**
    Generate Transparent Payment Form Hash String Function - for information and debugging
     * @method generateStringToHash_TransparentForm
     * @param  [String] - $amt,$currencycode,$orderid,$transactiontype,$transactiondatetime,,$orderdesc- variables to pass into string for hashing
     * @return [String] - $stringtohash - string payment object
     */
    public static function generateStringToHash_TransparentForm($amt, $currencycode, $orderid, $transactiontype, $transactiondatetime, $orderdesc)
    {
        $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&Amount=$amt&CurrencyCode=$currencycode&EchoAVSCheckResult=" . self::$echoavs . "&EchoCV2CheckResult=" . self::$echocv2 . "&EchoThreeDSecureAuthenticationCheckResult=" . self::$echothreed . "&EchoCardType=" . self::$echocardtype . "&OrderID=$orderid&TransactionType=$transactiontype&TransactionDateTime=$transactiondatetime&CallbackURL=" . self::$callbackurl . "&OrderDescription=$orderdesc";
        self::Logger($stringtohash, 'generateStringToHash_TransparentForm - $stringtohash');
        return ($stringtohash);
    }

    /**
    Generate Transparent Payment Form Hash String Function - for information and debugging
     * @method generateStringToHash_Transparent3dSecure
     * @param  [String] -$crossreference, $transactiondatetime, $pares - varaiables to pass into string for hashing
     * @return [String] - $stringtohash - string payment object
     */
    public static function generateStringToHash_Transparent3dSecure($crossreference, $transactiondatetime, $pares)
    {
        $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&CrossReference=" . $crossreference . "&TransactionDateTime=" . $transactiondatetime . "&CallbackURL=" . self::getCallbackUrl() . "&PaRES=" . $pares;
        self::Logger($stringtohash, 'generateStringToHash_Transparent3dSecure - $stringtohash');
        return ($stringtohash);
    }


    /**
     * Generate Direct API Payment Form Hash String Function - for information and debugging
     * @method generateStringToHash_DirectForm
     * @param  [String] - $amt, $currencycode, $orderid,$transactiontype,$transactiondatetime, $orderdesc- variables to pass into string for hashing
     * @return [String] - $stringtohash - string payment object
     */
    public static function generateStringToHash_DirectForm($amt, $currencycode, $orderid, $transactiontype, $transactiondatetime, $orderdesc)
    {

        $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&Amount=$amt&CurrencyCode=$currencycode&OrderID=$orderid&OrderDescription=$orderdesc&TransactionDateTime=$transactiondatetime";
        self::Logger($stringtohash, 'generateStringToHash_DirectForm - $stringtohash');
        $HashDigest = self::generateHashDigest($stringtohash, self::$presharedkey, self::$hashmethod);
        $_SESSION['HashDigest'] = $HashDigest;
        return ($stringtohash);
    }

    /**
    Generate Direct API 3d Hash String Function - for information and debugging
     * @method generateStringToHash_Direct3d
     * @param  [String] - $md,$pares - variables to pass into string for hashing
     * @return [String] - $stringtohash - string payment object
     */
    public static function generateStringToHash_Direct3d($md, $pares)
    {
        $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&MD=$md&PaRes=$pares";
        self::Logger($stringtohash, 'generateStringToHash_Direct3d - $stringtohash');
        return ($stringtohash);
    }

    #endregion

    #region validation functions

    /**
    Validate POST response from Hosted Payment Form
     * @method validateResponseHosted
     * @param  [Array] - POST variables from gateway response
     * @param  [Array] - GET variables from gateway response
     * @param  [Empty] - $hashdigest - variable by reference for return
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @param  [Empty] - $errors - variable by reference for return
     * @return [String] - &$hashdigest - variable by reference for hash digest
     * @return [Object] - &$transactionresult - object by reference for transaction results
     * @return [Object] - &$errors - object by reference for errors
     * @return [Boolean] - False on error
     */
    public static function validateResponseHosted($get, $post, &$hashdigest, &$transactionresult, &$errors)
    {
        $gw = (self::$resultdeliverymethod === 'POST') ? $post : $get;
        $errorOccured = false;
        $errors       = array();
        switch (self::$resultdeliverymethod) {
            case 'POST':
                self::Logger($post, 'validateResponseHosted - $POST ARRAY - ');
                $gw = $post;
                //Generate the string to hash - ensuring fields sent back from gateway match expected values
                if (isset($gw['StatusCode']) && isset($gw['CrossReference']) && isset($gw['Message'])) {
                    $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&StatusCode=" . $gw['StatusCode'] . "&Message=" . $gw['Message'] . "&PreviousStatusCode=" . $gw['PreviousStatusCode'] . "&PreviousMessage=" . $gw['PreviousMessage'] . "&CrossReference=" . $gw['CrossReference'] . "&AddressNumericCheckResult=" . $gw['AddressNumericCheckResult'] . "&PostCodeCheckResult=" . $gw['PostCodeCheckResult'] . "&CV2CheckResult=" . $gw['CV2CheckResult'] . "&ThreeDSecureAuthenticationCheckResult=" . $gw['ThreeDSecureAuthenticationCheckResult'] . "&CardType=" . $gw['CardType'] . "&CardClass=" . $gw['CardClass'] . "&CardIssuer=" . $gw['CardIssuer'] . "&CardIssuerCountryCode=" . $gw['CardIssuerCountryCode'] . "&Amount=" . $gw['Amount'] . "&CurrencyCode=" . $gw['CurrencyCode'] . "&OrderID=" . $gw['OrderID'] . "&TransactionType=" . $gw['TransactionType'] . "&TransactionDateTime=" . $gw['TransactionDateTime'] . "&OrderDescription=" . $gw['OrderDescription'] . "&CustomerName=" . $gw['CustomerName'] . "&Address1=" . $gw['Address1'] . "&Address2=" . $gw['Address2'] . "&Address3=" . $gw['Address3'] . "&Address4=" . $gw['Address4'] . "&City=" . $gw['City'] . "&State=" . $gw['State'] . "&PostCode=" . $gw['PostCode'] . "&CountryCode=" . $gw['CountryCode'] . "";
                } else {
                    $errorOccured = true;
                    array_push($errors, "Expected variables not received");
                }
                break;
            case 'SERVER':
            case 'SERVER_PULL':
                $gw = $get;
                if (isset($gw['CrossReference'])) {
                    //Generate the string to hash - ensuring fields sent back from gateway match expected values
                    $stringtohash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&CrossReference=" . $gw['CrossReference'] . "&OrderID=" . $gw['OrderID'] . "";
                } else {
                    $errorOccured = true;
                    array_push($errors, "Expected variables not received");
                }
                break;
            default:
                $errorOccured = true;
                array_push($errors, "Unknown result delivery method selected");
                break;
        }
        if (isset($stringtohash)) {
            //Make sure that the stringtohash has been set, if this is not set it is most likely due to a setting change mid transaction
            self::Logger($stringtohash, 'validateResponseHosted - $stringtohash - ' . self::$resultdeliverymethod);
            $hashdigest   = self::generateHashDigest($stringtohash, self::$presharedkey, self::$hashmethod);
            if ($hashdigest !== $gw["HashDigest"]) {
                $errorOccured = true;
                array_push($errors, "HashDigest does not match expected response");
            } else { //Pull the result variables from the payment form handler
                if (self::$resultdeliverymethod === "SERVER_PULL") {
                    if (self::getTransactionResultFromPaymentFormHandler($gw['CrossReference'], $transactionresult)) { //$transactionresult is passed by reference down into the payment form handler, and is updated with the full transaction response
                        $errorOccured = false;
                    } else { //Error occured getting payment response from getTransactionResultFromPaymentFormHandler
                        $errorOccured = true;
                        array_push($errors, "Error occured getting the payment response from getTransactionResultFromPaymentFormHandler");
                    }
                } else {
                    self::createTransactionResultObject($gw, $transactionresult);
                }
            }
        }
        return !$errorOccured;
    }

    /**
    Validate POST response from Hosted Gateway - Server
     * @method validateResponseHostedServer
     * @param  [Array] - POST variables from gateway response
     * @param  [Empty] - $hashdigest - variable by reference for return
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @param  [Empty] - $errors - variable by reference for return
     * @return [String] - &$hashdigest - variable by reference for hash digest
     * @return [Object] - &$transactionresult - object by reference for transaction results
     * @return [Object] - &$errors - object by reference for errors
     * @return [Boolean] - False on error
     */
    public static function validateResponseHostedServer($gw, &$hashdigest, &$transactionresult, &$errors)
    {
        $errorOccured = false;
        $errors       = array();
        //Generate the string to hash - ensuring fields sent back from gateway match expected values
        $StringToHash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&StatusCode=0&Message=" . $gw['Message'] . "&PreviousStatusCode=" . $gw['PreviousStatusCode'] . "&PreviousMessage=" . $gw['PreviousMessage'] . "&CrossReference=" . $gw['CrossReference'] . "&AddressNumericCheckResult=" . $gw['AddressNumericCheckResult'] . "&PostCodeCheckResult=" . $gw['PostCodeCheckResult'] . "&CV2CheckResult=" . $gw['CV2CheckResult'] . "&ThreeDSecureAuthenticationCheckResult=" . $gw['ThreeDSecureAuthenticationCheckResult'] . "&CardType=" . $gw['CardType'] . "&CardClass=" . $gw['CardClass'] . "&CardIssuer=" . $gw['CardIssuer'] . "&CardIssuerCountryCode=" . $gw['CardIssuerCountryCode'] . "&Amount=" . $gw['Amount'] . "&CurrencyCode=" . $gw['CurrencyCode'] . "&OrderID=" . $gw['OrderID'] . "&TransactionType=" . $gw['TransactionType'] . "&TransactionDateTime=" . $gw['TransactionDateTime'] . "&OrderDescription=" . $gw['OrderDescription'] . "&CustomerName=" . $gw['CustomerName'] . "&Address1=" . $gw['Address1'] . "&Address2=" . $gw['Address2'] . "&Address3=" . $gw['Address3'] . "&Address4=" . $gw['Address4'] . "&City=" . $gw['City'] . "&State=" . $gw['State'] . "&PostCode=" . $gw['PostCode'] . "&CountryCode=" . $gw['CountryCode'] . "";
        $hashdigest   = self::generateHashDigest($StringToHash, self::$presharedkey, self::$hashmethod);
        if ($hashdigest !== $gw["HashDigest"] && $gw['StatusCode'] === 0) {
            $errorOccured = true;
            array_push($errors, "HashDigest does not match expected response");
        }

        self::createTransactionResultObject($gw, $transactionresult);
        self::Logger($gw, "\$_POST object - from Hosted - SERVER ");
        self::Logger($transactionresult, "\$transactionresult object - from Hosted - SERVER ");
        self::Logger($errors, "\$errors object - from Hosted - SERVER ");
        return !$errorOccured;
    }



    /**
    Validate POST response from Transparent Gateway
     * @method validateResponseTransparent
     * @param  [Array] - POST variables from gateway response
     * @param  [Empty] - $hashdigest - variable by reference for return
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @param  [Empty] - $errors - variable by reference for return
     * @return [String] - &$hashdigest - variable by reference for hash digest
     * @return [Object] - &$transactionresult - object by reference for transaction results
     * @return [Object] - &$errors - object by reference for errors
     * @return [Boolean] - False on error
     */
    public static function validateResponseTransparent($gw, &$hashdigest, &$transactionresult, &$errors)
    {
        $errorOccured     = false;
        $errors           = array();
        //Check whether 3d secure has been request or whether the results will need to be presented
        $transparentStage = ((isset($gw['PaREQ'])) ? "threeDSecureRequiredAuthentication" : "transactionResult");
        switch ($transparentStage) {
            case 'threeDSecureRequiredAuthentication':
                //Generate the string to hash - ensuring fields sent back from gateway match expected values
                $StringToHash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&StatusCode=" . $gw['StatusCode'] . "&Message=" . $gw['Message'] . "&CrossReference=" . $gw['CrossReference'] . "&OrderID=" . $gw['OrderID'] . "&TransactionDateTime=" . $gw['TransactionDateTime'] . "&ACSURL=" . $gw['ACSURL'] . "&PaREQ=" . $gw['PaREQ'];
                $hashdigest = self::generateHashDigest($StringToHash, self::$presharedkey, self::$hashmethod);
                break;
            case 'transactionResult':
                //Generate the string to hash - ensuring fields sent back from gateway match expected values
                $StringToHash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&StatusCode=" . $gw['StatusCode'] . "&Message=" . $gw['Message'] . "&PreviousStatusCode=" . $gw['PreviousStatusCode'] . "&PreviousMessage=" . $gw['PreviousMessage'] . "&CrossReference=" . $gw['CrossReference'] . "&AddressNumericCheckResult=" . $gw['AddressNumericCheckResult'] . "&PostCodeCheckResult=" . $gw['PostCodeCheckResult'] . "&CV2CheckResult=" . $gw['CV2CheckResult'] . "&ThreeDSecureAuthenticationCheckResult=" . $gw['ThreeDSecureAuthenticationCheckResult'] . "&CardType=" . $gw['CardType'] . "&CardClass=" . $gw['CardClass'] . "&CardIssuer=" . $gw['CardIssuer'] . "&CardIssuerCountryCode=" . $gw['CardIssuerCountryCode'] . "&Amount=" . $gw['Amount'] . "&CurrencyCode=" . $gw['CurrencyCode'] . "&OrderID=" . $gw['OrderID'] . "&TransactionType=" . $gw['TransactionType'] . "&TransactionDateTime=" . $gw['TransactionDateTime'] . "&OrderDescription=" . $gw['OrderDescription'] . "&Address1=" . $gw['Address1'] . "&Address2=" . $gw['Address2'] . "&Address3=" . $gw['Address3'] . "&Address4=" . $gw['Address4'] . "&City=" . $gw['City'] . "&State=" . $gw['State'] . "&PostCode=" . $gw['PostCode'] . "&CountryCode=" . $gw['CountryCode'] . "&EmailAddress=" . $gw['EmailAddress'] . "&PhoneNumber=" . $gw['PhoneNumber'];
                $hashdigest = self::generateHashDigest($StringToHash, self::$presharedkey, self::$hashmethod);
                break;
        }


        if ($hashdigest !== $gw["HashDigest"]) {
            $errorOccured = true;
            array_push($errors, "HashDigest does not match expected response");
        }

        self::createTransactionResultObject($gw, $transactionresult);
        self::Logger($transactionresult, "\$transactionresult object - from Transparent ");
        return !$errorOccured;
    }

    /**
    Validate POST response from Direct
     * @method validateResponseDirect
     * @param  [Array] - POST variables from gateway response
     * @param  [Empty] - $hashdigest - variable by reference for return
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @param  [Empty] - $errors - variable by reference for return
     * @return [String] - &$hashdigest - variable by reference for hash digest
     * @return [Object] - &$transactionresult - object by reference for transaction results
     * @return [Object] - &$errors - object by reference for errors
     * @return [Boolean] - False on error
     */
    public static function validateResponseDirect($gw, &$hashdigest, &$transactionresult, &$errors)
    {
        $errorOccured = false;
        $errors       = array();
        extract($gw);
        //Generate the string to hash - ensuring fields sent back from gateway match expected values
        $StringToHash = "MerchantID=" . self::$merchantid . "&Password=" . self::$merchantpassword . "&Amount=$Amount&CurrencyCode=$CurrencyCode&OrderID=$OrderID&OrderDescription=$OrderDescription&TransactionDateTime=$TransactionDateTime";
        $hashdigest   = self::generateHashDigest($StringToHash, self::$presharedkey, self::$hashmethod);
        if ($hashdigest !== $_SESSION['HashDigest']) {
            $errorOccured = true;
            array_push($errors, "HashDigest does not match expected response");
        }

        self::createTransactionResultObject($gw, $transactionresult);
        self::Logger($gw, "\$_POST object - from Direct ");
        self::Logger($transactionresult, "\$transactionresult object - from Direct ");
        self::Logger($errors, "\$errors object - from Direct ");

        unset($_SESSION['tp_order_id']);
        unset($_SESSION['tp_order_desc']);
        unset($_SESSION['tp_order_amount']);
        unset($_SESSION['tp_order_type']);
        unset($_SESSION['tp_order_currencycode']);
        unset($_SESSION['tp_order_transactiondatetime']);

        return !$errorOccured;
    }


    #endregion

    #region curl / api handling

    /**
    getTransactionResultFromPaymentFormHandler Access payment form handler to retrieve results
     * @method getTransactionResultFromPaymentFormHandler
     * @param  [String]                                     $CrossReference
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @return [Object] - $transactionresult - variable by reference for return
     * @return [Boolean] - False on error
     */
    public static function getTransactionResultFromPaymentFormHandler($CrossReference, &$TransactionResult)
    {
        $errorOccured = false;
        $errorMsg     = array();
        try {
            // use curl to post the cross reference to the
            // payment form to query its status
            $cCURL = curl_init();

            // build up the post string
            $PostString = "MerchantID=" . urlencode(self::$merchantid) . "&Password=" . urlencode(self::$merchantpassword) . "&CrossReference=" . urlencode($CrossReference);
            curl_setopt($cCURL, CURLOPT_URL, self::$paymentformresulthandler);
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $PostString);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            //check if a certificate list is specified in the php.ini file, otherwise use the bundled one
            $caInfoSetting = ini_get("curl.cainfo");
            if (empty($caInfoSetting)) {
                curl_setopt($cCURL, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
            }
            // read the response
            $curlResponse = curl_exec($cCURL);
            $errorno      = curl_errno($cCURL);
            $errormsg     = curl_error($cCURL);
            $headerinfo   = curl_getinfo($cCURL);
            curl_close($cCURL); //close curl connection
            if ($curlResponse === "" || !$curlResponse) {
                $errorOccured = true;
                array_push($errorMsg, "Received empty response from payment response handler");
                self::Logger($errormsg, 'curlError');
            } else {
                //Process Succesful Curl Response
                $curlResponse = self::parseResponseStringToArray($curlResponse, true);
                if (!isset($curlResponse["Message"]) || !isset($curlResponse["StatusCode"]) || !isset($curlResponse["TransactionResult"])) {
                    $errorOccured = true;
                    array_push($errorMsg, "Response received from Payment Response handler is not in the expected format");
                } else {
                    $transactionResultArray = self::parseResponseStringToArray($curlResponse["TransactionResult"], true);
                    self::Logger($transactionResultArray, 'Transaction Result');

                    self::createTransactionResultObject($transactionResultArray, $TransactionResult);
                    self::Logger($TransactionResult, 'Transaction Result');
                }
            }
        } catch (Exception $e) {
            $errorOccured = true;
            array_push($errorMsg, "Unknown error in getTransactionResultFromPaymentFormHandler");
            $PayzoneHelper::Logger($e, 'getTransactionResultFromPaymentFormHandler', 'error');
        }
        if ($errorOccured) {
            self::Logger($errorMsg, 'getTransactionResultFromPaymentFormHandler - Errors');
        }
        return !$errorOccured;
    }

    /**
    Process Direct API payment request
     * @method processDirectTransaction
     * @param  [String] -
     * @return [boolean] - false if transaction did not process correctly
     */
    public static function processDirectTransaction(&$transactionResult, &$errorMsg)
    {

        $_SESSION['tp_order_id']=$_POST['OrderID'];
        $_SESSION['tp_order_desc']=$_POST['OrderDescription'];
        $_SESSION['tp_order_amount']=$_POST['Amount'];
        $_SESSION['tp_order_type']=$_POST['TransactionType'];
        $_SESSION['tp_order_currencycode']=$_POST['CurrencyCode'];
        $_SESSION['tp_order_transactiondatetime']=$_POST['TransactionDateTime'];
        $soapenv =self::soapEnvelope_DirectProcess($_POST['Amount'], $_POST['CurrencyCode'], $_POST['TransactionType'], $_POST['OrderID'], $_POST['OrderDescription'], $_POST['CardName'], $_POST['CV2'], $_POST['CardNumber'], $_POST['ExpiryDateMonth'], $_POST['ExpiryDateYear'], isset($_POST['StartDateMonth']) ? $_POST['StartDateMonth'] : "", isset($_POST['StartDateYear']) ? $_POST['StartDateYear'] : "", $_POST['Address1'], $_POST['Address2'], $_POST['Address3'], $_POST['Address4'], $_POST['City'], $_POST['State'], $_POST['PostCode']);
        $orderarray= array("Amount" => $_POST["Amount"],"CurrencyCode" => $_POST["CurrencyCode"],"TransactionType" => $_POST["TransactionType"],"OrderID" => $_POST["OrderID"],"OrderDescription" => $_POST["OrderDescription"],"Address1" => $_POST["Address1"],"Address2" => $_POST["Address2"],"Address3" => $_POST["Address3"],"Address4" => $_POST["Address4"],"City" => $_POST["City"],"State" => $_POST["State"],"PostCode" => $_POST["PostCode"],);

        $errorOccured = false;
        $errorMsg     = array();
        try {
            // use curl to post the cross reference to the
            // payment form to query its status
            $cCURL = curl_init();


            $headers = array(
                "Content-type: text/xml",
            );
            // build up the post string

            curl_setopt($cCURL, CURLOPT_URL, 'https://gw1.payzoneonlinepayments.com:4430');
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $soapenv);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            //check if a certificate list is specified in the php.ini file, otherwise use the bundled one
            $caInfoSetting = ini_get("curl.cainfo");
            if (empty($caInfoSetting)) {
                curl_setopt($cCURL, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
            }
            // read the response
            $curlResponse = curl_exec($cCURL);
            $errorno      = curl_errno($cCURL);
            $errormsg     = curl_error($cCURL);
            $headerinfo   = curl_getinfo($cCURL);
            curl_close($cCURL); //close curl connection
            if ($curlResponse === "" || !$curlResponse) {
                $errorOccured = true;
                array_push($errorMsg, "Received empty response from payment response handler");
                self::Logger($errormsg, 'curlError');
            } else {
                //Process Succesful Curl Response

                $curlResponse = str_replace("<soap:Body>", "", $curlResponse);
                $curlResponse = str_replace("</soap:Body>", "", $curlResponse);
                $curlResponse = simplexml_load_string($curlResponse);
                $statusCode =$curlResponse->CardDetailsTransactionResponse->CardDetailsTransactionResult->StatusCode ? $curlResponse->CardDetailsTransactionResponse->CardDetailsTransactionResult->StatusCode : 999;
                $xmlResponseArray = self::parseXmltoArray($curlResponse->CardDetailsTransactionResponse, $orderarray, 'direct');
                switch ($statusCode) {
                    case 30:
                        $errorOccured = true;
                        array_push($errorMsg, $curlResponse->CardDetailsTransactionResponse->CardDetailsTransactionResult->Message);
                        break;
                    case 0:
                    case 3:
                    case 5:
                    case 20:
                        self::Logger($xmlResponseArray, 'Transaction Result');
                        self::createTransactionResultObject($xmlResponseArray, $transactionResult);
                        self::Logger($transactionResult, 'Transaction Result');
                        break;
                    case 999:
                    default:
                        $errorOccured = true;
                        array_push($errorMsg, "Status code not received in response");

                        break;
                }
            }
        } catch (Exception $e) {
            $errorOccured = true;
            array_push($errorMsg, "Unknown error in getTransactionResultFromPaymentFormHandler");
            $PayzoneHelper::Logger($e, 'getTransactionResultFromPaymentFormHandler', 'error');
        }
        if ($errorOccured) {
            self::Logger($errorMsg, 'getTransactionResultFromPaymentFormHandler - Errors');
        }
        return !$errorOccured;
    }

    /**
    Process Direct API payment 3d secure request
     * @method processDirect3DTransaction
     * @param  [String] -
     * @return [boolean] - false if transaction did not process correctly
     */
    public static function processDirect3DTransaction(&$transactionResult, &$errorMsg, $md, $pares)
    {
        $orderarray= array("MD" => $md,"PaRes" => $pares);
        $soapenv =self::soapEnvelope_Direct3DProcess($md, $pares);
        $errorOccured = false;
        $errorMsg     = array();
        try {
            // use curl to post the cross reference to the
            // payment form to query its status
            $cCURL = curl_init();
            $headers = array(
                "Content-type: text/xml",
            );
            curl_setopt($cCURL, CURLOPT_URL, 'https://gw1.payzoneonlinepayments.com:4430');
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $soapenv);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            //check if a certificate list is specified in the php.ini file, otherwise use the bundled one
            $caInfoSetting = ini_get("curl.cainfo");
            if (empty($caInfoSetting)) {
                curl_setopt($cCURL, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
            }
            // read the response
            $curlResponse = curl_exec($cCURL);
            $errorno      = curl_errno($cCURL);
            $errormsg     = curl_error($cCURL);
            $headerinfo   = curl_getinfo($cCURL);
            curl_close($cCURL); //close curl connection
            if ($curlResponse === "" || !$curlResponse) {
                $errorOccured = true;
                array_push($errorMsg, "Received empty response from payment response handler");
                self::Logger($errormsg, 'curlError');
            } else {
                //Process Succesful Curl Response
                $curlResponse = str_replace("<soap:Body>", "", $curlResponse);
                $curlResponse = str_replace("</soap:Body>", "", $curlResponse);
                $curlResponse = simplexml_load_string($curlResponse);
                $statusCode =$curlResponse->ThreeDSecureAuthenticationResponse->ThreeDSecureAuthenticationResult->StatusCode ? $curlResponse->ThreeDSecureAuthenticationResponse->ThreeDSecureAuthenticationResult->StatusCode : 999;
                $xmlResponseArray = self::parseXmltoArray($curlResponse->ThreeDSecureAuthenticationResponse, $orderarray, '3dsecure');

                switch ($statusCode) {
                    case 30:
                        $errorOccured = true;
                        array_push($errorMsg, $curlResponse->ThreeDSecureAuthenticationResponse->ThreeDSecureAuthenticationResult->Message);
                        break;
                    case 0:
                    case 3:
                    case 5:
                    case 20:
                        self::Logger($xmlResponseArray, 'Transaction Result');
                        self::createTransactionResultObject($xmlResponseArray, $transactionResult);
                        self::Logger($transactionResult, 'Transaction Result');
                        break;
                    case 999:
                    default:
                        $errorOccured = true;
                        array_push($errorMsg, "Status code not received in response");

                        break;
                }
            }
        } catch (Exception $e) {
            $errorOccured = true;
            array_push($errorMsg, "Unknown error in getTransactionResultFromPaymentFormHandler");
            $PayzoneHelper::Logger($e, 'getTransactionResultFromPaymentFormHandler', 'error');
        }
        if ($errorOccured) {
            self::Logger($errorMsg, 'getTransactionResultFromPaymentFormHandler - Errors');
        }
        return !$errorOccured;
    }


    /**
    Process Refund secure request
     * @method processRefundTransaction
     * @param  [String] -
     * @return [boolean] - false if transaction did not process correctly
     */
    public static function processRefundTransaction(&$transactionResult, &$errorMsg,$crossreference, $amount,$orderid)
    {
        $orderarray= array("OriginalCrossReference" => $crossreference,"RefundAmount" => $amount,"OrderID" => $orderid);
        $soapenv =self::soapEnvelope_RefundProcess($crossreference, $amount,$orderid);
        $errorOccured = false;
        $errorMsg     = array();
        try {
            // use curl to post the cross reference to the
            // payment form to query its status
            $cCURL = curl_init();
            $headers = array(
                "Content-type: text/xml",
            );
            curl_setopt($cCURL, CURLOPT_URL, 'https://gw1.payzoneonlinepayments.com:4430');
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $soapenv);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            //check if a certificate list is specified in the php.ini file, otherwise use the bundled one
            $caInfoSetting = ini_get("curl.cainfo");
            if (empty($caInfoSetting)) {
                curl_setopt($cCURL, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
            }
            // read the response
            $curlResponse = curl_exec($cCURL);
            $errorno      = curl_errno($cCURL);
            $errormsg     = curl_error($cCURL);
            $headerinfo   = curl_getinfo($cCURL);
            curl_close($cCURL); //close curl connection
            if ($curlResponse === "" || !$curlResponse) {
                $errorOccured = true;
                array_push($errorMsg, "Received empty response from payment response handler");
                self::Logger($errormsg, 'curlError');
            } else {
                //Process Succesful Curl Response
                $curlResponse = str_replace("<soap:Body>", "", $curlResponse);
                $curlResponse = str_replace("</soap:Body>", "", $curlResponse);
                $curlResponse = simplexml_load_string($curlResponse);
                $statusCode =$curlResponse->CrossReferenceTransactionResponse->CrossReferenceTransactionResult->StatusCode ? $curlResponse->CrossReferenceTransactionResponse->CrossReferenceTransactionResult->StatusCode : 999;
                $xmlResponseArray = self::parseXmltoArray($curlResponse->CrossReferenceTransactionResponse, $orderarray, 'refund');

                switch ($statusCode) {
                    case 30:
                        $errorOccured = true;
                        array_push($errorMsg, $curlResponse->CrossReferenceTransactionResponse->CrossReferenceTransactionResult->Message);
                        self::createTransactionResultObject($xmlResponseArray, $transactionResult);
                        break;
                    case 0:
                    case 3:
                    case 5:
                    case 20:
                        self::Logger($xmlResponseArray, 'Refund Result');
                        self::createTransactionResultObject($xmlResponseArray, $transactionResult);
                        self::Logger($transactionResult, 'Refund Result');
                        break;
                    case 999:
                    default:
                        $errorOccured = true;
                        array_push($errorMsg, "Status code not received in response");

                        break;
                }
            }
        } catch (Exception $e) {
            $errorOccured = true;
            array_push($errorMsg, "Unknown error in getTransactionResultFromPaymentFormHandler");
            $PayzoneHelper::Logger($e, 'getTransactionResultFromPaymentFormHandler', 'error');
        }
        if ($errorOccured) {
            self::Logger($errorMsg, 'getTransactionResultFromPaymentFormHandler - Errors');
        }
        return !$errorOccured;
    }
    #endregion

    #region helper functions

    /**
    getSiteUrl Function - for information and debugging
     * @method getSiteUrl
     * @return [String] - $siteurl - https/http url for site root
     */
    public static function getSiteUrl()
    {
        $protocol = 'http';
        if (isset($_SERVER['HTTPS'])) {
            if ('on' == strtolower($_SERVER['HTTPS'])) {
                $protocol = 'https';
            }
            if ('1' == $_SERVER['HTTPS']) {
                $protocol = 'https';
            }
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            $protocol = 'https';
        }
        $site =  $_SERVER['HTTP_HOST'] . str_replace("\\", "/", dirname($_SERVER['REQUEST_URI']));

        return "$protocol://$site";
    }

    /**
    parseResponseStringToArray parse response string from gateway into an array
     * @method parseResponseStringToArray
     * @param  [String]                                     $string
     * @return [Boolean]                                     [False on error]
     */
    public static function parseResponseStringToArray($string, $urldecode)
    {
        // break the reponse into an array
        // first break the variables up using the "&" delimter
        $tmpVars    = explode("&", $string);
        $parsedVars = array();
        foreach ($tmpVars as $var) {
            // for each variable, split is again on the "=" delimiter to give name/value pairs
            $aVar = explode("=", $var);
            $name = $aVar[0];
            if (!$urldecode) {
                $value = $aVar[1];
            } else {
                $value = urldecode($aVar[1]);
            }
            $parsedVars[$name] = $value;
        }
        return ($parsedVars);
    }


    /**
    parseResponseStringToArray parse response string from gateway into an array
     * @method parseResponseStringToArray
     * @param  [String]                                     $string
     * @return [Boolean]                                     [False on error]
     */
    public static function parseXmltoArray($xml, $orderarray, $source)
    {
        switch ($source) {
            case 'direct':
                $xmlArray = json_decode(json_encode($xml), true);
                if ($xmlArray['CardDetailsTransactionResult']['StatusCode'] === '3') {
                    $mergedArray = array_merge($orderarray, $xmlArray['CardDetailsTransactionResult'], $xmlArray['TransactionOutputData']['@attributes'], $xmlArray['TransactionOutputData'], $xmlArray['TransactionOutputData']['ThreeDSecureOutputData']);
                } else {
                    $mergedArray = array_merge($orderarray, $xmlArray['CardDetailsTransactionResult'], $xmlArray['TransactionOutputData']['@attributes'], $xmlArray['TransactionOutputData']);
                }
                break;
            case '3dsecure':
                $xmlArray = json_decode(json_encode($xml), true);
                $mergedArray = array_merge($xmlArray['ThreeDSecureAuthenticationResult'], $xmlArray['TransactionOutputData']['@attributes'], $xmlArray['TransactionOutputData']);

                break;
            case 'refund':
                $xmlArray = json_decode(json_encode($xml), true);
                $mergedArray = array_merge($xmlArray['CrossReferenceTransactionResult'], $xmlArray['TransactionOutputData']);

                break;

        }
        return ($mergedArray);
    }



    #endregion

    #region SOAPEnvelopes functions

    private static function soapEnvelope_DirectProcess($amount, $currencycode, $transactiontype, $orderid, $orderdesc, $cardname, $cv2, $cardnumber, $expmonth, $expyear, $startmonth, $startyear, $address1, $address2, $address3, $address4, $city, $state, $postcode)
    {
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

        $soap = "<?xml version='1.0' encoding='utf-8' ?>".
            "<soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'>".
            "<soap:Body>".
            "<CardDetailsTransaction xmlns='https://www.thepaymentgateway.net/'>".
            "<PaymentMessage>".
            "<MerchantAuthentication Password='".self::$merchantpassword."' MerchantID='".self::$merchantid."'/>".
            "<TransactionDetails Amount='$amount' CurrencyCode='$currencycode'><MessageDetails TransactionType='$transactiontype'/>".
            "<TransactionControl>".
            "<ThreeDSecureOverridePolicy>true</ThreeDSecureOverridePolicy>".
            "<DuplicateDelay>60</DuplicateDelay>".
            "<EchoCardType>".self::$echocardtype."</EchoCardType>".
            "<EchoAVSCheckResult>".self::$echoavs."</EchoAVSCheckResult>".
            "<EchoCV2CheckResult>".self::$echocv2."</EchoCV2CheckResult>".
            "<EchoThreeDSecureAuthenticationCheckResult>".self::$echothreed."</EchoThreeDSecureAuthenticationCheckResult>".
            "<EchoAmountReceived>false</EchoAmountReceived>".
            "</TransactionControl>".
            "<ThreeDSecureBrowserDetails>".
            "<AcceptHeaders>*/*</AcceptHeaders>".
            "<UserAgent>$useragent</UserAgent>".
            "</ThreeDSecureBrowserDetails>".
            "<OrderID>$orderid</OrderID>".
            "<OrderDescription>$orderdesc</OrderDescription>".
            "</TransactionDetails>".
            "<CardDetails>".
            "<CardName>$cardname</CardName>".
            "<CV2>$cv2</CV2>".
            "<CardNumber>$cardnumber</CardNumber>".
            "<ExpiryDate Month='$expmonth' Year='$expyear'/>".
            "<StartDate Month='$startmonth' Year='$startyear'/>".
            "</CardDetails>".
            "<CustomerDetails>".
            "<BillingAddress>".
            "<Address1>$address1</Address1>".
            "<Address2>$address2</Address2>".
            "<Address3>$address3</Address3>".
            "<Address4>$address4</Address4>".
            "<City>$city</City>".
            "<State>$state</State>".
            "<PostCode>$postcode</PostCode>".
            "</BillingAddress>".
            "</CustomerDetails>".
            "</PaymentMessage>".
            "</CardDetailsTransaction>".
            "</soap:Body>".
            "</soap:Envelope>";

        return $soap;
    }



    private static function soapEnvelope_Direct3DProcess($md, $pares)
    {
        $soap = "<?xml version='1.0' encoding='UTF-8'?>".
            "<soap:Envelope xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>".
            "<soap:Body>".
            "<ThreeDSecureAuthentication xmlns='https://www.thepaymentgateway.net/'>".
            "<ThreeDSecureMessage>".
            "<ThreeDSecureInputData CrossReference='$md'>".
            "<PaRES>$pares</PaRES>".
            "</ThreeDSecureInputData>".
            "<MerchantAuthentication Password='".self::$merchantpassword."' MerchantID='".self::$merchantid."'/>".
            "</ThreeDSecureMessage>".
            "</ThreeDSecureAuthentication>".
            "</soap:Body>".
            "</soap:Envelope>";

        return $soap;
    }

    private static function soapEnvelope_RefundProcess($crossreference, $amount,$orderid)
    {
        $soap = "<?xml version='1.0' encoding='utf-8' ?>".
            "<soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'>".
            "<soap:Body>".
            "<CrossReferenceTransaction xmlns='https://www.thepaymentgateway.net/'>".
            "<PaymentMessage>".
            "<TransactionDetails Amount='$amount' CurrencyCode='826'>".
            "<MessageDetails TransactionType='REFUND' CrossReference='$crossreference' />".
            "<TransactionControl>".
            "<ThreeDSecureOverridePolicy>true</ThreeDSecureOverridePolicy>".
            "<DuplicateDelay>60</DuplicateDelay>".
            "</TransactionControl>".
            "<OrderID>$orderid</OrderID>".
            "</TransactionDetails>".
            "<MerchantAuthentication Password='".self::$merchantpassword."' MerchantID='".self::$merchantid."'/>".
            "</PaymentMessage>".
            "</CrossReferenceTransaction>".
            "</soap:Body>".
            "</soap:Envelope>";

        return $soap;
    }




    #endregion

    #region TransactionResults

    /**
    createTransactionResultObject create the transaction result object
     * @method createTransactionResultObject
     * @param  [Array] - $transactionResultArray
     * @param  [Empty] - $transactionresult - variable by reference for return
     * @return [Object] - $transactionresult - variable by reference for return
     * @return [Boolean] - False on error
     */
    public static function createTransactionResultObject($transactionResultArray, &$TransactionResult)
    {
        $TransactionResult = new TransactionResult();

        //3D Secure Response
        if (isset($transactionResultArray['PaREQ'])) {
            $TransactionResult->setPaReq($transactionResultArray['PaREQ']);
        }
        if (isset($transactionResultArray['PaRes'])) {
            $TransactionResult->setPaRes($transactionResultArray['PaRes']);
        }
        if (isset($transactionResultArray['ACSURL'])) {
            $TransactionResult->setAcsUrl($transactionResultArray['ACSURL']);
        }


        //Transaction Responses
        if (isset($transactionResultArray['MerchantID'])) {
            $TransactionResult->setMerchantID($transactionResultArray['MerchantID']);
        }
        if (isset($transactionResultArray['StatusCode'])) {
            $TransactionResult->setStatusCode($transactionResultArray['StatusCode']);
        }
        if (isset($transactionResultArray['Message'])) {
            $TransactionResult->setMessage($transactionResultArray['Message']);
        }
        if (isset($transactionResultArray['PreviousTransactionResult'])) {
            $TransactionResult->setPreviousStatusCode($transactionResultArray['PreviousTransactionResult']['StatusCode']);
            $TransactionResult->setPreviousMessage($transactionResultArray['PreviousTransactionResult']['Message']);
        }

        if (isset($transactionResultArray['PreviousStatusCode'])) {
            $TransactionResult->setPreviousStatusCode($transactionResultArray['PreviousStatusCode']);
        }
        if (isset($transactionResultArray['PreviousMessage'])) {
            $TransactionResult->setPreviousMessage($transactionResultArray['PreviousMessage']);
        }
        if (isset($transactionResultArray['CrossReference'])) {
            $TransactionResult->setCrossReference($transactionResultArray['CrossReference']);
        }
        if (isset($transactionResultArray['TransactionOutputData']['CrossReference'])) {
            $TransactionResult->setCrossReference($transactionResultArray['TransactionOutputData']['CrossReference']);
        }


        //Transaction Checks
        if (isset($transactionResultArray['ThreeDSecureAuthenticationCheckResult'])) {
            $TransactionResult->setThreeDSecureAuthenticationCheckResult($transactionResultArray['ThreeDSecureAuthenticationCheckResult']);
        }
        if (isset($transactionResultArray['AddressNumericCheckResult'])) {
            $TransactionResult->setAddressNumericCheckResult($transactionResultArray['AddressNumericCheckResult']);
        }
        if (isset($transactionResultArray['PostCodeCheckResult'])) {
            $TransactionResult->setPostCodeCheckResult($transactionResultArray['PostCodeCheckResult']);
        }
        if (isset($transactionResultArray['CV2CheckResult'])) {
            $TransactionResult->setCV2CheckResult($transactionResultArray['CV2CheckResult']);
        }

        //Transaction Details
        if (isset($transactionResultArray['Amount'])) {
            $TransactionResult->setAmount($transactionResultArray['Amount']);
        }
        if (isset($transactionResultArray['CurrencyCode'])) {
            $TransactionResult->setCurrencyCode($transactionResultArray['CurrencyCode']);
        }
        if (isset($transactionResultArray['OrderID'])) {
            $TransactionResult->setOrderID($transactionResultArray['OrderID']);
        }

        if (isset($_SESSION['tp_order_id'])) {
            $TransactionResult->setOrderID($_SESSION['tp_order_id']);
        }
        if (isset($_SESSION['tp_order_desc'])) {
            $TransactionResult->setOrderDescription($_SESSION['tp_order_desc']);
        }
        if (isset($_SESSION['tp_order_amount'])) {
            $TransactionResult->setAmount($_SESSION['tp_order_amount']);
        }
        if (isset($_SESSION['tp_order_type'])) {
            $TransactionResult->setTransactionType($_SESSION['tp_order_type']);
        }
        if (isset($_SESSION['tp_order_currencycode'])) {
            $TransactionResult->setCurrencyCode($_SESSION['tp_order_currencycode']);
        }
        if (isset($_SESSION['tp_order_transactiondatetime'])) {
            $TransactionResult->setTransactionDateTime($_SESSION['tp_order_transactiondatetime']);
        }
        if (isset($_SESSION['tp_order_crossreference'])) {
            $TransactionResult->setCrossReference($_SESSION['tp_order_crossreference']);
        }

        if (isset($transactionResultArray['TransactionType'])) {
            $TransactionResult->setTransactionType($transactionResultArray['TransactionType']);
        }
        if (isset($transactionResultArray['TransactionDateTime'])) {
            $TransactionResult->setTransactionDateTime($transactionResultArray['TransactionDateTime']);
        }
        if (isset($transactionResultArray['OrderDescription'])) {
            $TransactionResult->setOrderDescription($transactionResultArray['OrderDescription']);
        }
        if (isset($transactionResultArray['CustomerName'])) {
            $TransactionResult->setCustomerName($transactionResultArray['CustomerName']);
        }
        if (isset($transactionResultArray['Address1'])) {
            $TransactionResult->setAddress1($transactionResultArray['Address1']);
        }
        if (isset($transactionResultArray['Address2'])) {
            $TransactionResult->setAddress2($transactionResultArray['Address2']);
        }
        if (isset($transactionResultArray['Address3'])) {
            $TransactionResult->setAddress3($transactionResultArray['Address3']);
        }
        if (isset($transactionResultArray['Address4'])) {
            $TransactionResult->setAddress4($transactionResultArray['Address4']);
        }
        if (isset($transactionResultArray['City'])) {
            $TransactionResult->setCity($transactionResultArray['City']);
        }
        if (isset($transactionResultArray['State'])) {
            $TransactionResult->setState($transactionResultArray['State']);
        }
        if (isset($transactionResultArray['PostCode'])) {
            $TransactionResult->setPostCode($transactionResultArray['PostCode']);
        }
        if (isset($transactionResultArray['CountryCode'])) {
            $TransactionResult->setCountryCode($transactionResultArray['CountryCode']);
        }

        $TransactionResult->setTransactionOutcome();
    }
    #endregion
}
