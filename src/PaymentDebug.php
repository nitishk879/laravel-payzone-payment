<?php


namespace Svodya\Payzone;


class PaymentDebug
{

    #region class variables
    /**
    Declare class variables
     */
    //Merchant Details
    private static $version;
    private static $vguid;
    private static $gatewayendpoint;
    private static $versionendpoint;
    private static $merchantid;
    private static $merchantpassword;
    private static $ServerInfo;
    private static $ServerDateTime;
    private static $PHPVersion;
    private static $CurlEnabled;
    private static $FsockEnabled;
    private static $SoapEnabled;
    private static $SSLHttps;
    private static $Port4430Check;
    private static $MerchantDetailsValid;
    private static $IsLocal;
    private static $DisplayErrors;
    private static $DisplayErrorsLevel;
    private static $LogErrors;
    private static $LogErrorsLocation;
    private static $CustomErrorsLocation;
    private static $CustomErrorsLocationUrl;
    #endregion

    #region __construct

    public function __construct()
    {

        /**
        Set values for class variables
         */

        self::$version          = config('payzone.VERSION');
        self::$vguid            = config('payzone.VGUID');
        self::$gatewayendpoint  = config('payzone.GATEWAYURL');
        self::$versionendpoint  = config('payzone.MAPIURL');
        self::$ServerInfo     = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : "Unknown";
        self::$ServerDateTime = date('Y-m-d H:i:s P');
        self::$PHPVersion     = phpversion();
        $Curl                 = function_exists('curl_version') ? curl_version() : "not installed";
        self::$CurlEnabled    = function_exists('curl_init');
        self::$FsockEnabled   = function_exists('fsockopen');
        self::$SoapEnabled    = class_exists('SoapClient');
        self::$SSLHttps       = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
        self::$IsLocal        = (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));
        self::$DisplayErrors      = ini_get('display_errors');
        self::$DisplayErrorsLevel = ini_get('error_reporting');
        self::$LogErrors          = ini_get('log_errors');
        self::$LogErrorsLocation  = ini_get('error_log');
        self::$CustomErrorsLocation  = __DIR__ . '\payzone.log';
        self::$CustomErrorsLocationUrl  = storage_path('logs/payzone.log');
    }

    #endregion

    #region getter / setters

    public static function getVersionInfo()
    {
        $installedVersion=self::$version;

        try {
            $cCURL = curl_init();

            $headers = array(
                "Content-type: text/text;charset=\"utf-8\"",
                "Accept: text/text",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
            );
            curl_setopt($cCURL, CURLOPT_URL, self::$versionendpoint.self::$vguid);


            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($cCURL, CURLOPT_CONNECTTIMEOUT, 3);
            //check if a certificate list is specified in the php.ini file, otherwise use the bundled one
            $caInfoSetting = ini_get("curl.cainfo");
            if (empty($caInfoSetting)) {
                curl_setopt($cCURL, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
                curl_setopt($cCURL, CURLOPT_SSL_VERIFYHOST, __DIR__ . "/cacert.pem");
                curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, __DIR__ . "/cacert.pem");
            }
            // read the response
            $curlResponse = curl_exec($cCURL);
            $errorno      = curl_errno($cCURL);
            $errormsg     = curl_error($cCURL);
            $headerinfo   = curl_getinfo($cCURL);
            $httpCode = curl_getinfo($cCURL, CURLINFO_HTTP_CODE);
            $retval = "";
            if ($errormsg) {
                $retval= $errormsg;
            }

            if ($httpCode === 200) {
                if ($curlResponse) {

                    $curlJson=json_decode($curlResponse);

                    if (isset($curlJson->Message)) {
                        $retval =  $curlJson->Message;
                    } else {
                        $versionresp = self::checkVersions($installedVersion, $curlJson->Version) ;
                        $retval = ($versionresp === 'Latest version installed') ? $versionresp : $versionresp . " - <a target='_new' href='$curlJson->DownloadUrl'>Download</a>";
                    }

                } else {
                    $retval =  'Unable to check version - no response';
                }
            } else {
                $retval =  'Unable to check version - 404';
            }
            curl_close($cCURL); //close curl connection
        } catch (Exception $e) {
            $errorOccured = true;
            $retval =  'Unable to check version - exception occured';
        }

        return "$installedVersion - $retval";
    }
    public static function checkVersions($installedVersion, $newVersion)
    {
        $installed=explode(".", $installedVersion);
        $available=explode(".", $newVersion);

        $response = intval($installed[2]) < intval($available[2]) ? "Update available" :"Latest version installed";
        $response = intval($installed[1]) < intval($available[1]) ? "Minor update available" : $response;
        $response = intval($installed[0]) < intval($available[0]) ? "Major release available" :  $response;
        return $response;
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
    /**
    Getter & Setter functions for class variables
     */
    public static function getServerInfo()
    {
        return self::$ServerInfo;
    }
    public static function getServerDateTime()
    {
        return self::$ServerDateTime;
    }
    public static function getPHPVersion()
    {
        return self::$PHPVersion;
    }
    public static function getCurlEnabled()
    {
        return self::BoolToString(self::$CurlEnabled);
    }
    public static function getFsockEnabled()
    {
        return self::BoolToString(self::$FsockEnabled);
    }
    public static function getSoapEnabled()
    {
        return self::BoolToString(self::$SoapEnabled);
    }

    public static function getSslHttps()
    {
        return self::BoolToString(self::$SSLHttps);
    }

    public static function getIsLocal()
    {
        return self::BoolToString(self::$IsLocal);
    }

    public static function getLogErrors()
    {
        return self::BoolToString(self::$LogErrors) . " | " . self::$LogErrorsLocation;
    }
    public static function getCustomErrors()
    {
        return  self::$CustomErrorsLocation . " | "  . self::$CustomErrorsLocationUrl;
    }
    public static function getDisplayErrors()
    {
        return self::BoolToString(self::$DisplayErrors) . " | " . self::$DisplayErrorsLevel;
    }
    public static function BoolToString($bool)
    {
        return ($bool) ? "true" : "false";
    }
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

    public static function getCustomLogs()
    {
        $logfile = dirname(__FILE__) . '\payzone.log';
        $log = '';
        if (file_exists($logfile)) {
            $file = new \SplFileObject($logfile, 'r');
            $file->seek(PHP_INT_MAX);
            $totallines = $file->key() + 1;

            if ($totallines > 5000) {
                $log .= "The custom logfile at $logfile, contains over 5000 lines of logs, to view these logs please open directly or purge the logs";
            } else {
                if ($file = fopen($logfile, "r")) {
                    while (!feof($file)) {
                        $line = fgets($file);
                        if (substr($line, 0, 5) === 'Debug') {
                            $log .= '<hr/>';
                        }
                        $log .= ($line . '</br></br>');
                    }
                    fclose($file);
                }
            }
        } else {
            $log .= "The logfile at  $logfile  does not exist, this might mean either debug mode is not active or the location is not correct";
        }
        return "<code style='padding:1rem;background-color:#333;color:white;display:block;max-height:400px;overflow:auto;overflow-anchor:none;word-break:break-word'>$log<div style='overflow-anchor:auto;height:1px;' id='code-anchor'></div></code><script>var objDiv = document.getElementById('code-anchor');objDiv.scrollIntoView();</script>";
    }
    public static function runPortCheck()
    {
        $soapenv = self::getSoapEnvelope(self::$merchantid, self::$merchantpassword);

        $errorOccured = false;
        $errorMsg     = array();
        try {
            $cCURL = curl_init();

            $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: ".strlen($soapenv),
            );
            curl_setopt($cCURL, CURLOPT_URL, self::$gatewayendpoint);
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $soapenv);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($cCURL, CURLOPT_CONNECTTIMEOUT, 3);
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

            $curlResponse = simplexml_load_string($curlResponse);
            $curlResponse->registerXPathNamespace("soap", "http://www.w3.org/2003/05/soap-envelope");
            $curlResponse=$curlResponse->xpath('//soap:Body');
            $curlResponseStatus = $curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->StatusCode;
            $curlResponseMessage = isset($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->Message) ? ($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->Message) : "";
            $curlResponseMessageDetail = isset($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->ErrorMessages->MessageDetail->Detail) ? ($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->ErrorMessages->MessageDetail->Detail) : "";


            switch ($curlResponseStatus) {
                case 0:
                    return 'Connection successful';
                    break;
                case 30:
                default:
                    return "Connection failed - $curlResponseMessage $curlResponseMessageDetail";
                    break;
            }
            if ($errormsg) {
                return "Connection failed - $errormsg";
            }

            curl_close($cCURL); //close curl connection
            return 'TBC';
        } catch (Exception $e) {
            $errorOccured = true;
            return $e;
        }
    }
    public static function runMerchantDetailsCheck()
    {
        $soapenv = self::getSoapEnvelope(self::$merchantid, self::$merchantpassword);

        $errorOccured = false;
        $errorMsg     = array();
        try {
            $cCURL = curl_init();

            $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: ".strlen($soapenv),
            );
            curl_setopt($cCURL, CURLOPT_URL, self::$gatewayendpoint);
            curl_setopt($cCURL, CURLOPT_POST, true);
            curl_setopt($cCURL, CURLOPT_POSTFIELDS, $soapenv);
            curl_setopt($cCURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cCURL, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($cCURL, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($cCURL, CURLOPT_CONNECTTIMEOUT, 3);
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
            if ($curlResponse) {
                $curlResponse = simplexml_load_string($curlResponse);
                $curlResponse->registerXPathNamespace("soap", "http://www.w3.org/2003/05/soap-envelope");
                $curlResponse=$curlResponse->xpath('//soap:Body');
                $curlResponseStatus = $curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->StatusCode;
                $curlResponseMessage = isset($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->Message) ? ($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->Message) : "";
                $curlResponseMessageDetail = isset($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->ErrorMessages->MessageDetail->Detail) ? ($curlResponse[0]->GetGatewayEntryPointsResponse->GetGatewayEntryPointsResult->ErrorMessages->MessageDetail->Detail) : "";


                switch ($curlResponseStatus) {
                    case 0:
                        return 'Merchant details valid';
                        break;
                    case 30:
                    default:
                        return "Merchant details invalid - $curlResponseMessage $curlResponseMessageDetail";
                        break;
                }
            }
            if ($errormsg) {
                return "Connection failed - $errormsg";
            }

            curl_close($cCURL); //close curl connection
            return 'TBC';
        } catch (Exception $e) {
            $errorOccured = true;
            return $e;
        }
    }

    public static function getSoapEnvelope($merchantid, $merchantpassword)
    {
        $soapenv = '<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <soap:Body>
                <GetGatewayEntryPoints xmlns="https://www.thepaymentgateway.net/">
                    <GetGatewayEntryPointsMessage>
                        <MerchantAuthentication Password="'.$merchantpassword.'" MerchantID="'.$merchantid.'"/>
                    </GetGatewayEntryPointsMessage>
                </GetGatewayEntryPoints>
            </soap:Body>
        </soap:Envelope>';
        return $soapenv;
    }

    #endregion
}
