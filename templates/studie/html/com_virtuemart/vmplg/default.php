<?php
defined('_JEXEC') or die('Restricted access');

$order_number = JRequest::getVar('ordernumber');
$db = JFactory::getDBO();

$query = "SELECT virtuemart_order_id FROM #__virtuemart_orders WHERE order_number = '".$order_number."'";
$db->setQuery($query);
$orderid = $db->loadResult();

if(!class_exists('VmModel'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmmodel.php');
$orderModel=VmModel::getModel('orders');
$order = $orderModel->getOrder($orderid);

/*if($order['details']['BT']->order_status != "C"){
	if (!class_exists('VirtueMartModelOrders')) require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );
	$modelOrder = VmModel::getModel('orders');	
	$order1 = array();		
	$order1['order_status'] = "C";
	$order1['customer_notified'] =1;
	$modelOrder->updateStatusForOneOrder($orderid, $order1, true);
}*/

$query = "SELECT * FROM #__virtuemart_order_userinfos WHERE address_type = 'BT' AND virtuemart_order_id = ".$orderid;
$db->setQuery($query);
$BT_info = $db->loadObject();

$cart = VirtueMartCart::getCart();
$cart->emptyCart();
?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-center">
				<li>Bestilling</li>
				<li>Indkøbskurv</li>
				<li>Upload</li>
				<li>Betaling</li>
				<li class="active"><a>Kvittering</a></li>
			</ul>
		</div>
		<div class="row mb100">
			<div class="col-md-8 pr40">
				<h3>Tak for din ordre </h3>
				<p class="mb20">Kære <?php echo $BT_info->first_name." ".$BT_info->last_name;?>,</p>
				<p>Tak for din ordre!<br>
				Vi har modtaget din bestilling og den uploadede fil.<br>
				Dit ordrenr. er <?php echo $order["details"]["BT"]->order_number;?> - du modtager også denne ordrebekræftelse på mail.</p>
				<p>Sprog: <?php echo $BT_info->language;?></p>
				<p>Leveringstidspunkt: <?php echo $BT_info->delivery_date;?></p>
				<table class="table mt20">
					<thead>
						<tr>
							<th>Produkt</th>
							<th class="text-center">Antal normalsider</th>
							<th class="text-center">Stk. Pris</th>
							<th class="text-right">Pris</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($order['items'] as $item){?>
						<tr class="bor-b">
							<td><?php echo $item->order_item_name;?></td>
							<td class="text-center"><?php if($item->virtuemart_product_id != 5) echo $item->product_quantity;?></td>
							<td class="text-center"><?php if($item->virtuemart_product_id != 5) echo number_format($item->product_final_price,2,',','.').' DKK'; ?></td>
							<td class="text-right"><?php echo number_format($item->product_subtotal_with_tax,2,',','.').' DKK'; ?></td>
						</tr>
						<?php }?>
						<?php if($order["details"]["BT"]->coupon_code){?>
						<tr class="bor-b0">
							<td colspan="2"><strong>Rabat</strong></td>
							<td colspan="2" class="text-right"><strong><?php echo $order["details"]["BT"]->coupon_discount;?> DKK</strong></td>
						</tr>
						<?php }?>
						<tr class="bor-b">
							<td colspan="2"><strong>Pris i alt (inkl. moms):</strong></td>
							<td colspan="2" class="text-right"><strong><?php echo number_format($order["details"]["BT"]->order_total,2,',','.').' DKK'; ?></strong></td>
						</tr>
						<tr class="bor-b0">
							<td colspan="4">
								<p>Du er velkommen til at kontakte os på info@studiekorrektur.dk eller +45 3029 6044, hvis du skulle have spørgsmål.<br>
								Du ønskes en god dag!</p><br>
								<p>De bedste hilsener,<br>
								Teamet bag Studiekorrektur.dk</p>
								<a class="btn btnHome" href="index.php">Til forside</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>
</section>