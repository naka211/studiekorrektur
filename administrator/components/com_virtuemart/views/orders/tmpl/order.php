<?php
/**
 * Display form details
 *
 * @package	VirtueMart
 * @subpackage Orders
 * @author Oscar van Eijk
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: order.php 8536 2014-10-29 10:37:31Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

AdminUIHelper::startAdminArea($this);
AdminUIHelper::imitateTabs('start','COM_VIRTUEMART_ORDER_PRINT_PO_LBL');

// Get the plugins
JPluginHelper::importPlugin('vmshopper');
JPluginHelper::importPlugin('vmshipment');
JPluginHelper::importPlugin('vmpayment');

vmJsApi::addJScript( 'orderedit',"
		jQuery( function($) {

			$('.orderedit').hide();
			$('.ordereditI').show();
			$('.orderedit').css('backgroundColor', 'lightgray');

			jQuery('.updateOrderItemStatus').click(function() {
				document.orderItemForm.task.value = 'updateOrderItemStatus';
				document.orderItemForm.submit();
				return false
			});

			jQuery('select#virtuemart_paymentmethod_id').change(function(){
				jQuery('span#delete_old_payment').show();
				jQuery('input#delete_old_payment').attr('checked','checked');
			});

		});

		function enableEdit(e)
		{
			jQuery('.orderedit').each( function()
			{
				var d = jQuery(this).css('visibility')=='visible';
				jQuery(this).toggle();
				jQuery('.orderedit').css('backgroundColor', d ? 'white' : 'lightgray');
				jQuery('.orderedit').css('color', d ? 'blue' : 'black');
			});
			jQuery('.ordereditI').each( function()
			{
				jQuery(this).toggle();
			});
			e.preventDefault();
		};

		function addNewLine(e,i) {

			var row = jQuery('#itemTable').find('tbody tr:first').html();
			var needle = 'item_id['+i+']';
			//var needle = new RegExp('item_id['+i+']','igm');
			while (row.contains(needle)){
				row = row.replace(needle,'item_id[0]');
			}

			//alert(needle);
			jQuery('#itemTable').find('tbody').prepend('<tr>'+row+'</tr>');
			e.preventDefault();
		};

		function cancelEdit(e) {
			jQuery('#orderItemForm').each(function(){
				this.reset();
			});
			jQuery('.selectItemStatusCode')
				.find('option:selected').prop('selected', true)
				.end().trigger('liszt:updated');
			jQuery('.orderedit').hide();
			jQuery('.ordereditI').show();
			e.preventDefault();
		}

		function resetOrderHead(e) {
			jQuery('#orderForm').each(function(){
				this.reset();
			});
			jQuery('select#virtuemart_paymentmethod_id')
				.find('option:selected').prop('selected', true)
				.end().trigger('liszt:updated');
			jQuery('select#virtuemart_shipmentmethod_id')
				.find('option:selected').prop('selected', true)
				.end().trigger('liszt:updated');
			e.preventDefault();
		}

		");

?>
<div style="text-align: left;">
<form name='adminForm' id="adminForm">
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="orders" />
		<input type="hidden" name="virtuemart_order_id" value="<?php echo $this->orderID; ?>" />
		<?php echo JHtml::_( 'form.token' ); ?>


<table class="adminlist table table-striped" width="100%">
	<tr>
		<td width="100%">
		<?php echo $this->displayDefaultViewSearch ('COM_VIRTUEMART_ORDER_PRINT_NAME'); ?>
			<span class="btn btn-small " >
		<a class="updateOrder" href="#"><span class="icon-nofloat vmicon vmicon-16-save"></span>
		<?php echo vmText::_('COM_VIRTUEMART_ORDER_SAVE_USER_INFO'); ?></a></span>
		&nbsp;&nbsp;
				<span class="btn btn-small " >
		<a href="#" onClick="javascript:resetOrderHead(event);" ><span class="icon-nofloat vmicon vmicon-16-cancel"></span>
		<?php echo vmText::_('COM_VIRTUEMART_ORDER_RESET'); ?></a>
					</span>
		<!--
		&nbsp;&nbsp;
		<a class="createOrder" href="#"><span class="icon-nofloat vmicon vmicon-16-new"></span>
		<?php echo vmText::_('COM_VIRTUEMART_ORDER_CREATE'); ?></a>
		-->
		</td>
	</tr>
</table>
</form>

<table class="adminlist table" style="table-layout: fixed;">
	<tr>
		<td valign="top">
		<table class="adminlist" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th colspan="2"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_LBL') ?></th>
			</tr>
			</thead>
			<?php
				$print_url = juri::root().'index.php?option=com_virtuemart&view=invoice&layout=invoice&tmpl=component&virtuemart_order_id=' . $this->orderbt->virtuemart_order_id . '&order_number=' .$this->orderbt->order_number. '&order_pass=' .$this->orderbt->order_pass;
				$print_link = "<a title=\"".vmText::_('COM_VIRTUEMART_PRINT')."\" href=\"javascript:void window.open('$print_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\"  >";
				$print_link .=   $this->orderbt->order_number . ' </a>';
			?>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_NUMBER') ?></strong></td>
				<td><?php echo  $print_link;?></td>
			</tr>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_PASS') ?></strong></td>
				<td><?php echo  $this->orderbt->order_pass;?></td>
			</tr>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_DATE') ?></strong></td>
				<td><?php  echo vmJsApi::date($this->orderbt->created_on,'LC2',true); ?></td>
			</tr>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_STATUS') ?></strong></td>
				<td><?php echo $this->orderstatuslist[$this->orderbt->order_status]; ?></td>
			</tr>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_NAME') ?></strong></td>
				<td><?php
						$username=$this->orderbt->company ? $this->orderbt->company." ":"";
						$username.=$this->orderbt->first_name." ".$this->orderbt->last_name." ";
					if ($this->orderbt->virtuemart_user_id) {
						$userlink = JROUTE::_ ('index.php?option=com_virtuemart&view=user&task=edit&virtuemart_user_id[]=' . $this->orderbt->virtuemart_user_id);
						echo JHtml::_ ('link', JRoute::_ ($userlink), $username, array('title' => vmText::_ ('COM_VIRTUEMART_ORDER_EDIT_USER') . ' ' . $username));
					} else {
						echo $this->orderbt->first_name.' '.$this->orderbt->last_name;
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_IPADDRESS') ?></strong></td>
				<td><?php echo $this->orderbt->ip_address; ?></td>
			</tr>
			<?php
			if ($this->orderbt->coupon_code) { ?>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_COUPON_CODE') ?></strong></td>
				<td><?php echo $this->orderbt->coupon_code; ?></td>
			</tr>
			<?php } ?>
			<?php
			if ($this->orderbt->invoiceNumber and !shopFunctions::InvoiceNumberReserved($this->orderbt->invoiceNumber) ) {
				$invoice_url = juri::root().'index.php?option=com_virtuemart&view=invoice&layout=invoice&format=pdf&tmpl=component&virtuemart_order_id=' . $this->orderbt->virtuemart_order_id . '&order_number=' .$this->orderbt->order_number. '&order_pass=' .$this->orderbt->order_pass;
				$invoice_link = "<a title=\"".vmText::_('COM_VIRTUEMART_INVOICE_PRINT')."\"  href=\"javascript:void window.open('$invoice_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\"  >";
				$invoice_link .=   $this->orderbt->invoiceNumber . '</a>';?>
			<tr>
				<td class="key"><strong><?php echo vmText::_('COM_VIRTUEMART_INVOICE') ?></strong></td>
				<td><?php echo $invoice_link; ?></td>
			</tr>
			<?php } ?>
		</table>
		</td>
		<td valign="top">
		<table class="adminlist table">
			<thead>
				<tr>
					<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_HISTORY_DATE_ADDED') ?></th>
					<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_HISTORY_CUSTOMER_NOTIFIED') ?></th>
					<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_LIST_STATUS') ?></th>
					<th><?php echo vmText::_('COM_VIRTUEMART_COMMENT') ?></th>
				</tr>
			</thead>
			<?php
			foreach ($this->orderdetails['history'] as $this->orderbt_event ) {
				echo "<tr >";
				echo "<td class='key'>". vmJsApi::date($this->orderbt_event->created_on,'LC2',true) ."</td>\n";
				if ($this->orderbt_event->customer_notified == 1) {
					echo '<td align="center">'.vmText::_('COM_VIRTUEMART_YES').'</td>';
				}
				else {
					echo '<td align="center">'.vmText::_('COM_VIRTUEMART_NO').'</td>';
				}
				if(!isset($this->orderstatuslist[$this->orderbt_event->order_status_code])){
					if(empty($this->orderbt_event->order_status_code)){
						$this->orderbt_event->order_status_code = 'unknown';
					}
					$this->orderstatuslist[$this->orderbt_event->order_status_code] = vmText::_('COM_VIRTUEMART_UNKNOWN_ORDER_STATUS');
				}

				echo '<td align="center">'.$this->orderstatuslist[$this->orderbt_event->order_status_code].'</td>';
				echo "<td>".$this->orderbt_event->comments."</td>\n";
				echo "</tr>\n";
			}
			?>
			<tr>
				<td colspan="4">
				<a href="#" class="show_element"><span class="vmicon vmicon-16-editadd"></span><?php echo vmText::_('COM_VIRTUEMART_ORDER_UPDATE_STATUS') ?></a>
				<div style="display: none; background: white; z-index: 100;"
					class="element-hidden vm-absolute"
					id="updateOrderStatus"><?php echo $this->loadTemplate('editstatus'); ?>
				</div>
				</td>
			</tr>

			<?php
				// Load additional plugins
				$_dispatcher = JDispatcher::getInstance();
				$_returnValues1 = $_dispatcher->trigger('plgVmOnUpdateOrderBEPayment',array($this->orderID));
				$_returnValues2 = $_dispatcher->trigger('plgVmOnUpdateOrderBEShipment',array(  $this->orderID));
				$_returnValues = array_merge($_returnValues1, $_returnValues2);
				$_plg = '';
				foreach ($_returnValues as $_returnValue) {
					if ($_returnValue !== null) {
						$_plg .= ('	<td colspan="4">' . $_returnValue . "</td>\n");
					}
				}
				if ($_plg !== '') {
					echo "<tr>\n$_plg</tr>\n";
				}
			?>

		</table>
		</td>
	</tr>
</table>

<form action="index.php" method="post" name="orderForm" id="orderForm"><!-- Update order head form -->
<table class="adminlist table" >
	<?php // if ($this->orderbt->customer_note || true) {
	if(true){ ?>
	<tr>
		<td valign="top" width="50%">
					<table class="adminlist" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
						<th colspan="2"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_SHIPMENT') ?></th>
						</tr>
						</thead>
					<tr>
						<td><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL') ?></td>
						<?php
						$model = VmModel::getModel('paymentmethod');
						$payments = $model->getPayments();
						$model = VmModel::getModel('shipmentmethod');
						$shipments = $model->getShipments();
						?>
						<td>
							<input  type="hidden" size="10" name="virtuemart_paymentmethod_id" value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>"/>
							<!--
							<? echo VmHTML::select("virtuemart_paymentmethod_id", $payments, $this->orderbt->virtuemart_paymentmethod_id, '', "virtuemart_paymentmethod_id", "payment_name"); ?>
							<span id="delete_old_payment" style="display: none;"><br />
								<input id="delete_old_payment" type="checkbox" name="delete_old_payment" value="1" /> <label class='' for="" title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_DELETE_DESC'); ?>"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_DELETE'); ?></label>
							</span>
							-->
							<?php
							foreach($payments as $payment) {
								if($payment->virtuemart_paymentmethod_id == $this->orderbt->virtuemart_paymentmethod_id) echo $payment->payment_name;
							}
							?>
						</td>
					</tr>
					<tr>
						<td><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPMENT_LBL') ?></td>
						<td>
							<input type="hidden" size="10" name="virtuemart_shipmentmethod_id" value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>"/>
							<!--
							<? echo VmHTML::select("virtuemart_shipmentmethod_id", $shipments, $this->orderbt->virtuemart_shipmentmethod_id, '', "virtuemart_shipmentmethod_id", "shipment_name"); ?>
							<span id="delete_old_shipment" style="display: none;"><br />
								<input id="delete_old_shipment" type="checkbox" name="delete_old_shipment" value="1" /> <label class='' for=""><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?></label>
							</span>
							-->
							<?php
							foreach($shipments as $shipment) {
								if($shipment->virtuemart_shipmentmethod_id == $this->orderbt->virtuemart_shipmentmethod_id) echo $shipment->shipment_name;
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="key"><?php echo vmText::_('COM_VIRTUEMART_DELIVERY_DATE') ?></td>
						<td><input type="text" maxlength="190" class="required" value="<?php echo $this->orderbt->delivery_date; ?>" size="30" name="delivery_date" id="delivery_date_field"></td>
					</tr>
					</table>
				</td>
	</tr>
	<?php } ?>
</table>
&nbsp;
<table width="100%">
	<tr>
		<td width="50%" valign="top">
		<table class="adminlist table">
			<thead>
				<tr>
					<th  style="text-align: center;" colspan="2"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_BILL_TO_LBL') ?></th>
				</tr>
			</thead>

			<?php
			foreach ($this->userfields['fields'] as $_field ) {

				echo '		<tr>'."\n";
				echo '			<td class="key">'."\n";
				echo '				<label for="'.$_field['name'].'_field">'."\n";
				echo '					'.$_field['title'] . ($_field['required']?' *': '')."\n";
				echo '				</label>'."\n";
				echo '			</td>'."\n";
				echo '			<td>'."\n";
				echo '				'.$_field['formcode']."\n";
				//T.Trung
				if($_field["name"] == "BT_danish_file") echo '<a href="'.JURI::root().'images/original_file/'.$_field["value"].'">Download</a>';
				if($_field["name"] == "BT_english_file") echo '<a href="'.JURI::root().'images/original_file/'.$_field["value"].'">Download</a>';
				//T.Trung end
				echo '			</td>'."\n";
				echo '		</tr>'."\n"; //*/
			/*	$fn = $_field['name'];
				$fv = $_field['value'];
				$ft = $_field['title'];
				echo '		<tr>'."\n";
				echo '			<td class="key">'."\n";
				echo '				'.$ft."\n";
				echo '			</td>'."\n";
				echo '			<td>'."\n";
				echo "				<input name='BT_$fn' id='$fn' value='$fv' size='50'>\n";
				echo '			</td>'."\n";
				echo '		</tr>'."\n";*/
			}
			?>

		</table>
		
		</td>
		<td width="50%" valign="top">
		<table class="adminlist table">
			<thead>
				<tr>
					<th   style="text-align: center;" colspan="2"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIP_TO_LBL') ?></th>
				</tr>
			</thead>

			<?php
			foreach ($this->shipmentfields['fields'] as $_field ) {
				echo '		<tr>'."\n";
				echo '			<td class="key">'."\n";
				echo '				<label for="'.$_field['name'].'_field">'."\n";
				echo '					'.$_field['title'] . ($_field['required']?' *': '')."\n";
				echo '				</label>'."\n";
				echo '			</td>'."\n";
				echo '			<td>'."\n";
				echo '				'.$_field['formcode']."\n";
				echo '			</td>'."\n";
				echo '		</tr>'."\n";
			}
			?>

		</table>
		</td>
	</tr>
