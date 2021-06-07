<form class="payzone-form" id="PayzonePaymentForm" name="PayzonePaymentForm" target="_self" method="POST" style="display: block;" action="https://mms.payzoneonlinepayments.com/Pages/PublicPages/TransparentRedirect.aspx">
    
    <!-- Transaction details -->
    <input type="hidden" name="MerchantID" value="<?= $merchantid ?>">
    <input type="hidden" name="HashDigest" value="<?= $HashDigest ?>">
    <input type="hidden" name="TransactionType" value="<?= $transactiontype ?>">
    <input type="hidden" name="CallbackURL" value="<?= $callbackurl ?>">

    <!-- Payment details -->
    <input type="hidden" name="Amount" value="<?= $_POST['Amount'] ?>">
    <input type="hidden" name="CurrencyCode" value="<?= $_POST['CurrencyCode']  ?>">
    <input type="hidden" name="OrderID" value="<?= $_POST['OrderID']  ?>">
    <input type="hidden" name="TransactionDateTime" value="<?= $_POST['TransactionDateTime']  ?>">
    <input type="hidden" name="OrderDescription" value="<?= $_POST['OrderDescription']  ?>">

    <!-- Card details -->
    <input type="hidden" name="CardName" value="<?= $_POST['CardName'] ?>">
    <input type="hidden" name="CardNumber" value="<?= $_POST['CardNumber'] ?>">
    <input type="hidden" name="CV2" value="<?= $_POST['CV2'] ?>">
    <input type="hidden" name="ExpiryDateMonth" value="<?= $_POST['ExpiryDateMonth'] ?>">
    <input type="hidden" name="ExpiryDateYear" value="<?= $_POST['ExpiryDateYear'] ?>">

    <!-- Customer Details -->
    <input type="hidden" name="Address1" value="<?= $_POST['Address1'] ?>">
    <input type="hidden" name="Address2" value="<?= $_POST['Address2'] ?>">
    <input type="hidden" name="Address3" value="<?= $_POST['Address3'] ?>">
    <input type="hidden" name="Address4" value="<?= $_POST['Address4'] ?>">
    <input type="hidden" name="City" value="<?= $_POST['City'] ?>">
    <input type="hidden" name="State" value="<?= $_POST['State'] ?>">
    <input type="hidden" name="PostCode" value="<?= $_POST['PostCode'] ?>">
    <input type="hidden" name="CountryCode" value="<?= $_POST['CountryCode'] ?>">

    <!-- Response options -->
    <input type="hidden" name="EchoAVSCheckResult" value="<?= $echoavs ?>">
    <input type="hidden" name="EchoCV2CheckResult" value="<?= $echocv2 ?>">
    <input type="hidden" name="EchoThreeDSecureAuthenticationCheckResult" value="<?= $echothreed ?>">
    <input type="hidden" name="EchoCardType" value="<?= $echocardtype ?>">

</form>
<script type='text/javascript'>
    window.addEventListener('load', function() {
        document.PayzonePaymentForm.submit();
    });
</script>