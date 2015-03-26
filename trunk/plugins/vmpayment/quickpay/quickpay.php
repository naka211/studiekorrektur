<?php

/**
 * Version 3.01 - 21/01-2015
 * - The forthcoming order id is sent to Quickpay instead of the random generated orderid
 * - Optional order prefix field in the configuration, any value here is prefixed on the orderid that is sent to quickpay
 * - Tested on stable virtuemart 3 and found ok (earlier version was tested on release candidate only)
 * 
 * Version 3.00 - 03/11-2014
 * - Version 7 api support
 * - Support for Virtuemart 3 (2.9.9.2 release candidate), please note things might change before final VM3 is released
 *
 * Version 2.22 - 08/02-2013
 * - Payment id got cleared on a failed transaction, and a second succesful payment on same order was not completed succesfully. (= state and other stuff not updated)
 * 
 * Version 2.21 - 02/02-2013
 * - Fixed id in database that had small datatype
 *
 * Version 2.2 - 02/10-2012 
 * - Upgraded to api v6
 * - Fee is added to the total if selected
 * - Tested and found ok for Virtuemart 2.0.10
 *
 * Version 2.1 - 05/03-2012
 * - Small fix, the cart was not always emptied
 *
 * Version 2.0 - 29/02-2012
 * 
 * - Now support for Virtuemart 2.0.2. Not compatible with earlier versions like 2.0 and 2.0.1.
 * 
 * Fully functional. A few nice features can still be implemented however:
 * - Translate the state to a meaningful name on the response page
 * - Translate the time to a more readable format
 * - Add md5 check on repsonse parameters
 * - Autodetect language in resolveQuickpayLang(), right now it is read from the language file which is ok, as we have different language files pr. language
 */


defined('_JEXEC') or die('Restricted access');


/**
 * Quickpay payment module for virtuemart 2.0.2+ - based on the paypal payment API
 */
