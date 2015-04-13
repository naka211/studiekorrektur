<?php
/**
 * @package VirtueMart 2 OrderNumber plugin for Joomla! 2.5
 * @author Reinhold Kainhofer, reinhold@kainhofer.com
 * @copyright (C) 2012-2014 - Reinhold Kainhofer
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or     die( 'Direct Access to ' . basename( __FILE__ ) . ' is not allowed.' ) ;
if (!class_exists('vmShopperPlugin')) 
    require(JPATH_VM_PLUGINS . DS . 'vmshopperplugin.php');
if (!class_exists( 'VmConfig' )) 
    require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
VmConfig::loadConfig();

class plgVmShopperOrdernumber extends vmShopperPlugin {

    function __construct(& $subject, $config) {
        parent::__construct($subject, $config);
        /* Create the database table */
        $this->tableFields = array_keys ($this->getTableSQLFields ());
    }

    public function getVmPluginCreateTableSQL () {
        return $this->createTableSQL ('VM Shopper plugin: custom order and invoice numbers');
    }

    function getTableSQLFields () {
        $SQLfields = array(
            'id'             => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'number_type'    => 'int(1) UNSIGNED',
            'number_format'  => 'varchar(255)',
            'count'          => 'int(1)',
        );
        return $SQLfields;
    }

    // We don't need this function, but the parent class declares it abstract, so we need to overload
    function plgVmOnUpdateOrderBEShopper($_orderID) {}
    
    function _getCounter($nrtype, $format) {
        $db = JFactory::getDBO();
        /* prevent sql injection attacks by escaping the user-entered format! Empty for global counter... */
        /* For global counting, simply read the empty number_format entries! */
        $q = 'SELECT `count` FROM `'.$this->_tablename.'` WHERE `number_type`='.(int)$nrtype.' AND `number_format`='.$db->quote($format);
        $db->setQuery($q);
        $existing = $db->loadResult();
        $count = $existing?$existing:0;
        return $count;
    }
    
    function _counterExists($nrtype, $format) {
        $db = JFactory::getDBO();
        $q = 'SELECT `count` FROM `'.$this->_tablename.'` WHERE `number_type`='.(int)$nrtype.' AND `number_format`='.$db->quote($format);
        $db->setQuery($q);
        return ($db->loadResult() != null);
    }
    
    // Insert new counter value into the db
    function _addCounter($nrtype, $format, $value) {
        $db = JFactory::getDBO();
        $q = 'INSERT INTO `'.$this->_tablename.'` (`count`, `number_type`, `number_format`) VALUES ('.(int)$value.','.(int)$nrtype.', '.$db->quote($format).')';
        $db->setQuery( $q );
        $db->query();
        return $db->getAffectedRows();
    }

    // Insert new counter value into the db or update existing one
    function _setCounter($nrtype, $format, $value) {
        $db = JFactory::getDBO();
        $q = 'UPDATE `'.$this->_tablename.'` SET `count`= "'.(int)$value.'" WHERE `number_type`='.(int)$nrtype.' AND `number_format`='.$db->quote($format);
        $db->setQuery( $q );
        $db->query();
        if ($db->getAffectedRows()<1) {
            return $this->_addCounter($nrtype, $format, $value);
        } else {
            return $db->getAffectedRows();
        }
    }

    // Insert new counter value into the db or update existing one
    function _deleteCounter($nrtype, $format) {
        $db = JFactory::getDBO();
        $format = $db->escape ($format);
        $q = 'DELETE FROM `'.$this->_tablename.'` WHERE `number_type`='.(int)$nrtype.' AND `number_format`='.$db->quote($format);
        $db->setQuery( $q );
        $db->query();
        return $db->getAffectedRows();
    }

    /* Return a random "string" of the given length taken from the given alphabet */
    static function randomString($alphabet, $len) {
        $alen = strlen($alphabet);
        $r = "";
        for ($n=0; $n<$len; $n++) {
            $r .= $alphabet[mt_rand(0, $alen-1)];
        }
        return $r;
    }

    function replaceRandom ($match) {
        /* the regexp matches (random)(Type)(Len) as match, Type and Len is optional */
        $len = ($match[3]?$match[3]:1);
        // Fallback: If no Type is given, use Digit
        $alphabet = "0123456789";
        // Select the correct alphabet depending on Type
        switch (strtolower($match[2])) {
            case "digit": $alphabet = "0123456789"; break;
            case "hex": $alphabet = "0123456789abcdef"; break;
            case "letter": $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; break;
            case "uletter": $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; break;
            case "lletter": $alphabet = "abcdefghijklmnopqrstuvwxyz"; break;
            case "alphanum": $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; break;
        }
        return self::randomString ($alphabet, $len);
    }
    
    /* Extract the country information from the given ID */
    static function getCountryFromID ($country_id) {
        $db = JFactory::getDBO();
        $query = 'SELECT * FROM `#__virtuemart_countries` WHERE `virtuemart_country_id` = ' . (int)$country_id;
        $db->setQuery($query);
        return $db->loadObject();
    }



    /* Type 0 means order number, type 1 means invoice number, type 2 means customer number, 3 means order password */
    function replace_fields ($fmt, $nrtype, $details) {
        // First, replace all randomXXX[n] fields. This needs to be done with a regexp and a callback:
        $fmt = preg_replace_callback ('/\[(random)(.*?)([0-9]*?)\]/', array($this, 'replaceRandom'), $fmt);
        
        $reps = array (
            "[year]" => date ("Y"),
            "[year2]" => date ("y"),
            "[month]" => date("m"),
            "[day]" => date("d"),
            "[hour]" => date("H"),
            "[hour12]" => date("h"),
            "[ampm]" => date("a"),
            "[minute]" => date("i"),
            "[second]" => date("s"),
            "[userid]" => $details->virtuemart_user_id
        );
        if (isset($details->virtuemart_vendor_id)) $reps["[vendorid]"] = $details->virtuemart_vendor_id;
        
        if ($nrtype==0 or $nrtype == 1) { // Order nr and Invoice nr
            if (isset($details->ip_address)) $reps["[ipaddress]"] = $details->ip_address;
        }
        if ($nrtype==1 or $nrtype==2) { // Invoice nr and Customer nr
            if (isset($details->email)) $reps["[email]"] = $details->email;
            if (isset($details->title)) $reps["[title]"] = $details->title;
            if (isset($details->first_name)) $reps["[firstname]"] = $details->first_name;
            if (isset($details->middle_name)) $reps["[middlename]"] = $details->middle_name;
            if (isset($details->last_name)) $reps["[lastname]"] = $details->last_name;

            if (isset($details->company)) $reps["[company]"] = $details->company;
            if (isset($details->zip)) $reps["[zip]"] = $details->zip;
            if (isset($details->city)) $reps["[city]"] = $details->city;
        
            if (isset($details->virtuemart_country_id)) $reps["[countryid]"] = $details->virtuemart_country_id;
            if (isset($details->virtuemart_country_id)) {
                $country = $this->getCountryFromID ($details->virtuemart_country_id);
                if ($country) {
                    $reps["[country]"] = $country->country_name;
                    $reps["[countrycode2]"] = $country->country_2_code;
                    $reps["[countrycode3]"] = $country->country_3_code;
                }
            }

            if (isset($details->virtuemart_state_id)) $reps["[stateid]"] = $details->virtuemart_state_id;
        }
        if ($nrtype==1) {
            // Only for Invoice:
            if (isset($details->order_number)) $reps["[ordernumber]"] = $details->order_number;
            if (isset($details->virtuemart_order_id)) $reps["[orderid]"] = $details->virtuemart_order_id;
            if (isset($details->order_status)) $reps["[orderstatus]"] = $details->order_status;
        }
        if ($nrtype==2) {
            // Customer number:
            if (isset($details->username)) $reps["[username]"] = $details->username;
            if (isset($details->name)) $reps["[name]"] = $details->name;
            if (isset($details->user_is_vendor)) $reps["[user_is_vendor]"] = $details->user_is_vendor;
        }
        JPluginHelper::importPlugin('vmshopper');
        JDispatcher::getInstance()->trigger('onVmOrdernumberGetVariables',array(&$reps, $fmt, $nrtype, $details));
        return str_ireplace (array_keys($reps), array_values($reps), $fmt);
    }

    /* Type 0 means order number, type 1 means invoice number, type 2 means customer number */
    function format_number ($fmt, $details, $nrtype = 0, $global = 1, $padding = 1) {
        // First, replace all variables:
        $nr = $this->replace_fields ($fmt, $nrtype, $details);

        // Split at a | to get the number format and a possibly different counter increment format
        // If a separate counter format is given after the |, use it, otherwise reuse the number format itself as counter format
        $parts = explode ("|", $nr);
        $format = $parts[0];
        
        $counterfmt = ($global==1)?"":$parts[(count($parts)>1)?1:0];
        
        // Look up the current counter
        $count = $this->_getCounter($nrtype, $counterfmt) + 1;
        $this->_setCounter($nrtype, $counterfmt, $count);

        // return the format with the counter inserted
        return str_replace ("#", sprintf('%0' . $padding . 's', $count), $format);
    }


    function plgVmOnUserOrder(&$orderDetails/*,&$data*/) {
        // Is order number customization enabled?
        if ($this->params->get('customize_order_number')) {
          $nrtype = 0; /*order-nr*/
          $fmt = $this->params->get ('order_number_format', "#");
          $global = $this->params->get ('order_number_global', 1);
          $padding = $this->params->get ('order_number_padding', 1);
          $ordernr = $this->format_number ($fmt, $orderDetails, $nrtype, $global, $padding);
          // TODO: Check if ordernr already exists
          $orderDetails->order_number = $ordernr;
        }
        // Is order password customization enabled?
        if ($this->params->get('customize_order_password')) {
          $nrtype = 3; /* order password */
          $fmt = $this->params->get ('order_password_format', "[randomHex8]");
          $passwd = $this->replace_fields ($fmt, $nrtype, $orderDetails);
          $orderDetails->order_pass = $passwd;
        }
    }

    function plgVmOnUserInvoice($orderDetails,&$data) {
        // Is order number customization enabled?
        if ($this->params->get('customize_invoice_number')) {
            // check the default configuration
            $orderstatusForInvoice = VmConfig::get('inv_os',array());
            if(!is_array($orderstatusForInvoice)) $orderstatusForInvoice = array($orderstatusForInvoice); //for backward compatibility 2.0.8e
            $pdfInvoice = (int)VmConfig::get('pdf_invoice', 0); // backwards compatible
            $force_create_invoice = JFactory::getApplication()->input->getInt('create_invoice', 0);
            if ( in_array($orderDetails['order_status'],$orderstatusForInvoice)  or $pdfInvoice==1  or $force_create_invoice==1 ){
                $nrtype = 1; /*invoice-nr*/
                $fmt = $this->params->get ('invoice_number_format', "#");
                $global = $this->params->get ('invoice_number_global', 1);
                $padding = $this->params->get ('invoice_number_padding', 1);
                $invoicenr = $this->format_number ($fmt, (object)$orderDetails, $nrtype, $global, $padding);
                // TODO: Check if ordernr already exists
                $data['invoice_number'] = $invoicenr;
                return $data;
            }
        }
    }

    // Customizing the customer numbers requires VM >= 2.0.15b, earlier versions 
    // left out the & and thus didn't allow changing the user data
    function plgVmOnUserStore(&$data) {
        // Is order number customization enabled?
        if ($this->params->get('customize_customer_number') && isset($data['customer_number_bycore']) && $data['customer_number_bycore']==1) {
            $nrtype = 2; /*customer-nr*/
            $fmt = $this->params->get ('customer_number_format', "#");
            $global = $this->params->get ('customer_number_global', 1);
            $padding = $this->params->get ('customer_number_padding', 1);
            $customernr = $this->format_number ($fmt, (object)$data, $nrtype, $global, $padding);
            // TODO: Check if ordernr already exists
            $data['customer_number'] = $customernr;
            return $data;
        }
    }


    /**
     * plgVmOnSelfCallBE ... Called to execute some plugin action in the backend (e.g. set/reset dl counter, show statistics etc.)
     */
    function plgVmOnSelfCallBE($type, $name, &$output) {
        if ($name != $this->_name || $type != 'vmshopper') return false;
        vmDebug('plgVmOnSelfCallBE');
        $user = JFactory::getUser();
        $authorized = ($user->authorise('core.admin','com_virtuemart') or
                       $user->authorise('core.manage','com_virtuemart') or 
                       $user->authorise('vm.orders','com_virtuemart'));
        $json = array();
        $json['authorized'] = $authorized;
        if (!$authorized) return FALSE;

        $action = vRequest::getCmd('action');
        $counter= vRequest::getString('counter');
        $nrtype = vRequest::getInt('nrtype');
        $json['action'] = $action;
        $json['success'] = 0; // default: unsuccessfull
        switch ($action) {
            case "deleteCounter":
                $json['success'] = $this->_deleteCounter($nrtype, $counter);
                break;
            case "addCounter":
                $value = vRequest::getInt('value',0);
                if ($this->_counterExists($nrtype, $counter)) {
                    $json['error'] = JText::sprintf('PLG_ORDERNUMBER_COUNTERLIST_EXISTS', $counter);
                    $json['success'] = false;
                } else {
                    $json['success'] = $this->_addCounter($nrtype, $counter, $value);
                    // Return the table row for the new counter in the JSON:
                    $pluginpath = '/plugins/vmshopper/ordernumber/ordernumber/';
                    $displayfmt = ($counter=="") ? JText::_('PLG_ORDERNUMBER_COUNTERLIST_GLOBAL') : $counter;
                    $html=array();
                    $html[] = "<tr class='counter_row counter_type_$nrtype'>";
                    $html[] = "  <td class='counter_format'>" . (string)$displayfmt . "</td>";
                    $html[] = "  <td class='counter_value'>" . (string)$value . "</td>";
                    $html[] = "  <td class='counter_buttons'><img src='" .JURI::root(true).$pluginpath . "assets/images/icon-16-edit.png' class='vmordernumber-counter-editbtn vmordernumber-btn' onClick='ajaxEditCounter(this, $nrtype, ".json_encode($counter).", $value)' /><img src='" . JURI::root(true).$pluginpath . "assets/images/icon-16-delete.png' class='vmordernumber-counter-deletebtn vmordernumber-btn' onClick='ajaxDeleteCounter(this, $nrtype, ".json_encode($counter).", $value)' /></td>";
                    $html[] = "</tr>";
                    $json['newrow'] = implode("\n", $html);
                }
                break;
            case "setCounter":
                $value = vRequest::getInt('value');
                $json['success'] = $this->_setCounter($nrtype, $counter, $value);
                break;
        }
        
        // Also return all messages (in HTML format!):
        // Since we are in a JSON document, we have to temporarily switch the type to HTML
        // to make sure the html renderer is actually used
        $document = JFactory::getDocument ();
        $previoustype = $document->getType();
        $document->setType('html');
        $msgrenderer = $document->loadRenderer('message');
        $json['messages'] = $msgrenderer->render('Message');
        $document->setType($previoustype);

        // WORKAROUND for broken (i.e. duplicate) content-disposition headers in Joomla 2.x:
        // We request everything in raw and here send the headers for JSON and return
        // the raw output in json format
        $document =JFactory::getDocument();
        $document->setMimeEncoding('application/json');
        JResponse::setHeader('Content-Disposition','attachment;filename="ordernumber.json"');
        $output = json_encode($json);
    }
    
    
    /* In versions before VM 2.6.8, the onStoreInstallPluginTable function was protected, so the installer couldn't call it to create the plugin table...
       This function simply is a public wrapper to make this function available to the installer on all VM versions: */
    public function plgVmOnStoreInstallPluginTable($psType, $name='') {
        return $this->onStoreInstallPluginTable($psType, $name);
    }

}
