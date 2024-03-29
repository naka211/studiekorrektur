<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage
 * @author
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: orders.php 8539 2014-10-30 15:52:48Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
AdminUIHelper::startAdminArea ($this);

$styleDateCol = 'style="width:5%;min-width:110px"';
?>


<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div id="header">
		<div id="filterbox">
			<table>
				<tr>
					<td align="left" width="100%">
						<?php echo $this->displayDefaultViewSearch ('COM_VIRTUEMART_ORDER_PRINT_NAME'); ?>
						<?php echo vmText::_ ('COM_VIRTUEMART_ORDERSTATUS') . ':' . $this->lists['state_list']; ?>
						<!--T.Trung-->
						User freelancer
						<?php 
						$db = JFactory::getDBO();
						$q = "SELECT u.id, u.name FROM #__users u INNER JOIN #__user_usergroup_map um ON u.id = um.user_id WHERE u.block = 0 AND um.group_id = 2";
						$db->setQuery($q);
						$users = $db->loadObjectList();
						?>
						<select name="freelance_id" onChange="this.form.submit();">
							<option value="0">Please select</option>
							<?php foreach($users as $user){?>
							<option value="<?php echo $user->id?>" <?php if($this->freelance_id == $user->id) echo 'selected';?>><?php echo $user->name?></option>
							<?php }?>
						</select>
						<!--T.Trung end-->
					</td>
				</tr>
			</table>
		</div>
		<div id="resultscounter"><?php echo $this->pagination->getResultsCounter (); ?></div>
	</div>
