<?php
defined('_JEXEC') or die();
/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Fields
 * @author Reinhold Kainhofer, Open Tools
 * @link http://www.open-tools.net
 * @copyright Copyright (c) 2014 Reinhold Kainhofer. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) 
    require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
VmConfig::loadConfig();

class JFormFieldVmOrdernumberCounters extends JFormField {
    var $_name = 'vmOrdernumberCounters';
    
    protected $countertype;

    public function __get($name)
    {
        switch ($name)
        {
            case 'countertype':
                return $this->$name;
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        switch ($name)
        {
            case 'countertype':
                $this->$name = (string) $value;
                break;

            default:
                parent::__set($name, $value);
        }
    }

    public function setup(SimpleXMLElement $element, $value, $group = null)
    {
        $return = parent::setup($element, $value, $group);

        if ($return) {
            $this->countertype  = (string) $this->element['countertype'];
        }

        return $return;
    }

    protected function makeJSTranslationsAvailable() {
        JText::script('PLG_ORDERNUMBER_JS_NOT_AUTHORIZED');
        JText::script('PLG_ORDERNUMBER_JS_NEWCOUNTER');
        JText::script('PLG_ORDERNUMBER_JS_EDITCOUNTER');
        JText::script('PLG_ORDERNUMBER_JS_INVALID_COUNTERVALUE');
        JText::script('PLG_ORDERNUMBER_JS_MODIFY_FAILED');
        JText::script('PLG_ORDERNUMBER_JS_DELETECOUNTER');
        JText::script('PLG_ORDERNUMBER_JS_DELETE_FAILED');
        JText::script('PLG_ORDERNUMBER_JS_ADD_FAILED');
        JText::script('PLG_ORDERNUMBER_JS_JSONERROR');
    }
    protected function getInput() {
        $pluginpath = '/plugins/vmshopper/ordernumber/ordernumber/';
        $doc = JFactory::getDocument()->addStyleSheet(JURI::root(true) . $pluginpath . 'assets/css/ordernumber.css');
        $doc->addScript(JURI::root(true).$pluginpath . 'assets/js/ordernumber.js');
        vmJsApi::jQuery();
        $this->makeJSTranslationsAvailable();
        
        // Look up the current counters
        $db = JFactory::getDBO();
        $db->setQuery('SELECT `number_format`, `count` FROM `#__virtuemart_shopper_plg_ordernumber` WHERE `number_type`='.$db->quote($this->countertype) . ' ORDER BY `number_format`;' );
        $counters = $db->loadObjectList();
        // Joomla 2.x uses <li> for the params and float:left on the controls, so we need to add that too
        $float = "";
        if (version_compare(JVERSION, '3.0', 'lt')) {
            $float = "float: left; ";
        }
        
        $html=array();
        $html[] = "<img src='".JURI::root(true).$pluginpath . "assets/images/loading.gif' class='vm-ordernumber-loading' style=\"display: none; position: absolute; top: 2px; left: 0px; z-index: 9999;\"/><table class=\"vmordernumber-countertable table-striped \" style=\"display: inline-table; $float\">";
        $html[] = "  <tr>";
        $html[] = "    <th class='counter_format'>".JText::_('PLG_ORDERNUMBER_COUNTERLIST_HEADER_COUNTER')."</th>";
        $html[] = "    <th class='counter_value'>".JText::_('PLG_ORDERNUMBER_COUNTERLIST_HEADER_VALUE'). "</th>";
        $html[] = "    <th class='counter_buttons'></th>";
        $html[] = "  </tr>";
        $html[] = "  <colgroup><col class='counter_type'><col style=\"text-align: center\" ><col ></colgroup>";
        foreach ($counters as $c) {
            $displayfmt = $c->number_format;
            if ($displayfmt=="") {
                $displayfmt = JText::_ ('PLG_ORDERNUMBER_COUNTERLIST_GLOBAL');
            }
            $html[] = "  <tr class='counter_row counter_type_$this->countertype'>";
            $html[] = "    <td class='counter_format'>" . (string)$displayfmt . "</td>";
            $html[] = "    <td class='counter_value'>" . (string)$c->count . "</td>";
            $html[] = "    <td class='counter_buttons'><div class='ordernumber-ajax-loading'><img src='" .JURI::root(true).$pluginpath . "assets/images/icon-16-edit.png' class='vmordernumber-counter-editbtn vmordernumber-btn' onClick='ajaxEditCounter(this, $this->countertype, ".json_encode($c->number_format).", $c->count)' /></div><div class='ordernumber-ajax-loading'><img src='" . JURI::root(true).$pluginpath . "assets/images/icon-16-delete.png' class='vmordernumber-counter-deletebtn vmordernumber-btn' onClick='ajaxDeleteCounter(this, $this->countertype, ".json_encode($c->number_format).", $c->count)' /></div></td>";
            $html[] = "  </tr>";
        }
        $html[] = "  <tr class='addcounter_row'>";
        $html[] = "    <td colspan=3 class='counter_add'><div class='vmordernumber-counter-addbtn vmordernumber-btn' onClick='ajaxAddCounter(this, $this->countertype)'><div class='ordernumber-ajax-loading'><img src='" . JURI::root(true).$pluginpath . "assets/images/icon-16-new.png' class='vmordernumber-counter-addbtn' /></div>" . JText::_('PLG_ORDERNUMBER_COUNTERLIST_ADD') . "</div></td>";
        $html[] = "  </tr>";
        $html[] = "</table>";
        return implode("\n", $html);
    }
}