if (!class_exists('vmPSPlugin'))
    require (JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');


class plgVMPaymentQuickpay extends vmPSPlugin
{

    // instance of class
    public static $_this = false;

    function __construct(&$subject, $config) {
        parent::__construct($subject, $config);

        $this->_loggable = true;
        $this->tableFields = array_keys($this->getTableSQLFields());
        $this->_tablepkey = 'id';
        $this->_tableId = 'id';
        $varsToPush = $this->getVarsToPush();
        $this->setConfigParameterable($this->_configTableFieldName, $varsToPush);
    }

    protected function getVmPluginCreateTableSQL() {
        return $this->createTableSQL('Payment Quickpay Table');
    }

    /**
     * Decide the language to use in quickpay
     */
    private function resolveQuickpayLang() {
        $txtId = "VMPAYMENT_QUICKPAY_PAYWINDOWLANGUAGE";
        if (JText::_($txtId)) {
            return JText::_($txtId);
        } else {
            return 'da';
        }
    }

    function getTableSQLFields() {
        $SQLfields = array('id' => 'int(1) UNSIGNED NOT NULL AUTO_INCREMENT',
            'virtuemart_order_id' => 'int(1) UNSIGNED', 'order_number' => 'char(64)',
            'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED', 'payment_name' =>
            'varchar(5000)', 'payment_order_total' => 'decimal(15,5) NOT NULL DEFAULT \'0.00000\'',
            'payment_currency' => 'char(3)', 'cost_per_transaction' => 'decimal(10,2)',
            'cost_percent_total' => 'decimal(10,2)', 'tax_id' => 'smallint(1)',
            'quickpay_time' => 'char(13)', 'quickpay_state' => 'char(3)', 'quickpay_qpstat' =>
            'char(5)', 'quickpay_qpstatmsg' => 'char(50)', 'quickpay_chstat' => 'char(5)',
            'quickpay_chstatmsg' => 'char(50)', 'quickpay_transaction' => 'char(16)',
            'quickpay_cardtype' => 'char(32)', 'quickpay_cardnumber' => 'char(32)',
            'quickpay_fraudprobability' => 'char(32)', 'quickpay_fraudremarks' => 'char(32)',
            'quickpay_fraudreport' => 'char(32)', 'quickpay_fee' => 'char(12)');
        return $SQLfields;
    }

    function plgVmConfirmedOrder($cart, $order) {
        if (!($method = $this->getVmPluginMethod($order['details']['BT']->
            virtuemart_paymentmethod_id))) {
            return null; // Another method was selected, do nothing
        }
        if (!$this->selectedThisElement($method->payment_element)) {
            return false;
        }
        $session = JFactory::getSession();
        $return_context = $session->getId();
        $this->_debug = $method->debug;
        $this->logInfo('plgVmConfirmedOrder order number: ' . $order['details']['BT']->
            order_number, 'message');

        if (!class_exists('VirtueMartModelOrders')) {
            require (JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
        }

        if (!class_exists('VirtueMartModelCurrency')) {
            require (JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'currency.php');
        }

        $new_status = '';

        $usrBT = $order['details']['BT'];
        $address = ((isset($order['details']['ST'])) ? $order['details']['ST'] : $order['details']['BT']);

        $vendorModel = new VirtueMartModelVendor();
        $vendorModel->setId(1);
        $vendor = $vendorModel->getVendor();
        $this->getPaymentCurrency($method);
        $q = 'SELECT `currency_code_3` FROM `#__virtuemart_currencies` WHERE `virtuemart_currency_id`="' .
            $method->payment_currency . '" ';
        $db = &JFactory::getDBO();
        $db->setQuery($q);
        $currency_code_3 = $db->loadResult();

        $paymentCurrency = CurrencyDisplay::getInstance($method->payment_currency);
        $totalInPaymentCurrency = round($paymentCurrency->convertCurrencyTo($method->payment_currency, $order['details']['BT']->order_total, false), 2);
        $cd = CurrencyDisplay::getInstance($cart->pricesCurrency);

        $testReq = $method->debug == 1 ? 'YES' : 'NO';

        $prefix = $method->prefix;
        if ($prefix) {
            $order_number = $prefix . str_pad($order['details']['BT']->virtuemart_order_id, 4, '0', STR_PAD_LEFT);
        } else {
            $order_number = str_pad($order['details']['BT']->virtuemart_order_id, 4, '0', STR_PAD_LEFT);
        }

        $post_variables = array('protocol' => '7', 'msgtype' => 'authorize', 'merchant' =>
            $method->quickpay_merchant, 'language' => $this->resolveQuickpayLang(),
            'ordernumber' => $order_number, 'amount' => 100 * $totalInPaymentCurrency,
            'currency' => $currency_code_3, 'continueurl' => JROUTE::_(JURI::root() .
            'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' .
            $order['details']['BT']->virtuemart_paymentmethod_id . '&ordernumber=' . $order['details']['BT']->
            order_number), 'cancelurl' => JROUTE::_(JURI::root() .
            'index.php?option=com_virtuemart&view=pluginresponse&task=pluginUserPaymentCancel&on=' .
            $order['details']['BT']->order_number . '&pm=' . $order['details']['BT']->
            virtuemart_paymentmethod_id), 'callbackurl' => JROUTE::_(JURI::root() .
            'index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&tmpl=component&sessionid=' .
            $session->getId()), 'autocapture' => $method->quickpay_autocapture, 'autofee' =>
            $method->quickpay_autofee, 'cardtypelock' => $method->quickpay_cardtypelock,
            'splitpayment' => $method->quickpay_splitpayment, 'testmode' => $method->
            quickpay_testmode);

        if ($post_variables['splitpayment'] == 0) {
            // Quickpay does not accept a value of 0, so we remove it completely if splitpay is not requested
            unset($post_variables['splitpayment']);
        }
        unset($post_variables['testmode']); // Not for apiv6, we keep if it at some point is enabled again

        // Calculate md5
        $md5String = '';
        foreach ($post_variables as $name => $value) {
            $md5String .= $value;
        }
        $md5String .= $method->quickpay_md5_key;
        $post_variables['md5check'] = md5($md5String);


        // Prepare data that should be stored in the database
        $dbValues['order_number'] = $order['details']['BT']->order_number;
        $dbValues['payment_name'] = $this->renderPluginName($method, $order);
        $dbValues['virtuemart_paymentmethod_id'] = $cart->virtuemart_paymentmethod_id;
        $dbValues['cost_per_transaction'] = $method->cost_per_transaction;
        $dbValues['cost_percent_total'] = $method->cost_percent_total;
        $dbValues['payment_currency'] = $method->payment_currency;
        $dbValues['payment_order_total'] = $totalInPaymentCurrency;
        $dbValues['tax_id'] = $method->tax_id;
        $this->storePSPluginInternalData($dbValues);

        // add form data
        $html = '<form action="https://secure.quickpay.dk/form/" method="post" name="vm_quickpay_form" >';
        $html .= '<input type="image" name="submit" src="" alt="Click to pay with Quickpay" />';
        foreach ($post_variables as $name => $value) {
            $html .= '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($value) .
                '" />';
        }
        $html .= '</form>';

        $html .= ' <script type="text/javascript">';
        $html .= ' document.vm_quickpay_form.submit();';
        $html .= ' </script>';
        // 	2 = don't delete the cart, don't send email and don't redirect
        return $this->processConfirmedOrderPaymentResponse(2, $cart, $order, $html, $new_status);
    }

    function plgVmgetPaymentCurrency($virtuemart_paymentmethod_id, &$paymentCurrencyId) {
        if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
            return null; // Another method was selected, do nothing
        }
        if (!$this->selectedThisElement($method->payment_element)) {
            return false;
        }
        $this->getPaymentCurrency($method);
        $paymentCurrencyId = $method->payment_currency;
    }

    function plgVmOnPaymentResponseReceived(&$html) {
        // the payment itself should send the parameter needed.
        $virtuemart_paymentmethod_id = JRequest::getInt('pm', 0);

        $vendorId = 0;
        if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
            return null; // Another method was selected, do nothing
        }
        if (!$this->selectedThisElement($method->payment_element)) {
            return false;
        }


        $payment_data = JRequest::get('get');
        vmdebug('plgVmOnPaymentResponseReceived', $payment_data);

        $order_number = $payment_data['ordernumber'];

        // Remove prefix from ordernumber
        $prefix = $method->prefix;
        if (preg_match('/' . $prefix . '/', $order_number)) {
            $order_number = str_replace($prefix, '', $order_number);
        }
        $order_number = intval($order_number);

        if (!class_exists('VirtueMartModelOrders'))
            require (JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');

        $virtuemart_order_id = $order_number;

        $payment_name = $this->renderPluginName($method);
        $html = ""; // Here we could add some Quickpay status info, but we dont

        //We delete the old stuff

        if (!class_exists('VirtueMartCart'))
            require (JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
        $cart = VirtueMartCart::getCart();
        $cart->emptyCart();

        return true;
    }

    function plgVmOnUserPaymentCancel() {
        if (!class_exists('VirtueMartModelOrders')) {
            require (JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
        }

        $order_number = JRequest::getVar('on');
        if (!$order_number) {
            return false;
        }
        $db = JFactory::getDBO();

        $virtuemart_paymentmethod_id = JRequest::getInt('pm', 0);
        if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
            return null; // Another method was selected, do nothing
        }
        ////////////////////////////////////remove prefix from ordernumber///////////////////
        $prefix = $method->prefix;
        if (preg_match('/' . $prefix . '/', $order_number)) {
            $order_number = str_replace($prefix, '', $order_number);
        }
        $order_number = intval($order_number);
        ////////////////////////////////////////////////////////////////////////////

        $query = 'SELECT ' . $this->_tablename . '.`virtuemart_order_id` FROM ' . $this->
            _tablename . " WHERE  `order_number`= '" . $order_number . "'";

        $db->setQuery($query);
        $virtuemart_order_id = $db->loadResult();

        if (!$virtuemart_order_id) {
            return null;
        }
        $this->handlePaymentUserCancel($virtuemart_order_id);

        //JRequest::setVar('paymentResponse', $returnValue);
        return true;
    }

    /**
    *   plgVmOnPaymentNotification() - This event is fired by Offline Payment. It can be used to validate the payment data as entered by the user.
    * Return:
    * Parameters:
    *  None
    */
    function plgVmOnPaymentNotification() { 
        if (!class_exists('VirtueMartModelOrders')) {
            require (JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
        }
        $callbackData = JRequest::get('post');
        $callbackDataGet = JRequest::get('get');

        $order_number = $callbackData['ordernumber'];

		$virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($callbackData['ordernumber']);
        $virtuemart_paymentmethod_id = JRequest::getInt('pm', 0);
        if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
            return null; // Another method was selected, do nothing
        }
        // Remove prefix from ordernumber
        /*$prefix = $method->prefix;
        if ($prefix && preg_match('/' . $prefix . '/', $order_number)) {
            $order_number = str_replace($prefix, '', $order_number);
        }
        $order_number = intval($order_number);

        $virtuemart_order_id = $order_number;*/

        if (!$virtuemart_order_id) {
            return;
        }

        $vendorId = 0;
        $payment = $this->getDataByOrderId($virtuemart_order_id);

        $method = $this->getVmPluginMethod($payment->virtuemart_paymentmethod_id);
        if (!$this->selectedThisElement($method->payment_element)) {
            return false;
        }

        if (!$payment) {
            $this->logInfo('getDataByOrderId payment not found: exit ', 'ERROR');
            return null;
        }
        $this->logInfo('quickpay callback data ' . implode('   ', $callbackData),
            'message');

        // get all know columns of the table
        $db = JFactory::getDBO();
        $query = 'SHOW COLUMNS FROM `' . $this->_tablename . '` ';
        $db->setQuery($query);
        $columns = $db->loadResultArray(0);
        $post_msg = '';
        foreach ($callbackData as $key => $value) {
            $post_msg .= $key . "=" . $value . "<br />";
            $table_key = 'quickpay_' . $key;
            if (in_array($table_key, $columns)) {
                $response_fields[$table_key] = $value;
            }
        }
        $response_fields['payment_name'] = $this->renderPluginName($method);
        $return_context = $callbackDataGet['sessionid'];
        $response_fields['order_number'] = $order_number;
        $response_fields['virtuemart_order_id'] = $virtuemart_order_id;
        $response_fields['virtuemart_paymentmethod_id'] = $payment->virtuemart_paymentmethod_id;
        $this->storePSPluginInternalData($response_fields, 'virtuemart_order_id', true);

        if ($callbackData['qpstat'] == "000") {
            $new_status = $method->status_success;
            $this->logInfo('process OK, status', 'message');
        } else {
            $this->logInfo('process ERROR', 'ERROR');
            $new_status = $method->status_canceled;
        }

        $this->logInfo('plgVmOnPaymentNotification return new_status:' . $new_status,
            'message');
        $this->logInfo('plgVmOnPaymentNotification session:', $return_context);

        // Update any payment fee
        if (isset($callbackData['fee'])) {
            $quickPayFee = (float)($callbackData['fee']) / (float)100.0;
            $db = JFactory::getDBO();
            $query = "update #__virtuemart_orders SET order_payment=" . $quickPayFee .
                ",order_total = order_total+$quickPayFee WHERE virtuemart_order_id=" . $virtuemart_order_id;
            $db->setQuery($query);
            $db->query();
        }

        $modelOrder = VmModel::getModel('orders');
        $order = array();
        $order['order_status'] = $new_status;
        $order['customer_notified'] = 1;
        //$order['comments'] = JText::sprintf('VMPAYMENT_PAYPAL_PAYMENT_STATUS_CONFIRMED', $order_number);
        $modelOrder->updateStatusForOneOrder($virtuemart_order_id, $order, true);

        $this->logInfo('Notification, sentOrderConfirmedEmail ' . $order_number . ' ' .
            $new_status, 'message'); //// remove vmcart
        $this->emptyCart($return_context);


    }


    /**
     * Display stored payment data for an order
     * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
     */
    function plgVmOnShowOrderBEPayment($virtuemart_order_id, $payment_method_id) {
        if (!$this->selectedThisByMethodId($payment_method_id)) {
            return null; // Another method was selected, do nothing
        }

        $db = JFactory::getDBO();
        $q = 'SELECT * FROM `' . $this->_tablename . '` ' .
            'WHERE `virtuemart_order_id` = ' . $virtuemart_order_id;
        $db->setQuery($q);
        if (!($paymentTable = $db->loadObject())) {
            // JError::raiseWarning(500, $db->getErrorMsg());
            return '';
        }
        $this->getPaymentCurrency($paymentTable);
        $q = 'SELECT `currency_code_3` FROM `#__virtuemart_currencies` WHERE `virtuemart_currency_id`="' .
            $paymentTable->payment_currency . '" ';
        $db = &JFactory::getDBO();
        $db->setQuery($q);
        $currency_code_3 = $db->loadResult();
        $html = '<table class="adminlist">' . "\n";
        $html .= $this->getHtmlHeaderBE();
        $html .= $this->getHtmlRowBE('PAYMENT_NAME', $paymentTable->payment_name);
        $code = "quickpay_";
        foreach ($paymentTable as $key => $value) {
            if (substr($key, 0, strlen($code)) == $code) {
                $html .= $this->getHtmlRowBE($key, $value);
            }
        }
        $html .= '</table>' . "\n";
        return $html;
    }


    function getCosts(VirtueMartCart $cart, $method, $cart_prices) {
        if (preg_match('/%$/', $method->cost_percent_total)) {
            $cost_percent_total = substr($method->cost_percent_total, 0, -1);
        } else {
            $cost_percent_total = $method->cost_percent_total;
        }
        return ($method->cost_per_transaction + ($cart_prices['salesPrice'] * $cost_percent_total *
            0.01));
    }

    /**
     * Check if the payment conditions are fulfilled for this payment method
     * @author: Valerie Isaksen
     *
     * @param $cart_prices: cart prices
     * @param $payment
     * @return true: if the conditions are fulfilled, false otherwise
     *
     */
    protected function checkConditions($cart, $method, $cart_prices) {
        $address = (($cart->ST == 0) ? $cart->BT : $cart->ST);

        $amount = $cart_prices['salesPrice'];
        $amount_cond = ($amount >= $method->min_amount and $amount <= $method->
            max_amount or ($method->min_amount <= $amount and ($method->max_amount == 0)));

        $countries = array();
        if (!empty($method->countries)) {
            if (!is_array($method->countries)) {
                $countries[0] = $method->countries;
            } else {
                $countries = $method->countries;
            }
        }
        // probably did not gave his BT:ST address
        if (!is_array($address)) {
            $address = array();
            $address['virtuemart_country_id'] = 0;
        }

        if (!isset($address['virtuemart_country_id']))
            $address['virtuemart_country_id'] = 0;
        if (in_array($address['virtuemart_country_id'], $countries) || count($countries) ==
            0) {
            if ($amount_cond) {
                return true;
            }
        }

        return false;
    }

    /**
     * We must reimplement this triggers for joomla 1.7
     */

    /**
     * Create the table for this plugin if it does not yet exist.
     * This functions checks if the called plugin is active one.
     * When yes it is calling the standard method to create the tables
     * @author Valérie Isaksen
     *
     */
    function plgVmOnStoreInstallPaymentPluginTable($jplugin_id) {
        return $this->onStoreInstallPluginTable($jplugin_id);
    }

    /**
     * This event is fired after the payment method has been selected. It can be used to store
     * additional payment info in the cart.
     *
     * @author Max Milbers
     * @author Valérie isaksen
     *
     * @param VirtueMartCart $cart: the actual cart
     * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
     *
     */
    public function plgVmOnSelectCheckPayment(VirtueMartCart $cart) {
        return $this->OnSelectCheck($cart);
    }

    /**
     * plgVmDisplayListFEPayment
     * This event is fired to display the pluginmethods in the cart (edit shipment/payment) for exampel
     *
     * @param object $cart Cart object
     * @param integer $selected ID of the method selected
     * @return boolean True on succes, false on failures, null when this plugin was not selected.
     * On errors, JError::raiseWarning (or JError::raiseError) must be used to set a message.
     *
     * @author Valerie Isaksen
     * @author Max Milbers
     */
    public function plgVmDisplayListFEPayment(VirtueMartCart $cart, $selected = 0, &$htmlIn) {
        return $this->displayListFE($cart, $selected, $htmlIn);
    }

    /**
    * plgVmonSelectedCalculatePricePayment
    * Calculate the price (value, tax_id) of the selected method
    * It is called by the calculator
    * This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
    * @author Valerie Isaksen
    * @cart: VirtueMartCart the current cart
    * @cart_prices: array the new cart prices
    * @return null if the method was not selected, false if the shiiping rate is not valid any more, true otherwise
    *
    *
    */
    public function plgVmonSelectedCalculatePricePayment(VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {
        return $this->onSelectedCalculatePrice($cart, $cart_prices, $cart_prices_name);
    }

    /**
     * plgVmOnCheckAutomaticSelectedPayment
     * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
     * The plugin must check first if it is the correct type
     * @author Valerie Isaksen
     * @param VirtueMartCart cart: the cart object
     * @return null if no plugin was found, 0 if more then one plugin was found,  virtuemart_xxx_id if only one plugin is found
     *
     */
    function plgVmOnCheckAutomaticSelectedPayment(VirtueMartCart $cart, array $cart_prices = array()) {
        return $this->onCheckAutomaticSelected($cart, $cart_prices);
    }

    /**
     * This method is fired when showing the order details in the frontend.
     * It displays the method-specific data.
     *
     * @param integer $order_id The order ID
     * @return mixed Null for methods that aren't active, text (HTML) otherwise
     * @author Max Milbers
     * @author Valerie Isaksen
     */
    public function plgVmOnShowOrderFEPayment($virtuemart_order_id, $virtuemart_paymentmethod_id, &$payment_name) {
        $this->onShowOrderFE($virtuemart_order_id, $virtuemart_paymentmethod_id, $payment_name);
    }

    /**
     * This event is fired during the checkout process. It can be used to validate the
     * method data as entered by the user.
     *
     * @return boolean True when the data was valid, false otherwise. If the plugin is not activated, it should return null.
     * @author Max Milbers

     * public function plgVmOnCheckoutCheckDataPayment($psType, VirtueMartCart $cart) {
     * return null;
     * }
     */

    /**
     * This method is fired when showing when priting an Order
     * It displays the the payment method-specific data.
     *
     * @param integer $_virtuemart_order_id The order ID
     * @param integer $method_id  method used for this order
     * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
     * @author Valerie Isaksen
     */
    function plgVmonShowOrderPrintPayment($order_number, $method_id) {
        return $this->onShowOrderPrint($order_number, $method_id);
    }

    /**
     * This method is fired when showing the order details in the frontend, for every orderline.
     * It can be used to display line specific package codes, e.g. with a link to external tracking and
     * tracing systems
     *
     * @param integer $_orderId The order ID
     * @param integer $_lineId
     * @return mixed Null for method that aren't active, text (HTML) otherwise
     * @author Oscar van Eijk

     * public function plgVmOnShowOrderLineFE(  $_orderId, $_lineId) {
     * return null;
     * }
     */
    function plgVmDeclarePluginParamsPayment($name, $id, &$data) {
        return $this->declarePluginParams('payment', $name, $id, $data);
    }

    function plgVmSetOnTablePluginParamsPayment($name, $id, &$table) {
        return $this->setOnTablePluginParams($name, $id, $table);
    }

    function plgVmDeclarePluginParamsPaymentVM3(&$data) {
        return $this->declarePluginParams('payment', $data);
    }

}

// No closing tag
