<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id: authorizerequest.php 8703 2015-02-15 17:11:16Z alatak $
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - March 02 2015 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */
class amazonHelperAuthorizeRequest extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_AuthorizeRequest $authorizationRequest, $method) {
		parent::__construct($authorizationRequest, $method);
	}



	function getContents () {

		$contents = $this->tableStart("AuthorizeRequest");
		$contents .= $this->getRow("Dump: ", var_export($this->amazonData, true));

		$contents .= $this->tableEnd();

		return $contents;
	}


}