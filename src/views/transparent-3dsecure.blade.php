<?php
//Create & submit the 3D Secure request form - if PaREQ is set as as POST'd variable then the 
//acquirer has requested 3D Secure authentication.
//Set form to automatically submit
if (isset($_POST['PaREQ'])){
?>
<form id="PayzonePaReqForm" name="PayzonePaReqForm" method="post" action='<?= $_POST["ACSURL"] ?>' target="ACSFrame" >
    <input type="hidden" name="PaReq" value="<?= $_POST["PaREQ"] ?>" />
    <input type="hidden" name="MD" value="<?= $_POST["CrossReference"] ?>" />
    <input type="hidden" name="TermUrl" value='<?= $PayzoneHelper->getSiteUrl()."callback.php" ?>' />
</form>
<iframe  src='/incs/payzone/loading.svg'  id="ACSFrame" name="ACSFrame" src="" width="100%" height="400" frameborder="0"  scrolling='no'></iframe>
<script type='text/javascript'>
window.addEventListener('load', function() {
    document.PayzonePaReqForm.submit();
});
</script>
<?php
}
?>

<?php
//create & submit the 3D Secure process form - if PaRes is set as as POST'd variable then the 
//3D secure has completed and is sending the response for processing
//Set form to automatically submit
if (isset($_POST['PaRes'])){
?>
<form   id="PayzonePaResForm"   name="PayzonePaResForm" method="post" action='https://mms.payzoneonlinepayments.com/Pages/PublicPages/TransparentRedirect.aspx' target="_parent" >
    <input type="hidden" name="PaRES" value="<?= $_POST["PaRes"] ?>" />
    <input type="hidden" name="CrossReference" value="<?= $_POST["MD"] ?>" />
    <input type="hidden" name="CallbackURL" value='<?= $PayzoneHelper->getSiteUrl()."callback.php" ?>' />
    <input type="hidden" name="HashDigest" value="<?= $hashdigest ?>" />
    <input type="hidden" name="MerchantID" value="<?= $merchantid ?>" />
    <input type="hidden" name="TransactionDateTime" value="<?= $transactiondatetime ?>" />
</form>
<iframe src='/incs/payzone/loading.svg' id="ACSFrame" name="ACSFrame" src="" width="100%" height="400" frameborder="0" scrolling='no'></iframe>
<script type='text/javascript'>
window.addEventListener('load', function() {
    document.PayzonePaResForm.submit();
});
</script>
<?php
}
?>