<div style="text-align: left;">
	<table class="adminlist table table-striped" cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<th class="admin-checkbox"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)"/></th>
			<th width="8%"><?php echo $this->sort ('order_number', 'COM_VIRTUEMART_ORDER_LIST_NUMBER')  ?></th>
			<th width="26%"><?php echo $this->sort ('order_name', 'COM_VIRTUEMART_ORDER_PRINT_NAME')  ?></th>
			<th width="18%"><?php echo $this->sort ('order_email', 'COM_VIRTUEMART_EMAIL')  ?></th>
			<!--<th width="18%"><?php echo $this->sort ('payment_method', 'COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL')  ?></th>-->
			<th style="min-width:110px;width:5%;"><?php echo vmText::_ ('COM_VIRTUEMART_PRINT_VIEW'); ?></th>
			<th class="admin-dates"><?php echo $this->sort ('created_on', 'COM_VIRTUEMART_ORDER_CDATE')  ?></th>
			<!--<th class="admin-dates"><?php echo $this->sort ('modified_on', 'COM_VIRTUEMART_ORDER_LIST_MDATE')  ?></th>-->
			<th class="admin-dates">Product</th>
			<th width="8%">Quantity</th>
			<th><?php echo $this->sort ('order_status', 'COM_VIRTUEMART_STATUS')  ?></th>
			<th style="min-width:130px;width:5%;"><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_LIST_NOTIFY'); ?></th>
			<th width="10%"><?php echo $this->sort ('order_total', 'COM_VIRTUEMART_TOTAL')  ?></th>
			<th><?php echo $this->sort ('virtuemart_order_id', 'COM_VIRTUEMART_ORDER_LIST_ID')  ?></th>

		</tr>
		</thead>
		<tbody>
		<?php
		if (count ($this->orderslist) > 0) {
			$i = 0;
			$k = 0;
			$keyword = vRequest::getCmd ('keyword');
			$orderModel=VmModel::getModel('orders');
		
			foreach ($this->orderslist as $key => $order) {
				$checked = JHtml::_ ('grid.id', $i, $order->virtuemart_order_id);
				$orderDetails = $orderModel->getOrder($order->virtuemart_order_id);
				?>
			<tr class="row<?php echo $k; ?>">
				<!-- Checkbox -->
				<td class="admin-checkbox"><?php echo $checked; ?></td>
				<!-- Order id -->
				<?php
				$link = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $order->virtuemart_order_id;
				?>
				<td><?php echo JHtml::_ ('link', JRoute::_ ($link, FALSE), $order->order_number, array('title' => vmText::_ ('COM_VIRTUEMART_ORDER_EDIT_ORDER_NUMBER') . ' ' . $order->order_number)); ?></td>

				<td>
					<?php
					if ($order->virtuemart_user_id) {
						$userlink = JROUTE::_ ('index.php?option=com_virtuemart&view=user&task=edit&virtuemart_user_id[]=' . $order->virtuemart_user_id, FALSE);
						echo JHtml::_ ('link', JRoute::_ ($userlink, FALSE), $order->order_name, array('title' => vmText::_ ('COM_VIRTUEMART_ORDER_EDIT_USER') . ' ' .  htmlentities($order->order_name)));
					} else {
						echo $order->order_name;
					}
					?>
				</td>
				<td>
					<?php
					echo $order->order_email;
					?>
				</td>
				<!-- Payment method -->
				<!--<td><?php echo $order->payment_method; ?></td>-->
				<!-- Print view -->
				<?php
				/* Print view URL */
				$print_url = juri::root () . 'index.php?option=com_virtuemart&view=invoice&layout=invoice&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id . '&order_number=' . $order->order_number . '&order_pass=' . $order->order_pass;
				$print_link = "<a href=\"javascript:void window.open('$print_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\"  >";
				$print_link .= '<span class="hasTip print_32" title="' . vmText::_ ('COM_VIRTUEMART_PRINT') . '">&nbsp;</span></a>';
				$invoice_link = '';
				$deliverynote_link = '';

				if (!$order->invoiceNumber) {
					$invoice_url = juri::root () . 'index.php?option=com_virtuemart&view=invoice&layout=invoice&format=pdf&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id . '&order_number=' . $order->order_number . '&order_pass=' . $order->order_pass . '&create_invoice=1';
					$invoice_link .= "<a href=\"$invoice_url\"  >".'<span class="hasTip invoicenew_32" title="' . vmText::_ ('COM_VIRTUEMART_INVOICE_CREATE') . '"></span></a>';
				} elseif (!shopFunctions::InvoiceNumberReserved ($order->invoiceNumber)) {
					$invoice_url = juri::root () . 'index.php?option=com_virtuemart&view=invoice&layout=invoice&format=pdf&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id . '&order_number=' . $order->order_number . '&order_pass=' . $order->order_pass;
					$invoice_link = "<a href=\"$invoice_url\"  >" . '<span class="hasTip invoice_32" title="' . vmText::_ ('COM_VIRTUEMART_INVOICE') . '"></span></a>';
				}

				if (!$order->invoiceNumber) {
					$deliverynote_url = juri::root () . 'index.php?option=com_virtuemart&view=invoice&layout=deliverynote&format=pdf&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id . '&order_number=' . $order->order_number . '&order_pass=' . $order->order_pass . '&create_invoice=1';
					$deliverynote_link = "<a href=\"$deliverynote_url\"  >" . '<span class="hasTip deliverynotenew_32" title="' . vmText::_ ('COM_VIRTUEMART_DELIVERYNOTE_CREATE') . '"></span></a>';
				} elseif (!shopFunctions::InvoiceNumberReserved ($order->invoiceNumber)) {
					$deliverynote_url = juri::root () . 'index.php?option=com_virtuemart&view=invoice&layout=deliverynote&format=pdf&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id . '&order_number=' . $order->order_number . '&order_pass=' . $order->order_pass;
					$deliverynote_link = "<a href=\"$deliverynote_url\"  >" . '<span class="hasTip deliverynote_32" title="' . vmText::_ ('COM_VIRTUEMART_DELIVERYNOTE') . '"></span></a>';
				}


				?>
				<td><?php echo $print_link; echo $deliverynote_link; echo $invoice_link; ?></td>
				<!-- Order date -->
				<td><?php echo vmJsApi::date ($order->created_on, 'LC2', TRUE); ?></td>
				<!-- Last modified -->
				<td><?php echo $orderDetails['items'][0]->order_item_name; ?></td>
				<td><?php if($orderDetails['items'][0]->virtuemart_product_id != 5) echo $orderDetails['items'][0]->product_quantity; ?></td>
				<!-- Status -->
				<td style="position:relative;">
					<?php echo JHtml::_ ('select.genericlist', $this->orderstatuses, "orders[" . $order->virtuemart_order_id . "][order_status]", 'class="orderstatus_select"', 'order_status_code', 'order_status_name', $order->order_status, 'order_status' . $i, TRUE); ?>
					<input type="hidden" name="orders[<?php echo $order->virtuemart_order_id; ?>][current_order_status]" value="<?php echo $order->order_status; ?>"/>
					<input type="hidden" name="orders[<?php echo $order->virtuemart_order_id; ?>][coupon_code]" value="<?php echo $order->coupon_code; ?>"/>
					<br/>
					<textarea class="element-hidden vm-order_comment vm-showable" name="orders[<?php echo $order->virtuemart_order_id; ?>][comments]" cols="5" rows="5"></textarea>
					<?php echo JHtml::_ ('link', '#', vmText::_ ('COM_VIRTUEMART_ADD_COMMENT'), array('class' => 'show_comment')); ?>
				</td>
				<!-- Update -->
				<td><?php echo VmHTML::checkbox ('orders[' . $order->virtuemart_order_id . '][customer_notified]', 0) . vmText::_ ('COM_VIRTUEMART_ORDER_LIST_NOTIFY'); ?>
					<br/>
					<?php echo VmHTML::checkbox ('orders[' . $order->virtuemart_order_id . '][customer_send_comment]', 1) . vmText::_ ('COM_VIRTUEMART_ORDER_HISTORY_INCLUDE_COMMENT'); ?>
					<br/>
					<?php echo VmHTML::checkbox ('orders[' . $order->virtuemart_order_id . '][update_lines]', 1) . vmText::_ ('COM_VIRTUEMART_ORDER_UPDATE_LINESTATUS'); ?>
				</td>
				<!-- Total -->
				<td><?php echo $order->order_total; ?></td>
				<td><?php echo JHtml::_ ('link', JRoute::_ ($link, FALSE), $order->virtuemart_order_id, array('title' => vmText::_ ('COM_VIRTUEMART_ORDER_EDIT_ORDER_ID') . ' ' . $order->virtuemart_order_id)); ?></td>

			</tr>
				<?php
				$k = 1 - $k;
				$i++;
			}
		}
		?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="12">
				<?php echo $this->pagination->getListFooter (); ?>
			</td>
		</tr>
		</tfoot>
	</table>
