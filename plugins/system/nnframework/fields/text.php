<?php
/**
 * Element: Text
 *
 * @package         NoNumber Framework
 * @version         15.3.3
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once JPATH_PLUGINS . '/system/nnframework/helpers/text.php';

JFormHelper::loadFieldClass('text');

class JFormFieldNN_Text extends JFormFieldText
{
	public $type = 'Text';

	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$this->element = $element;

		$element['label'] = $this->prepareText($element['label']);
		$element['description'] = $this->prepareText($element['description']);
		$element['translateDescription'] = false;

		return parent::setup($element, $value, $group);
	}

	private function prepareText($string = '')
	{
		$string = trim($string);

		if ($string == '')
		{
			return '';
		}

		// variables
		$var1 = JText::_($this->get('var1'));
		$var2 = JText::_($this->get('var2'));
		$var3 = JText::_($this->get('var3'));
		$var4 = JText::_($this->get('var4'));
		$var5 = JText::_($this->get('var5'));

		$string = JText::sprintf(JText::_($string), $var1, $var2, $var3, $var4, $var5);
		$string = trim(nnText::html_entity_decoder($string));
		$string = str_replace('&quot;', '"', $string);
		$string = str_replace('span style="font-family:monospace;"', 'span class="nn_code"', $string);

		return $string;
	}

	private function get($val, $default = '')
	{
		return (isset($this->element[$val]) && (string) $this->element[$val] != '') ? (string) $this->element[$val] : $default;
	}
}