</table>
		<input type="hidden" name="task" value="updateOrderHead" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="orders" />
		<input type="hidden" name="virtuemart_order_id" value="<?php echo $this->orderID; ?>" />
		<input type="hidden" name="old_virtuemart_paymentmethod_id" value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>" />
		<input type="hidden" name="old_virtuemart_shipmentmethod_id" value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
</form>
<form action="index.php" method="post" enctype="multipart/form-data">
	Edited file <input type="file" name="danish_edited_file" value="" /><br>
	<input type="submit" value="Upload" name="submit" />
	<input type="hidden" name="option" value="com_virtuemart">
	<input type="hidden" name="view" value="orders">
	<input type="hidden" name="task" value="uploadFile">
	<input type="hidden" name="orderId" value="<?php echo JRequest::getVar("virtuemart_order_id");?>" />
</form>
<br>
<?php 
if(!$this->userfields['fields']['finish']['value']){
$db = JFactory::getDBO();
$q = "SELECT u.id, u.name FROM #__users u INNER JOIN #__user_usergroup_map um ON u.id = um.user_id WHERE u.block = 0 AND um.group_id = 2";
$db->setQuery($q);
$users = $db->loadObjectList();

$cur_user = $this->userfields['fields']['freelance_id']['value'];
?>
<form action="index.php" method="post">
	<span style="display:block;">User freelancer</span> 
	<select name="user_id">
		<?php foreach($users as $user){?>
		<option value="<?php echo $user->id;?>" <?php if($user->id == $cur_user) echo 'selected';?>><?php echo $user->name;?></option>
		<?php }?>
	</select>
	<br />
	<input type="submit" value="Change user" name="submit" />
	<input type="hidden" name="option" value="com_virtuemart">
	<input type="hidden" name="view" value="orders">
	<input type="hidden" name="task" value="changeUser">
	<input type="hidden" name="curr_user_id" value="<?php echo $cur_user;?>" />
	<input type="hidden" name="orderId" value="<?php echo JRequest::getVar("virtuemart_order_id");?>" />
</form>
<?php }?>
<table width="100%">
	<tr>
		<td colspan="2">
		<form action="index.php" method="post" name="orderItemForm" id="orderItemForm"><!-- Update linestatus form -->
		<table class="adminlist table"  id="itemTable" >
			<thead>
				<tr>
					<!--<th class="title" width="5%" align="left"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_ACTIONS') ?></th> -->
					<th class="title" width="3" align="left">#</th>
					<th class="title" width="47" align="left"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_QUANTITY') ?></th>
					<th class="title" width="*" align="left"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_NAME') ?></th>
					<th class="title" width="10%" align="left"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SKU') ?></th>
					<th class="title" width="10%"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_ITEM_STATUS') ?></th>
					<th class="title" width="50"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_NET') ?></th>
					<th class="title" width="50"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASEWITHTAX') ?></th>
					<th class="title" width="50"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_GROSS') ?></th>
					<th class="title" width="50"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_TAX') ?></th>
					<th class="title" width="50"> <?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_DISCOUNT') ?></th>
					<th class="title" width="5%"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></th>
				</tr>
			</thead>
		<?php $i=1;
		foreach ($this->orderdetails['items'] as $item) { ?>
			<!-- Display the order item -->
			<tr valign="top" ><?php /*id="showItem_<?php echo $item->virtuemart_order_item_id; ?>" data-itemid="<?php echo $item->virtuemart_order_item_id; ?>">*/ ?>
				<!--<td>
					<?php $removeLineLink=JRoute::_('index.php?option=com_virtuemart&view=orders&orderId='.$this->orderbt->virtuemart_order_id.'&orderLineId='.$item->virtuemart_order_item_id.'&task=removeOrderItem'); ?>
					<a class="vmicon vmicon-16-bug" title="<?php echo vmText::_('remove'); ?>" onclick="javascript:confirmation('<?php echo $removeLineLink; ?>');"></a>

					<a href="javascript:enableItemEdit(<?php echo $item->virtuemart_order_item_id; ?>)"> <?php echo JHtml::_('image',  'administrator/components/com_virtuemart/assets/images/icon_16/icon-16-category.png', "Edit", NULL, true); ?></a>
				</td> -->
				<td>
					<?php echo ($i++)?>
				</td>
				<td>
					<span class='ordereditI'><?php echo $item->product_quantity; ?></span>
					<input class='orderedit' type="text" size="3" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_quantity]" value="<?php echo $item->product_quantity; ?>"/>
				</td>
				<td>
					<span class='ordereditI'><?php echo $item->order_item_name; ?></span>
					<input class='orderedit' type="text"  name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][order_item_name]" value="<?php echo $item->order_item_name; ?>"/><?php
						//echo $item->order_item_name;
						//if (!empty($item->product_attribute)) {
								if(!class_exists('VirtueMartModelCustomfields'))require(VMPATH_ADMIN.DS.'models'.DS.'customfields.php');
								$product_attribute = VirtueMartModelCustomfields::CustomsFieldOrderDisplay($item,'BE');
							if($product_attribute) echo '<div>'.$product_attribute.'</div>';
						//}
						$_dispatcher = JDispatcher::getInstance();
						$_returnValues = $_dispatcher->trigger('plgVmOnShowOrderLineBEShipment',array(  $this->orderID,$item->virtuemart_order_item_id));
						$_plg = '';
						foreach ($_returnValues as $_returnValue) {
							if ($_returnValue !== null) {
								$_plg .= $_returnValue;
							}
						}
						if ($_plg !== '') {
							echo '<table border="0" celspacing="0" celpadding="0">'
								. '<tr>'
								. '<td width="8px"></td>' // Indent
								. '<td>'.$_plg.'</td>'
								. '</tr>'
								. '</table>';
						}
					?>
					<?php if(empty($item->virtuemart_product_id)) { ?>
						<span class='orderedit'>Product ID:</span>
						<input class='orderedit' type="text" size="10" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][virtuemart_product_id]" value="<?php echo $item->virtuemart_product_id; ?>"/>
					<?php } ?>
				</td>
				<td>
					<span class='ordereditI'><?php echo $item->order_item_sku; ?></span>
					<input class='orderedit' type="text"  name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][order_item_sku]" value="<?php echo $item->order_item_sku; ?>"/>
				</td>
				<td align="center">
					<!--<?php echo $this->orderstatuslist[$item->order_status]; ?><br />-->
					<?php echo $this->itemstatusupdatefields[$item->virtuemart_order_item_id]; ?>

				</td>
				<td align="right" style="padding-right: 5px;">
					<?php
					$item->product_discountedPriceWithoutTax = (float) $item->product_discountedPriceWithoutTax;
					if (!empty($item->product_priceWithoutTax) && $item->product_discountedPriceWithoutTax != $item->product_priceWithoutTax) {
						echo '<span style="text-decoration:line-through">'.$this->currency->priceDisplay($item->product_item_price) .'</span><br />';
						echo '<span >'.$this->currency->priceDisplay($item->product_discountedPriceWithoutTax) .'</span><br />';
					} else {
						echo '<span >'.$this->currency->priceDisplay($item->product_item_price) .'</span><br />'; 
					}
					?>
					<input class='orderedit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_item_price]" value="<?php echo $item->product_item_price; ?>"/>
				</td>
				<td align="right" style="padding-right: 5px;">
					<?php echo $this->currency->priceDisplay($item->product_basePriceWithTax); ?>
					<input class='orderedit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_basePriceWithTax]" value="<?php echo $item->product_basePriceWithTax; ?>"/>
				</td>
				<td align="right" style="padding-right: 5px;">
					<?php echo $this->currency->priceDisplay($item->product_final_price); ?>
					<input class='orderedit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_final_price]" value="<?php echo $item->product_final_price; ?>"/>
				</td>
				<td align="right" style="padding-right: 5px;">
					<?php echo $this->currency->priceDisplay( $item->product_tax); ?>
					<input class='orderedit' type="text" size="12" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_tax]" value="<?php echo $item->product_tax; ?>"/>
					<span style="display: block; font-size: 80%;" title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE_DESC'); ?>">
						<input class='orderedit' type="checkbox" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][calculate_product_tax]" value="1" /> <label class='orderedit' for="calculate_product_tax"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?></label>
					</span>
				</td>
				<td align="right" style="padding-right: 5px;">
					<?php echo $this->currency->priceDisplay( $item->product_subtotal_discount); ?>
					<input class='orderedit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_subtotal_discount]" value="<?php echo $item->product_subtotal_discount; ?>"/>
				</td>
				<td align="right" style="padding-right: 5px;">
					<?php 
					$item->product_basePriceWithTax = (float) $item->product_basePriceWithTax;
					if(!empty($item->product_basePriceWithTax) && $item->product_basePriceWithTax != $item->product_final_price ) {
						echo '<span style="text-decoration:line-through" >'.$this->currency->priceDisplay($item->product_basePriceWithTax,$this->currency,$item->product_quantity) .'</span><br />' ;
					}
					elseif (empty($item->product_basePriceWithTax) && $item->product_item_price != $item->product_final_price) {
						echo '<span style="text-decoration:line-through">' . $this->currency->priceDisplay($item->product_item_price,$this->currency,$item->product_quantity) . '</span><br />';
					}
					echo $this->currency->priceDisplay($item->product_subtotal_with_tax);
					?>
					<input class='orderedit' type="hidden" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_subtotal_with_tax]" value="<?php echo $item->product_subtotal_with_tax; ?>"/>
				</td>
			</tr>

		<?php } ?>
			<tr id="updateOrderItemStatus">

					<td colspan="5">
						<!--
						&nbsp;<a class="newOrderItem" href="#"><span class="icon-nofloat vmicon vmicon-16-new"></span><?php echo vmText::_('COM_VIRTUEMART_NEW_ITEM'); ?></a>
						&nbsp;&nbsp;
						-->
						<a class="updateOrderItemStatus" href="#"><span class="icon-nofloat vmicon vmicon-16-save"></span><?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?></a>
						&nbsp;&nbsp;
						<a href="#" onClick="javascript:cancelEdit(event);" ><span class="icon-nofloat vmicon vmicon-16-remove"></span><?php echo '&nbsp;'. vmText::_('COM_VIRTUEMART_CANCEL'); ?></a>
						&nbsp;&nbsp;
						<a href="#" onClick="javascript:enableEdit(event);"><span class="icon-nofloat vmicon vmicon-16-edit"></span><?php echo '&nbsp;'. vmText::_('COM_VIRTUEMART_EDIT'); ?></a>
						&nbsp;&nbsp;
						<a href="#" onClick="javascript:addNewLine(event,<?php echo $this->orderdetails['items'][0]->virtuemart_order_item_id ?>);"><span class="icon-nofloat vmicon vmicon-16-new"></span><?php echo '&nbsp;'. vmText::_('JTOOLBAR_NEW'); ?></a>
					</td>

					<td colspan="6">
						<?php // echo JHtml::_('image',  'administrator/components/com_virtuemart/assets/images/vm_witharrow.png', 'With selected'); $this->orderStatSelect; ?>
						&nbsp;&nbsp;&nbsp;

					</td>
			</tr>
		<!--/table -->
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="orders" />
		<input type="hidden" name="virtuemart_order_id" value="<?php echo $this->orderID; ?>" />
		<input type="hidden" name="virtuemart_paymentmethod_id" value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>" />
		<input type="hidden" name="virtuemart_shipmentmethod_id" value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>" />
		<input type="hidden" name="order_total" value="<?php echo $this->orderbt->order_total; ?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
		</form> <!-- Update linestatus form -->
		<!--table class="adminlist" cellspacing="0" cellpadding="0" -->
			<tr>
				<td align="left" colspan="1"><?php $editLineLink=JRoute::_('index.php?option=com_virtuemart&view=orders&orderId='.$this->orderbt->virtuemart_order_id.'&orderLineId=0&tmpl=component&task=editOrderItem'); ?>
				<!-- <a href="<?php echo $editLineLink; ?>" class="modal"> <?php echo JHtml::_('image',  'administrator/components/com_virtuemart/assets/images/icon_16/icon-16-editadd.png', "New Item"); ?>
				New Item </a>--></td>
				<td align="right" colspan="4">
				<div align="right"><strong> <?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SUBTOTAL') ?>:
				</strong></div>
				</td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_subtotal); ?></td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td   align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_tax); ?></td>
				<td align="right"> <?php echo $this->currency->priceDisplay($this->orderbt->order_discountAmount); ?></td>
				<td width="15%" align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_salesPrice); ?></td>
			</tr>
			<?php
			/* COUPON DISCOUNT */
			//if (VmConfig::get('coupons_enable') == '1') {

				if ($this->orderbt->coupon_discount > 0 || $this->orderbt->coupon_discount < 0) {
					?>
			<tr>
				<td align="right" colspan="5"><strong><?php echo vmText::_('COM_VIRTUEMART_COUPON_DISCOUNT') ?></strong></td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td   align="right" style="padding-right: 5px;"><?php
				echo $this->currency->priceDisplay($this->orderbt->coupon_discount);  ?></td>
			</tr>
			<?php
				//}
			}?>



	<?php
		foreach($this->orderdetails['calc_rules'] as $rule){
			if ($rule->calc_kind == 'DBTaxRulesBill') { ?>
			<tr >
				<td colspan="5"  align="right"  ><?php echo $rule->calc_rule_name ?> </td>
				<td align="right" colspan="3" > </td>

				<td align="right">
				<!--
					<?php echo  $this->currency->priceDisplay($rule->calc_amount);?>
					<input class='orderedit' type="text" size="8" name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>][calc_tax]" value="<?php echo $rule->calc_amount; ?>"/>
				-->
				</td>
				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?></td>
				<td align="right"  style="padding-right: 5px;">
					<?php echo  $this->currency->priceDisplay($rule->calc_amount);?>
					<input class='orderedit' type="text" size="8" name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]" value="<?php echo $rule->calc_amount; ?>"/>
				</td>
			</tr>
			<?php
			} elseif ($rule->calc_kind == 'taxRulesBill') { ?>
			<tr >
				<td colspan="5"  align="right"  ><?php echo $rule->calc_rule_name ?> </td>
				<td align="right" colspan="3" > </td>
				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?></td>
				<td align="right"> </td>
				<td align="right"  style="padding-right: 5px;">
					<?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?>
					<input class='orderedit' type="text" size="8" name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]" value="<?php echo $rule->calc_amount; ?>"/>
				</td>
			</tr>
			<?php
			 } elseif ($rule->calc_kind == 'DATaxRulesBill') { ?>
			<tr >
				<td colspan="5"   align="right"  ><?php echo $rule->calc_rule_name ?> </td>
				<td align="right" colspan="3" > </td>

				<td align="right"> </td>
				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?></td>
				<td align="right"  style="padding-right: 5px;">
					<?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?>
					<input class='orderedit' type="text" size="8" name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]" value="<?php echo $rule->calc_amount; ?>"/>
				</td>
			</tr>

			<?php
			 }

		}
		?>



			<tr>
				<td align="right" colspan="5"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPPING') ?>:</strong></td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment); ?>
					<input class='orderedit' type="text" size="8" name="order_shipment" value="<?php echo $this->orderbt->order_shipment; ?>"/>
				</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment_tax); ?>
					<input class='orderedit' type="text" size="12" name="order_shipment_tax" value="<?php echo $this->orderbt->order_shipment_tax; ?>"/>
				</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment+$this->orderbt->order_shipment_tax); ?></td>

			</tr>
			 <tr>
				<td align="right" colspan="5"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT') ?>:</strong></td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_payment); ?>
					<input class='orderedit' type="text" size="8" name="order_payment" value="<?php echo $this->orderbt->order_payment; ?>"/>
				</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_payment_tax); ?>
					<input class='orderedit' type="text" size="12" name="order_payment_tax" value="<?php echo $this->orderbt->order_payment_tax; ?>"/>
				</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;"><?php echo $this->currency->priceDisplay($this->orderbt->order_payment+$this->orderbt->order_payment_tax); ?></td>

			 </tr>


			<tr>
				<td align="right" colspan="5"><strong><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?>:</strong></td>
				<td align="right" style="padding-right: 5px;">&nbsp;</td>
				<td align="right" style="padding-right: 5px;">&nbsp;</td>
				<td align="right" style="padding-right: 5px;">&nbsp;</td>
				<td align="right" style="padding-right: 5px;">
					<?php echo $this->currency->priceDisplay($this->orderbt->order_billTaxAmount); ?>
					<input class='orderedit' type="text" size="12" name="order_billTaxAmount" value="<?php echo $this->orderbt->order_billTaxAmount; ?>"/>
					<span style="display: block; font-size: 80%;" title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE_DESC'); ?>">
						<input class='orderedit' type="checkbox" name="calculate_billTaxAmount" value="1" checked /> <label class='orderedit' for="calculate_billTaxAmount"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?></label>
					</span>
				</td>
				<td align="right" style="padding-right: 5px;"><strong><?php echo $this->currency->priceDisplay($this->orderbt->order_billDiscountAmount); ?></strong></td>
				<td align="right" style="padding-right: 5px;"><strong><?php echo $this->currency->priceDisplay($this->orderbt->order_total); ?></strong>
				</td>
			</tr>
			<?php if ($this->orderbt->user_currency_rate != 1.0) { ?>
			<tr>
				<td align="right" colspan="5"><em><?php echo vmText::_('COM_VIRTUEMART_ORDER_USER_CURRENCY_RATE') ?>:</em></td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td  align="right" style="padding-right: 5px;">&nbsp;</td>
				<td   align="right" style="padding-right: 5px;"><em><?php echo  $this->orderbt->user_currency_rate ?></em></td>
			</tr>
			<?php }
			?>
		</table>
		</td>
	</tr>
