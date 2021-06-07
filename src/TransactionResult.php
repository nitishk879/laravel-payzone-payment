<?php


namespace Svodya\Payzone;


class TransactionResult
{

    #region class variables

    /**
    Declare class variables
     */
    private $StatusCode;
    private $Message;
    private $PreviousStatusCode;
    private $PreviousMessage;
    private $CrossReference;
    private $AddressNumericCheckResult;
    private $PostCodeCheckResult;
    private $CV2CheckResult;
    private $ThreeDSecureAuthenticationCheckResult;
    private $Amount;
    private $CurrencyCode;
    private $OrderID;
    private $TransactionType;
    private $TransactionDateTime;
    private $OrderDescription;
    private $CustomerName;
    private $Address1;
    private $Address2;
    private $Address3;
    private $Address4;
    private $City;
    private $State;
    private $PostCode;
    private $CountryCode;
    private $IPAddress;
    private $EmailAddress;
    private $PhoneNumber;
    //Pretty Variables
    private $TransactionOutcome;
    private $TransactionOutcomeDetail;

    //3D Secure
    private $PaReq;
    private $PaRes;
    private $ACSUrl;
    #endregion

    #region getter / setters

    /**
    Getter & Setter functions for class variables
     */

    public function setMerchantID($MerchantId)
    {
        $this->MerchantId = $MerchantId;
    }
    public function getMerchantID()
    {
        return $this->StatusCode;
    }
    public function setMessage($Message)
    {
        $this->Message = $Message;
    }
    public function getMessage()
    {
        return $this->Message;
    }
    public function setPreviousStatusCode($PreviousStatusCode)
    {
        $this->PreviousStatusCode = $PreviousStatusCode;
    }
    public function getPreviousStatusCode()
    {
        return $this->PreviousStatusCode;
    }
    public function setPreviousMessage($PreviousMessage)
    {
        $this->PreviousMessage = $PreviousMessage;
    }
    public function getPreviousMessage()
    {
        return $this->PreviousMessage;
    }
    public function setStatusCode($StatusCode)
    {
        $this->StatusCode = $StatusCode;
    }
    public function getStatusCode()
    {
        return $this->StatusCode;
    }

