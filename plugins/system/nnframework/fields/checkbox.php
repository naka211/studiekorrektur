<?php
/**
 * Element: Checkbox
 * Displays options as checkboxes
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

require_once JPATH_PLUGINS . '/system/nnframework/helpers/field.php';

class JFormFieldNN_Checkbox extends nnFormField
{
	public $type = 'Checkbox';

	protected function getInput()
	{
		$this->params = $this->element->attributes();

		JHtml::stylesheet('nnframework/style.min.css', false, true);

		$showcheckall = $this->get('showcheckall', 0);

		$checkall = ($this->value == '*');

		if (!$checkall)
		{
			if (!is_array($this->value))
			{
				$this->value = explode(',', $this->value);
			}
		}

		$options = array();
		foreach ($this->element->children() as $option)
		{
			if ($option->getName() != 'option')
			{
				continue;
			}

			$text = trim((string) $option);
			$hasval = 0;
			if (isset($option['value']))
			{
				$val = (string) $option['value'];
				$disabled = (int) $option['disabled'];
				$hasval = 1;
			}
			if ($hasval)
			{
				$option = '<input type="checkbox" class="nn_' . $this->id . '" id="' . $this->id . $val . '" name="' . $this->name . '[]" value="' . $val . '"';
				if ($checkall || in_array($val, $this->value))
				{
					$option .= ' checked="checked"';
				}
				if ($disabled)
				{
					$option .= ' disabled="disabled"';
				}
				$option .= ' /> <label for="' . $this->id . $val . '" class="checkboxes">' . JText::_($text) . '</label>';
			}
			else
			{
				$option = '<label style="clear:both;"><strong>' . JText::_($text) . '</strong></label>';
			}
			$options[] = $option;
		}

		$options = implode('', $options);

		if ($showcheckall)
		{
			$checkers = array();
			if ($showcheckall)
			{
				$checkers[] = '<input id="nn_checkall_' . $this->id . '" type="checkbox" onclick=" nnScripts.checkAll( this, \'nn_' . $this->id . '\' );" /> ' . JText::_('JALL');

				$js = "
					jQuery(document).ready(function() {
						nnScripts.initCheckAlls('nn_checkall_" . $this->id . "', 'nn_" . $this->id . "');
					});
				";
				JFactory::getDocument()->addScriptDeclaration($js);
			}
			$options = implode('&nbsp;&nbsp;&nbsp;', $checkers) . '<br />' . $options;
		}
		$options .= '<input type="hidden" id="' . $this->id . 'x" name="' . $this->name . '' . '[]" value="x" checked="checked" />';

		$html = array();
		$html[] = '<fieldset id="' . $this->id . '" class="checkbox">';
		$html[] = $options;
		$html[] = '</fieldset>';

		return implode('', $html);
	}
}