</table>
&nbsp;
<table width="100%">
	<tr>
		<td valign="top" width="50%"><?php
		JPluginHelper::importPlugin('vmshipment');
		$_dispatcher = JDispatcher::getInstance();
		$returnValues = $_dispatcher->trigger('plgVmOnShowOrderBEShipment',array(  $this->orderID,$this->orderbt->virtuemart_shipmentmethod_id, $this->orderdetails));

		foreach ($returnValues as $returnValue) {
			if ($returnValue !== null) {
				echo $returnValue;
			}
		}
		?>
		</td>
		<td valign="top"><?php
		JPluginHelper::importPlugin('vmpayment');
		$_dispatcher = JDispatcher::getInstance();
		$_returnValues = $_dispatcher->trigger('plgVmOnShowOrderBEPayment',array( $this->orderID,$this->orderbt->virtuemart_paymentmethod_id, $this->orderdetails));

		foreach ($_returnValues as $_returnValue) {
			if ($_returnValue !== null) {
				echo $_returnValue;
			}
		}
		?></td>
	</tr>

</table>

</div>

<?php
AdminUIHelper::imitateTabs('end');
AdminUIHelper::endAdminArea(); ?>

<script type="text/javascript">

jQuery('.show_element').click(function() {
  jQuery('.element-hidden').toggle();
  return false;
});
// jQuery('select#order_items_status').change(function() {
	////selectItemStatusCode
	// var statusCode = this.value;
	// jQuery('.selectItemStatusCode').val(statusCode);
	// return false
// });
jQuery('.updateOrderItemStatus').click(function() {
	document.orderItemForm.task.value = 'updateOrderItemStatus';
	document.orderItemForm.submit();
	return false;
});
jQuery('.updateOrder').click(function() {
	document.orderForm.submit();
	return false;
});
jQuery('.createOrder').click(function() {
	document.orderForm.task.value = 'CreateOrderHead';
	document.orderForm.submit();
	return false;
});
jQuery('.newOrderItem').click(function() {
	document.orderItemForm.task.value = 'newOrderItem';
	document.orderItemForm.submit();
	return false;
});
function confirmation(destnUrl) {
	var answer = confirm("<?php echo addslashes( vmText::_('COM_VIRTUEMART_ORDER_DELETE_ITEM_JS') ); ?>");
	if (answer) {
		window.location = destnUrl;
	}
}
/* JS for editstatus */

jQuery('.orderStatFormSubmit').click(function() {
	//document.orderStatForm.task.value = 'updateOrderItemStatus';
	document.orderStatForm.submit();

	return false;
});

var editingItem = 0;

</script>