    public function setTransactionOutcome()
    {
        $this->TransactionOutcome       = $this->TransactionOutcome($this->StatusCode,$this->TransactionType);
        $this->TransactionOutcomeDetail = $this->TransactionOutcomeDetail($this->Message, $this->StatusCode, $this->AddressNumericCheckResult, $this->PostCodeCheckResult, $this->CV2CheckResult, $this->ThreeDSecureAuthenticationCheckResult);
    }
    public function getTransactionOutcome()
    {
        return $this->TransactionOutcome;
    }
    public function getTransactionOutcomeDetail()
    {
        return $this->TransactionOutcomeDetail;
    }
    public function setCrossReference($CrossReference)
    {
        $this->CrossReference = $CrossReference;
    }
    public function getCrossReference()
    {
        return $this->CrossReference;
    }
    public function setThreeDSecureAuthenticationCheckResult($ThreeDSecureAuthenticationCheckResult)
    {
        $this->ThreeDSecureAuthenticationCheckResult = $ThreeDSecureAuthenticationCheckResult;
    }
    public function getThreeDSecureAuthenticationCheckResult()
    {
        return $this->ThreeDSecureAuthenticationCheckResult;
    }
    public function setAddressNumericCheckResult($AddressNumericCheckResult)
    {
        $this->AddressNumericCheckResult = $AddressNumericCheckResult;
    }
    public function getAddressNumericCheckResult()
    {
        return $this->AddressNumericCheckResult;
    }
    public function setPostCodeCheckResult($PostCodeCheckResult)
    {
        $this->PostCodeCheckResult = $PostCodeCheckResult;
    }
    public function getPostCodeCheckResult()
    {
        return $this->PostCodeCheckResult;
    }
    public function setCV2CheckResult($CV2CheckResult)
    {
        $this->CV2CheckResult = $CV2CheckResult;
    }
    public function getCV2CheckResult()
    {
        return $this->CV2CheckResult;
    }
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }
    public function getAmount()
    {
        return $this->Amount;
    }
    public function setCurrencyCode($CurrencyCode)
    {
        $this->CurrencyCode = $CurrencyCode;
    }
    public function getCurrencyCode()
    {
        return $this->CurrencyCode;
    }
    public function setOrderID($OrderID)
    {
        $this->OrderID = $OrderID;
    }
    public function getOrderID()
    {
        return $this->OrderID;
    }
    public function setTransactionType($TransactionType)
    {
        $this->TransactionType = $TransactionType;
    }
    public function getTransactionType()
    {
        return $this->TransactionType;
    }
    public function setTransactionDateTime($TransactionDateTime)
    {
        $this->TransactionDateTime = $TransactionDateTime;
    }
    public function getTransactionDateTime()
    {
        return $this->TransactionDateTime;
    }
    public function setOrderDescription($OrderDescription)
    {
        $this->OrderDescription = $OrderDescription;
    }
    public function getOrderDescription()
    {
        return $this->OrderDescription;
    }
    public function setCustomerName($CustomerName)
    {
        $this->CustomerName = $CustomerName;
    }
    public function getCustomerName()
    {
        return $this->CustomerName;
    }
    public function setAddress1($Address1)
    {
        $this->Address1 = $Address1;
    }
    public function getAddress1()
    {
        return $this->Address1;
    }
    public function setAddress2($Address2)
    {
        $this->Address2 = $Address2;
    }
    public function getAddress2()
    {
        return $this->Address2;
    }
    public function setAddress3($Address3)
    {
        $this->Address3 = $Address3;
    }
    public function getAddress3()
    {
        return $this->Address3;
    }
    public function setAddress4($Address4)
    {
        $this->Address4 = $Address4;
    }
    public function getAddress4()
    {
        return $this->Address4;
    }
    public function setCity($City)
    {
        $this->City = $City;
    }
    public function getCity()
    {
        return $this->City;
    }
    public function setState($State)
    {
        $this->State = $State;
    }
    public function getState()
    {
        return $this->State;
    }
    public function setPostCode($PostCode)
    {
        $this->PostCode = $PostCode;
    }
    public function getPostCode()
    {
        return $this->PostCode;
    }
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;
    }
    public function getCountryCode()
    {
        return $this->CountryCode;
    }
    public function setPaReq($PaReq)
    {
        $this->PaReq = $PaReq;
    }
    public function getPaReq()
    {
        return $this->PaReq;
    }
    public function setPaRes($PaRes)
    {
        $this->PaRes = $PaRes;
    }
    public function getPaRes()
    {
        return $this->PaRes;
    }
    public function setAcsUrl($ACSUrl)
    {
        $this->ACSUrl = $ACSUrl;
    }
    public function getAcsUrl()
    {
        return $this->ACSUrl;
    }

    #endregion

    #region helper functions

    /**
    TransactionOutcome parse Status Code into human readable response
     * @method parseResponseStringToArray
     * @param  [String]                                     $statusCode
     * @return [String]                                     HUman readable status code
     */
    public function TransactionOutcome($statusCode, $transactionType)
    {
        switch ($statusCode) {
            case '0':
                $TransactionOutcome = config('payzone.PREAUTH') === $transactionType?  'Preauthorised' : "Successful";

                break;
            case '3':
                $TransactionOutcome = '3D Secure Required';
                break;
            case '4':
                $TransactionOutcome = 'Referred';
                break;
            case '5':
                $TransactionOutcome = 'Declined';
                break;
            case '20':
                $TransactionOutcome = 'Duplicate';
                break;
            case '30':
                $TransactionOutcome = 'Gateway error';
                break;
            case null:
                $TransactionOutcome = '';
                break;
            default:
                $TransactionOutcome = 'Unknown error';
                break;
        }

        return $TransactionOutcome;
    }

    /**
    TransactionOutcomeDetail parse Status Code into human readable response
     * @method TransactionOutcomeDetail
     * @param  [String]                                     $statusCode
     * @return [String]                                     HUman readable status code
     */
    public function TransactionOutcomeDetail($message, $statusCode, $avs, $pcode, $cv2, $threed)
    {
        $TransactionOutcomeDetail = $message;
        $avs                      = $avs ? "Address numeric check - $avs | " : "";
        $threed                   = $threed ? "3D secure authentication - $threed | " : "";
        $pcode                    = $pcode ? "Postcode check - $pcode | " : "";
        $cv2                      = $cv2 ? "CV2 check - $cv2 " : "";
        $TransactionOutcomeDetail = $statusCode === '20' ? "Duplicated transaction" : $avs . $threed . $pcode . $cv2;

        return $TransactionOutcomeDetail;
    }

    #endregion
}
