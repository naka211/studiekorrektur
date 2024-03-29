<?php
/**
 *
 * Orders controller
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: orders.php 8618 2014-12-10 22:45:48Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if(!class_exists('VmController'))require(VMPATH_ADMIN.DS.'helpers'.DS.'vmcontroller.php');


/**
 * Orders Controller
 *
 * @package    VirtueMart
 * @author
 */
class VirtuemartControllerOrders extends VmController {

	/**
	 * Method to display the view
	 *
	 * @access	public
	 * @author
	 */
	function __construct() {
		VmConfig::loadJLang('com_virtuemart_orders',TRUE);
		parent::__construct();

	}

	/**
	 * Shows the order details
	 */
	public function edit($layout='order'){

		parent::edit($layout);
	}

	public function updateCustomsOrderItems(){

		$q = 'SELECT `product_attribute` FROM `#__virtuemart_order_items` LIMIT ';
		$do = true;
		$db = JFactory::getDbo();
		$start = 0;
		$hunk  = 1000;
		while($do){
			$db->setQuery($q.$start.','.$hunk);
			$items = $db->loadColumn();
			if(!$items){
				vmdebug('updateCustomsOrderItems Reached end after '.$start/$hunk.' loops');
				break;
			}
			//The stored result in vm2.0.14 looks like this {"48":{"textinput":{"comment":"test"}}}
			//{"96":"18"} download plugin
			// 46 is virtuemart_customfield_id
			//{"46":" <span class=\"costumTitle\">Cap Size<\/span><span class=\"costumValue\" >S<\/span>","110":{"istraxx_customsize":{"invala":"10","invalb":"10"}}}
			//and now {"32":[{"invala":"100"}]}
			foreach($items as $field){
				if(strpos($field,'{')!==FALSE){
					$jsField = json_decode($field);
					$fieldProps = get_object_vars($jsField);
					vmdebug('updateCustomsOrderItems',$fieldProps);
					$nJsField = array();
					foreach($fieldProps as $k=>$props){
						if(is_object($props)){

							$props = (array)$props;
							foreach($props as $ke=>$prop){
								if(!is_numeric($ke)){
									vmdebug('Found old param style',$ke,$prop);
									if(is_object($prop)){
										$prop = (array)$prop;
										$nJsField[$k] = $prop;
										/*foreach($prop as $name => $propvalue){
											$nJsField[$k][$name] = $propvalue;
										}*/
									}
								}
								 else {
									//$nJsField[$k][$name] = $prop;
								}
							}
						} else {
							if(is_numeric($k) and is_numeric($props)){
							$nJsField[$props] = $k;
							} else {
								$nJsField[$k] = $props;
							}
						}
					}
					$nJsField = json_encode($nJsField);
					vmdebug('updateCustomsOrderItems json $field encoded',$field,$nJsField);
				} else {
					vmdebug('updateCustomsOrderItems $field',$field);
				}

			}
			if(count($items)<$hunk){
				vmdebug('Reached end');
				break;
			}
			$start += $hunk;
		}
		// Create the view object
		$view = $this->getView('orders', 'html');
		$view->display();
	}

