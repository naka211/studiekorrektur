<?php
defined('_JEXEC') or die('');

$orderid = JRequest::getVar('virtuemart_order_id');
$session = JFactory::getSession();
if(!class_exists('VmModel'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmmodel.php');
$orderModel=VmModel::getModel('orders');
$order = $orderModel->getOrder($orderid);

$pm = $order['details']['BT']->virtuemart_paymentmethod_id;

$siteURL = JURI::base();

$protocol = '7';
$msgtype = 'authorize';
$merchant = '21218146';
$language = 'da';
$ordernumber = $order['details']['BT']->order_number;
$amount = $order['details']['BT']->order_total * 100;

$currency = 'DKK';
$continueurl = $siteURL . 'index.php?option=com_virtuemart&view=vmplg&task=pluginResponseReceived&pm='.$pm.'&ordernumber='.$ordernumber.'&virtuemart_order_id='.$orderid;
$cancelurl = $siteURL . 'index.php?option=com_virtuemart&view=vmplg&task=pluginUserPaymentCancel&on='.$ordernumber.'&pm='.$pm;
$callbackurl = $siteURL . 'index.php?option=com_virtuemart&view=vmplg&task=pluginNotification&tmpl=component&sessionid='.$session->getId();
                
$autocapture = '0';
//$cardtypelock = 'dankort, danske-dk, mastercard, mastercard-dk, american-express, american-express-dk, diners, diners-dk, edankort, fbg1886, jcb, mastercard-debet-dk, nordea-dk, visa, visa-dk, visa-electron, visa-electron-dk';
$cardtypelock = '';
$testmode = 1;
$splitpayment = 0;
$md5word = '24a9b705ee7d64f5bbd26033ab3bb25e1990aab9a3c4137a9e8d9efc6fbd9526';
$md5check = md5($protocol . $msgtype . $merchant . $language . $ordernumber . $amount . $currency . $continueurl . $cancelurl . $callbackurl . $autocapture . $cardtypelock . $testmode. $splitpayment . $md5word);
?>

<section class="main-content">
	<div class="container">
    Din ordre overfører til Quickpay.....
    </div>
    <form action="https://secure.quickpay.dk/form/" method="post" id="QuickpayForm">
    <input type="hidden" name="protocol" value="<?php echo $protocol ?>" />
    <input type="hidden" name="msgtype" value="<?php echo $msgtype ?>" />
    <input type="hidden" name="merchant" value="<?php echo $merchant ?>" />
    <input type="hidden" name="language" value="<?php echo $language ?>" />
    <input type="hidden" name="ordernumber" value="<?php echo $ordernumber;?>" />
    <input type="hidden" name="amount" value="<?php echo $amount;?>" />
    <input type="hidden" name="currency" value="<?php echo $currency;?>" />
    <input type="hidden" name="continueurl" value="<?php echo $continueurl;?>" />
    <input type="hidden" name="cancelurl" value="<?php echo $cancelurl;?>" />
    <input type="hidden" name="callbackurl" value="<?php echo $callbackurl;?>" />
    <input type="hidden" name="autocapture" value="<?php echo $autocapture;?>" />
    <input type="hidden" name="cardtypelock" value="<?php echo $cardtypelock;?>" />
    <input type="hidden" name="splitpayment" value="<?php echo $splitpayment;?>" />
    <input type="hidden" name="testmode" value="<?php echo $testmode;?>" />
    <input type="hidden" name="md5check" value="<?php echo $md5check;?>" />
    </form>
</section>
<script language="javascript">
jQuery("#QuickpayForm").submit();
</script>