<?php
/**
 * Element: Field Content
 * To be used as an extend for fields that have items and categories like Joomla content, CCKs, shops.
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

class nnFormGroupField extends nnFormField
{
	public $type = 'Field';
	public $default_group = 'Categories';

	protected function getInput()
	{
		$this->params = $this->element->attributes();

		return $this->getSelectList();
	}

	public function getGroup()
	{
		$this->params = $this->element->attributes();

		return $this->get('group', $this->default_group ?: $this->type);
	}

	public function getOptions()
	{
		$group = $this->getGroup();
		$id = $this->type . '_' . $group;

		if (!isset($data[$id]))
		{
			$data[$id] = $this->{'get' . $group}();
		}

		return $data[$id];
	}

	public function getSelectList($group = '')
	{
		if (!is_array($this->value))
		{
			$this->value = explode(',', $this->value);
		}

		$size = (int) $this->get('size');
		$multiple = $this->get('multiple');

		$group = $group ?: $this->getGroup();
		$options = $this->getOptions();

		require_once JPATH_PLUGINS . '/system/nnframework/helpers/html.php';

		switch ($group)
		{
			case 'categories':
				return nnHtml::selectlist($options, $this->name, $this->value, $this->id, $size, $multiple);

			default:
				return nnHtml::selectlistsimple($options, $this->name, $this->value, $this->id, $size, $multiple);
		}
	}

	public function missingFilesOrTables($tables = array('categories', 'items'), $component = '', $table_prefix = '')
	{
		$component = $component ?: $this->type;

		if (!nnFrameworkFunctions::extensionInstalled(strtolower($component)))
		{
			return '<fieldset class="alert alert-danger">' . JText::_('ERROR') . ': ' . JText::sprintf('NN_FILES_NOT_FOUND', JText::_('NN_' . strtoupper($component))) . '</fieldset>';
		}

		$group = $this->getGroup();

		if (!in_array($group, $tables) && !in_array($group, array_keys($tables)))
		{
			// no need to check database table for this group
			return false;
		}

		$table_list = $this->db->getTableList();

		$table = isset($tables[$group]) ? $tables[$group] : $group;
		$table = $this->db->getPrefix() . strtolower($table_prefix ?: $component) . '_' . $table;

		if (in_array($table, $table_list))
		{
			// database table exists, so no error
			return false;
		}

		return '<fieldset class="alert alert-danger">' . JText::_('ERROR') . ': ' . JText::sprintf('NN_TABLE_NOT_FOUND', JText::_('NN_' . strtoupper($component))) . '</fieldset>';
	}
}
