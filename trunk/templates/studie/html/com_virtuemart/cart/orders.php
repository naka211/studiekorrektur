<?php 
defined ('_JEXEC') or die('Restricted access');
$user = JFactory::getUser();
$db = JFactory::getDBO();
//print_r($user);exit;
if($user->guest){
	echo "<script>location.href='".JURI::base()."index.php?option=com_users&view=login'</script>";
	exit;
}

if(!JRequest::getVar("status")){
	$link = JRoute::_('index.php?option=com_virtuemart&view=cart&layout1=orders&status=1');
	$menuTxt = '<a class="active">Igangværende</a> - <a href="'.$link.'">Færdig</a>';
} else {
	$link = JRoute::_('index.php?option=com_virtuemart&view=cart&layout1=orders&status=0');
	$menuTxt = '<a href="'.$link.'">Igangværende</a> - <a class="active">Færdig</a>';
}

$query = "SELECT virtuemart_order_id FROM #__virtuemart_order_userinfos WHERE finish IS NULL AND freelance_id = ".$user->id." ORDER BY virtuemart_order_id DESC";
$db->setQuery($query);
$orders_arr = $db->loadObjectList();
if($orders_arr){
	$orderModel=VmModel::getModel('orders');
}
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery("nav.navbar").remove();
		jQuery("footer").remove();
    });
</script>
<section>
	<div class="container text-center">
		<a href="index.php"><img src="templates/studie/img/logo.png" alt=""></a>
	</div>
</section>
<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pad0">
				<div class="pull-right text-right box-right">
					<p>Velkommen <?php echo $user->name;?> - <a class="btnLogout" href="index.php?option=com_users&task=user.logout&return=<?php echo base64_encode(JRoute::_("index.php?option=com_users&view=login"));?>">Logout</a></p>
					<p><?php echo $menuTxt;?></p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="panel-group" id="accordion">
			
				<?php foreach($orders_arr as $orderid){
					$order = $orderModel->getOrder($orderid->virtuemart_order_id);
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								<div class="row">
									<div class="col-md-3">
										<p>Dit ordrenr. er <?php echo $order['details']['BT']->order_number;?></p>
									</div>
									<div class="col-md-3">
										<p>Sprog: <?php echo $order['details']['BT']->language;?></p>
									</div>
									<div class="col-md-4">
										<p>Leveringstidspunkt: <?php echo $order['details']['BT']->delivery_date;?></p>
									</div>
									<div class="col-md-2 text-right">
										<p><i class="fa fa-angle-right fa-lg"></i></p>
									</div>
								</div>
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<table class="table mt20">
								<thead>
									<tr>
										<th>Produkt</th>
										<th class="text-center">Antal normalsider</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($order['items'] as $item){?>
									<tr>
										<td><?php echo $item->order_item_name;?></td>
										<td class="text-center"><?php if($item->virtuemart_product_id != 5)echo $item->product_quantity;?></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
							<div class="row">
								<div class="col-md-8">
									<p>Word file: <?php echo $order['details']['BT']->danish_file;?> <a class="btnDownload" href="<?php echo JURI::base().'images/original_file/'.$order['details']['BT']->danish_file;?>">Download</a></p>
									<?php if($order['details']['BT']->english_file){?>
									<p>Abstract file: <?php echo $order['details']['BT']->english_file;?> <a class="btnDownload" href="<?php echo JURI::base().'images/original_file/'.$order['details']['BT']->english_file;?>">Download</a></p>
									<?php }?>
								</div>
								<div class="col-md-4">
									<p>File navn: <span>Premiumkorrektur</span></p>
									<input class="mb10" type="file">
									<p>File navn: <span>Premiumkorrektur</span></p>
									<input  class="mb10" type="file">
									<a class="btn btnUpload" href="#">Upload</a>
									<a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				
				
			</div>
		</div>
	</div>
</section>