	/**
	 * NextOrder
	 * renamed, the name was ambigous notice by Max Milbers
	 * @author Kohl Patrick
	 */
	public function nextItem($dir = 'ASC'){
		$model = VmModel::getModel('orders');
		$id = vRequest::getInt('virtuemart_order_id');
		if (!$order_id = $model->getOrderId($id, $dir)) {
			$order_id  = $id;
			$msg = vmText::_('COM_VIRTUEMART_NO_MORE_ORDERS');
		} else {
			$msg ='';
		}
		$this->setRedirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$order_id ,$msg );
	}

	/**
	 * NextOrder
	 * renamed, the name was ambigous notice by Max Milbers
	 * @author Kohl Patrick
	 */
	public function prevItem(){

		$this->nextItem('DESC');
	}
	/**
	 * Generic cancel task
	 *
	 * @author Max Milbers
	 */
	public function cancel(){
		// back from order
		$this->setRedirect('index.php?option=com_virtuemart&view=orders' );
	}
	/**
	 * Shows the order details
	 * @deprecated
	 */
	public function editOrderStatus() {

		$view = $this->getView('orders', 'html');

		if($this->getPermOrderStatus()){
			$model = VmModel::getModel('orders');
			$model->updateOrderStatus();
		} else {
			vmInfo('Restricted');
		}

		$view->display();
	}

	function getPermOrderStatus(){

		$user = JFactory::getUser();
		if($user->authorise('core.admin') or $user->authorise('core.admin', 'com_virtuemart') or $user->authorise('core.manage', 'com_virtuemart') or
			( $user->authorise('vm.manage', 'com_virtuemart') and $user->authorise('vm.orders.status', 'com_virtuemart') )){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Update an order status
	 *
	 * @author Max Milbers
	 */
	public function updatestatus() {

		$app = Jfactory::getApplication();
		$lastTask = vRequest::getCmd('last_task');

		/* Load the view object */
		$view = $this->getView('orders', 'html');

		if(!$this->getPermOrderStatus()){
			vmInfo('Restricted');
			$view->display();
			return true;
		}

		/* Update the statuses */
		$model = VmModel::getModel('orders');

		if ($lastTask == 'updatestatus') {
			// single order is in POST but we need an array
			$order = array() ;
			$virtuemart_order_id = vRequest::getInt('virtuemart_order_id');
			$order[$virtuemart_order_id] = (vRequest::getRequest());

			$result = $model->updateOrderStatus($order);
		} else {
			$result = $model->updateOrderStatus();
		}

		$msg='';
		if ($result['updated'] > 0)
		$msg = vmText::sprintf('COM_VIRTUEMART_ORDER_UPDATED_SUCCESSFULLY', $result['updated'] );
		else if ($result['error'] == 0)
		$msg .= vmText::_('COM_VIRTUEMART_ORDER_NOT_UPDATED');
		if ($result['error'] > 0)
		$msg .= vmText::sprintf('COM_VIRTUEMART_ORDER_NOT_UPDATED_SUCCESSFULLY', $result['error'] , $result['total']);
		if ('updatestatus'== $lastTask ) {
			$app->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$virtuemart_order_id , $msg);
		}
		else {
			$app->redirect('index.php?option=com_virtuemart&view=orders', $msg);
		}
	}


	/**
	 * Save changes to the order item status
	 *
	 */
	public function saveItemStatus() {

		$mainframe = Jfactory::getApplication();

		$data = vRequest::getRequest();
		$model = VmModel::getModel();
		$model->updateItemStatus(JArrayHelper::toObject($data), $data['new_status']);

		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$data['virtuemart_order_id']);
	}


	/**
	 * Display the order item details for editing
	 */
	public function editOrderItem() {

		vRequest::setVar('layout', 'orders_editorderitem');

		parent::display();
	}


	/**
	 * correct position, working with json? actually? WHat ist that?
	 *
	 * Get a list of related products
	 * @author Max Milbers
	 */
	public function getProducts() {

		$view = $this->getView('orders', 'json');
		$view->setLayout('orders_editorderitem');

		$view->display();
	}


	/**
	 * Update status for the selected order items
	 */
	public function updateOrderItemStatus()
	{

		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$_items = vRequest::getVar('item_id',  0, '', 'array');

		$_orderID = vRequest::getInt('virtuemart_order_id', '');

		foreach ($_items as $key=>$value) {

			if (!isset($value['comments'])) $value['comments'] = '';

			$data = (object)$value;
			$data->virtuemart_order_id = $_orderID;
			// 			$model->updateSingleItem((int)$key, $value['order_status'],$value['comments'],$_orderID);
			$model->updateSingleItem((int)$key, $data, true);
		}
		$model->deleteInvoice($_orderID);
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$_orderID);
	}

	public function updateOrderHead()
	{
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$_items = vRequest::getVar('item_id',  0, '', 'array');
		$_orderID = vRequest::getInt('virtuemart_order_id', '');
		$model->UpdateOrderHead((int)$_orderID, vRequest::getRequest());
		$model->deleteInvoice($_orderID);
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$_orderID);
	}

	public function CreateOrderHead()
	{
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$orderid = $model->CreateOrderHead();
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$orderid );
	}

	public function newOrderItem() {

		$orderId = vRequest::getInt('virtuemart_order_id', '');
		$model = VmModel::getModel();
		$msg = '';
		$data = vRequest::getRequest();
		$model->saveOrderLineItem($data);
		$model->deleteInvoice($orderId);
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$this->setRedirect($editLink, $msg);
	}

	/**
	 * Removes the given order item
	 */
	public function removeOrderItem() {

		$model = VmModel::getModel();
		$msg = '';
		$orderId = vRequest::getInt('orderId', '');
		// TODO $orderLineItem as int ???
		$orderLineItem = vRequest::getVar('orderLineId', '');

		$model->removeOrderLineItem($orderLineItem);

		$model->deleteInvoice($orderId);
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$this->setRedirect($editLink, $msg);
	}

	//T.Trung
	function uploadFile(){
		$enFile = $_FILES["english_edited_file"];
		$daFile = $_FILES["danish_edited_file"];
		
		$time = time();
		if($enFile){
			$enFileName = $time."_".$enFile["name"];
			$enFileDes = JPATH_ROOT."/images/edited_file/";
			move_uploaded_file($enFile["tmp_name"], $enFileDes.$enFileName);
		}
		
		$daFileName = $time."_".$daFile["name"];
		$daFileDes = JPATH_ROOT."/images/edited_file/";
		move_uploaded_file($daFile["tmp_name"], $daFileDes.$daFileName);
		
		$orderId = vRequest::getInt('orderId', '');
		
		$db = JFactory::getDBO();
		$db->setQuery("UPDATE #__virtuemart_order_userinfos SET english_edited_file='".$enFileName."',  danish_edited_file='".$daFileName."' WHERE virtuemart_order_id=".$orderId." AND address_type = 'BT'");
		$db->query();
		
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$msg = "File(s) is uploaded!!";
		$this->setRedirect($editLink, $msg);
	}
	
	function changeUser(){
		$user_id = JRequest::getVar("user_id");
		$curr_user = JRequest::getVar("curr_user_id");
		if($user_id != $curr_user){
			$db = JFactory::getDBO();
			$app = JFactory::getApplication();
			$mailfrom = $app->get('mailfrom');
			$fromname = $app->get('fromname');
			$sitename = $app->get('sitename');
			
			$user = JFactory::getUser($user_id);
			$orderid = JRequest::getVar('orderId');
			
			$db->setQuery("UPDATE #__users SET orders_received = orders_received-1 WHERE id=".$curr_user);
			$db->query();
			$db->setQuery("UPDATE #__users SET orders_received = orders_received+1 WHERE id=".$user_id);
			$db->query();
			$db->setQuery("UPDATE #__virtuemart_order_userinfos SET freelance_id = ".$user_id." WHERE virtuemart_order_id=".$orderid);
			$db->query();
			
			$orderModel=VmModel::getModel('orders');
			$order = $orderModel->getOrder($orderid);
			
			$html = '<html>
    <head>
	<style>
        body {font-family: arial; font-size: 14px;}
        .wrapper {width: 800px; margin: 0 auto;}
        table {text-align: left; width: 100%; border-bottom: none;}
        table thead {background-color: #323232; color: #fff;}
        table thead th {padding: 10px 5px; text-align: left;}
        table tr td {padding: 10px 5px; border-bottom: 1px solid #e5e5e5;}
    </style>

    </head>

    <body>
	<div class="wrapper">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="border-bottom: none;">
                    <p>Dit ordrenr. er '.$order["details"]["BT"]->order_number.'</p>
                    <p>Sprog: '.$order["details"]["BT"]->language.'</p>
                    <p>Leveringstidspunkt: '.$order["details"]["BT"]->delivery_date.'</p>
					<p>Kommentar: '.$order["details"]["BT"]->comment.'</p>   
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th class="text-center">Antal normalsider</th>
                </tr>
            </thead>
            <tbody>';
				foreach($order["items"] as $item){
					if($item->virtuemart_product_id != 5){
						$quantity = $item->product_quantity;
					} else {
						$quantity = '';
					}
                $html.= '<tr>
                    <td>'. $item->order_item_name.'</td>
					<td class="text-center">'.$quantity.'</td>
                </tr>';
				}
				$html .= '
            </tbody>
        </table>
		<table cellpadding="0" cellspacing="0">
            <tr>
                <td style="border-bottom: none;">
                    <p>Du kan se opgaven ved at login til din profil her: <a href="'.JURI::root().'index.php/login.html">'.JURI::root().'index.php/login.html</a></p>
                </td>
            </tr>
        </table>
    </div>
    </body>
</html>';
			
			$mail = JFactory::getMailer();
			$mail->addRecipient($user->email);
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject('Bekræftet ordre '.$order['details']['BT']->order_number);
			$mail->isHTML(true);
			$mail->setBody($html);
			$sent = $mail->Send();
		}
		
		
		$orderId = vRequest::getInt('orderId', '');
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$msg = "User is changed!!";
		$this->setRedirect($editLink, $msg);
	}
	//T.Trung end
}
// pure php no closing tag

