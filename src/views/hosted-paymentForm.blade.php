<form class="payzone-form" id="PayzonePaymentForm" name="PayzonePaymentForm" target="_self" method="POST" style="display: block;" action="https://mms.payzoneonlinepayments.com/Pages/PublicPages/PaymentForm.aspx">

    <!-- Transaction details -->
    <input type="hidden" name="MerchantID" value="{{ config("payzone.merchantId") }}">
    <input type="hidden" name="HashDigest" value="{{ $HashDigest }}">
    <input type="hidden" name="TransactionType" value="{{ $request->TransactionType }}">
    <input type="hidden" name="CallbackURL" value="{{ config('payzone.callback_url') }}">
    <input type="hidden" name="ServerResultURL" value="{{ config('payzone.server_result_url') }}">

    <!-- Payment details -->
    <input type="hidden" name="Amount" value="{{ $_POST['Amount'] }}">
    <input type="hidden" name="CurrencyCode" value="{{ $_POST['CurrencyCode']  }}">
    <input type="hidden" name="OrderID" value="{{ $_POST['OrderID']  }}">
    <input type="hidden" name="TransactionDateTime" value="{{ $_POST['TransactionDateTime']  }}">
    <input type="hidden" name="OrderDescription" value="{{ $_POST['OrderDescription']  }}">

    <!-- Customer Details -->
    <input type="hidden" name="CustomerName" value="{{ $_POST['CustomerName'] }}">
    <input type="hidden" name="Address1" value="{{ $_POST['Address1'] }}">
    <input type="hidden" name="Address2" value="{{ $_POST['Address2'] }}">
    <input type="hidden" name="Address3" value="{{ $_POST['Address3'] }}">
    <input type="hidden" name="Address4" value="{{ $_POST['Address4'] }}">
    <input type="hidden" name="City" value="{{ $_POST['City'] }}">
    <input type="hidden" name="State" value="{{ $_POST['State'] }}">
    <input type="hidden" name="PostCode" value="{{ $_POST['PostCode'] }}">
    <input type="hidden" name="CountryCode" value="{{ $_POST['CountryCode'] }}">

    <!-- Response options -->
    <input type="hidden" name="EchoAVSCheckResult" value="{{ $card['echoavs'] ?? '' }}">
    <input type="hidden" name="EchoCV2CheckResult" value="{{ $card['echocv2'] ?? '' }}">
    <input type="hidden" name="EchoThreeDSecureAuthenticationCheckResult" value="{{ $card['echothreed'] ?? '' }}">
    <input type="hidden" name="EchoCardType" value="{{ $card['echocardtype'] ?? '' }}">

    <!-- Form config options -->
    <input type="hidden" name="CV2Mandatory" value="{{ $card['cv2mandatory'] }}">
    <input type="hidden" name="Address1Mandatory" value="{{ $card['address1mandatory'] }}">
    <input type="hidden" name="CityMandatory" value="{{ $card['citymandatory'] }}">
    <input type="hidden" name="PostCodeMandatory" value="{{ $card['postcodemandatory'] }}">
    <input type="hidden" name="StateMandatory" value="{{ $card['statemandatory'] }}">
    <input type="hidden" name="CountryMandatory" value="{{ $card['countrymandatory'] }}">
    <input type="hidden" name="ResultDeliveryMethod" value="{{ $card['resultdeliverymethod'] ?? false }}">
    <input type="hidden" name="PaymentFormDisplaysResult" value="{{ $card['paymentformsdisplaysresult'] }}">
    <input type="hidden" name="ServerResultURLCookieVariables" value="{{ $card['serverresulturlcookievariables'] }}">
    <input type="hidden" name="ServerResultURLFormVariables" value="{{ $card['serverresulturlformvariables'] }}">
    <input type="hidden" name="ServerResultURLQueryStringVariables" value="{{ $card['serverresulturlquerystringvariables'] }}">

</form>
<script type='text/javascript'>
    window.addEventListener('load', function() {
       document.PayzonePaymentForm.submit();
    });
</script>
