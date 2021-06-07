<form class="payzone-form" id="PayzonePaymentForm" name="PayzonePaymentForm" target="_parent" method="POST" style="display: block;" action="{{ config('payzone.callback_url') }}">

    <!-- Transaction details -->
    <input type="hidden" name="DirectCallback" value="1">
    <input type="hidden" name="MerchantID" value="{{ config('payzone.merchantId') }}">
    <input type="hidden" name="HashDigest" value="{{ $HashDigest }}">
    <input type="hidden" name="TransactionType" value="{{ $transactionResult->getTransactionType() }}">

    <!-- Payment details -->
    <input type="hidden" name="Amount" value="{{  $transactionResult->getAmount() }}">
    <input type="hidden" name="CurrencyCode" value="{{  $transactionResult->getCurrencyCode() }}">
    <input type="hidden" name="OrderID" value="{{  $transactionResult->getOrderID() }}">
    <input type="hidden" name="CrossReference" value="{{  $transactionResult->getCrossReference() }}">
    <input type="hidden" name="TransactionDateTime" value="{{  $transactionResult->getTransactionDateTime() }}">
    <input type="hidden" name="OrderDescription" value="{{  $transactionResult->getOrderDescription() }}">
    <input type="hidden" name="StatusCode" value="{{  $transactionResult->getStatusCode() }}">
    <input type="hidden" name="Message" value="{{  $transactionResult->getMessage() }}">
    <input type="hidden" name="PreviousStatusCode" value="{{  $transactionResult->getPreviousStatusCode() }}">
    <input type="hidden" name="PreviousMessage" value="{{  $transactionResult->getPreviousMessage() }}">

    <!-- Customer Details -->
    <input type="hidden" name="Address1" value="{{  $transactionResult->getAddress1() ?? config('payzone.address1') }}">
    <input type="hidden" name="Address2" value="{{  $transactionResult->getAddress2() }}">
    <input type="hidden" name="Address3" value="{{ $transactionResult->getAddress3() }}">
    <input type="hidden" name="Address4" value="{{  $transactionResult->getAddress4() }}">
    <input type="hidden" name="City" value="{{  $transactionResult->getCity() ?? config('payzone.address1') }}">
    <input type="hidden" name="State" value="{{  $transactionResult->getState() ?? config('payzone.address1') }}">
    <input type="hidden" name="PostCode" value="{{  $transactionResult->getPostCode() ?? config('payzone.address1') }}">
    <input type="hidden" name="CountryCode" value="{{  $transactionResult->getCountryCode() ?? config('payzone.address1') }}">

    <!-- Response options -->
    <input type="hidden" name="AddressNumericCheckResult" value="{{  $transactionResult->getAddressNumericCheckResult() }}">
    <input type="hidden" name="PostCodeCheckResult" value="{{ $transactionResult->getPOstCodeCheckResult() }}">
    <input type="hidden" name="CV2CheckResult" value="{{ $transactionResult->getCV2CheckResult() }}">
    <input type="hidden" name="ThreeDSecureAuthenticationCheckResult" value="{{  $transactionResult->getThreeDSecureAuthenticationCheckResult() }}">
</form>
