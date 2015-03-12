<?php
/**
*
* Base controller Frontend
*
* @package		VirtueMart
* @subpackage
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2011-2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: virtuemart.php 8709 2015-02-16 12:05:39Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the controller framework
jimport('joomla.application.component.controller');

/**
 * VirtueMart Component Controller
 *
 * @package		VirtueMart
 */
class VirtueMartControllerVirtuemart extends JControllerLegacy
{

	function __construct() {
		parent::__construct();
		if (VmConfig::get('shop_is_offline') == '1') {
		    vRequest::setVar( 'layout', 'off_line' );
	    }
	    else {
		    vRequest::setVar( 'layout', 'default' );
	    }
	}

	/**
	 * Override of display to prevent caching
	 *
	 * @return  JController  A JController object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false){

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = vRequest::getCmd('view', 'virtuemart');
		$viewLayout = vRequest::getCmd('layout', 'default');

		//vmdebug('basePath is NOT VMPATH_SITE',$this->basePath,VMPATH_SITE);
		$view = $this->getView($viewName, $viewType);
		$view->assignRef('document', $document);

		$view->display();

		return $this;
	}

	public function keepalive(){
		jExit();
	}
	
	function subscribe(){
        require_once "Mailchimp.php";
        
        $email = JRequest::getVar('email');
        
        $apikey  ='79838c53d7a55bcf0e3b90ff96a89002-us10';
        $mailchimp  = new Mailchimp($apikey);
        $list_id ='0b6ed10891';
        $data  = array('email'=>$email);
        $result = $mailchimp->mailchimp_subcriber($data, $mailchimp, $list_id);
   
        $this->setRedirect(JRoute::_("index.php?option=com_contact&view=contact&id=1&layout=subscribe&Itemid=1"));
    }
	
	function getTime(){
		$day = JRequest::getVar('day');
		setlocale(LC_TIME, array('da_DA.UTF-8','da_DA@euro','da_DA','danish'));
		echo utf8_encode(strftime("%a. d. %d %b. %Y kl. %H:%M",strtotime('+'.$day.' day', time())));
		die();
	}
}
 //pure php no closing tag