</div>
	<!-- Hidden Fields -->
	<?php echo $this->addStandardHiddenToForm (); ?>
</form>
<?php AdminUIHelper::endAdminArea (); ?>
<script type="text/javascript">
	<!--

		jQuery('.show_comment').click(function() {
		jQuery(this).prev('.element-hidden').show();
		return false
		});

		jQuery('.element-hidden').mouseleave(function() {
		jQuery(this).hide();
		});
		jQuery('.element-hidden').mouseout(function() {
		jQuery(this).hide();
		});
		-->
</script>

<script>
	jQuery(document).ready(function() {
		jQuery('.orderstatus_select').change( function() {

			var name = jQuery(this).attr('name');
			var brindex = name.indexOf("orders[");
			if ( brindex >= 0){
				//yeh, yeh, maybe not the most elegant way, but it does, what it should
				var s = name.indexOf("[")+1;
				var e = name.indexOf("]");
				var id = name.substring(s,e);

				<?php $orderstatusForShopperEmail = VmConfig::get('email_os_s',array('U','C','S','R','X'));
					if(!is_array($orderstatusForShopperEmail)) $orderstatusForShopperEmail = array($orderstatusForShopperEmail);
					$jsOrderStatusShopperEmail = json_encode($orderstatusForShopperEmail);
				?>
				var orderstatus = <?php echo $jsOrderStatusShopperEmail ?>;
				var selected = jQuery(this).val();
				var selStr = '[name="orders['+id+'][customer_notified]"]';
				var elem = jQuery(selStr);

				if(jQuery.inArray(selected, orderstatus)!=-1){
					elem.attr("checked",true);
					// for the checkbox    
					jQuery(this).parent().parent().find('input[name="cid[]"]').attr("checked",true);
				} else {
					elem.attr("checked",false);
				}

			}

		});

	});
</script>
