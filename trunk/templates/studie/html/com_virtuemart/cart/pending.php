<?php 
defined ('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
$user = JFactory::getUser();
$db = JFactory::getDBO();
JFactory::getDocument()->setTitle('Igangværende');
//print_r($user);exit;
if($user->guest){
	echo "<script>location.href='".JURI::base()."index.php?option=com_users&view=login'</script>";
	exit;
}

$finish_link = JRoute::_('index.php?option=com_virtuemart&view=cart&layout1=finish');

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
		
		jQuery('input').on('change invalid', function() {
			var textfield = jQuery(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst udfyld dette felt');  
			}
		});
    });
</script>
<style>
input[type='file'] {opacity:1;}
</style>
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
					<p><a class="active">Igangværende</a> - <a href="<?php echo $finish_link;?>">Færdig</a></p>
				</div>
			</div>
		</div>
		<?php if($orders_arr){?>
		<div class="row">
			<div class="panel-group" id="accordion">
				<?php foreach($orders_arr as $orderid){
					$order = $orderModel->getOrder($orderid->virtuemart_order_id);//print_r($order);exit;
					$itemNum = count($order['items']);
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $order['details']['BT']->virtuemart_order_id;?>">
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
					<div id="collapse<?php echo $order['details']['BT']->virtuemart_order_id;?>" class="panel-collapse collapse">
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
									<tr class="bor-b">
										<td><?php echo $item->order_item_name;?></td>
										<td class="text-center"><?php if($item->virtuemart_product_id != 5)echo $item->product_quantity;?></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
							<div class="row">
								<div class="col-md-6">
									<p>Word file: <?php echo $order['details']['BT']->danish_file;?> <a class="btnDownload" href="<?php echo JURI::base().'images/original_file/'.$order['details']['BT']->danish_file;?>">Download</a></p>
									<?php if($order['details']['BT']->english_file){?>
									<p>Abstract file: <?php echo $order['details']['BT']->english_file;?> <a class="btnDownload" href="<?php echo JURI::base().'images/original_file/'.$order['details']['BT']->english_file;?>">Download</a></p>
									<?php }?>
									<p><strong>Kommentar</strong>: <?php echo $order["details"]["BT"]->comment;?></p>
								</div>
								<div class="col-md-6">
									<form action="index.php" method="post" enctype="multipart/form-data" class="form-validate">
									<p>Edited word fil: <span><?php echo $order['details']['BT']->danish_edited_file;?></span></p>
									<input class="mb10 required" type="file" name="danish_file">
									<?php if($itemNum>1){?>
									<p>Edited abstract fil: <span><?php echo $order['details']['BT']->english_edited_file;?></span></p>
									<input  class="mb10 required" type="file" name="english_file">
									<?php }?>
									<!--<a class="btn btnUpload" href="#">Upload</a>-->
									<button class="btn btnUpload validate">Upload</button>
									<input type="hidden" name="option" value="com_virtuemart">
									<input type="hidden" name="view" value="cart">
									<input type="hidden" name="task" value="uploadFile">
									<input type="hidden" name="order_id" value="<?php echo $order['details']['BT']->virtuemart_order_id;?>" />
									</form>
									<?php 
										$disable = true;
										if($itemNum=1 && $order['details']['BT']->danish_edited_file){
											$disable = false;
										}
										if($itemNum>1 && $order['details']['BT']->danish_edited_file && $order['details']['BT']->english_edited_file){
											$disable = false;
										}
										if($disable){
									?>
									<a class="btn btn-default disabled" href="#">Indsend færdig opgave</a>
									<?php } else {?>
									<a class="btn btnSendmail" href="index.php?option=com_virtuemart&view=cart&task=sendEmail&order_id=<?php echo $order['details']['BT']->virtuemart_order_id;?>">Indsend færdig opgave</a>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<?php } else {?>
		Ingen opgaver!
		<?php }?>
	</div>
</section>

