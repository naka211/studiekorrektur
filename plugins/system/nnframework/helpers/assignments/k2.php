<?php
/**
 * NoNumber Framework Helper File: Assignments: K2
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

require_once JPATH_PLUGINS . '/system/nnframework/helpers/assignment.php';

class nnFrameworkAssignmentsK2 extends nnFrameworkAssignment
{
	public function passPageTypes()
	{
		return $this->passByPageTypes('com_k2', $this->selection, $this->assignment);
	}

	public function passCategories()
	{
		if ($this->request->option != 'com_k2')
		{
			return $this->pass(false);
		}

		$pass = (
			($this->params->inc_categories
				&& (($this->request->view == 'itemlist' && $this->request->task == 'category')
					|| $this->request->view == 'latest'
				)
			)
			|| ($this->params->inc_items && $this->request->view == 'item')
		);

		if (!$pass)
		{
			return $this->pass(false);
		}

		$cats = $this->makeArray($this->getCategories(), true);
		$pass = $this->passSimple($cats, 'include');

		if ($pass && $this->params->inc_children == 2)
		{
			return $this->pass(false);
		}
		else if (!$pass && $this->params->inc_children)
		{
			foreach ($cats as $cat)
			{
				$cats = array_merge($cats, $this->getCatParentIds($cat));
			}
		}

		return $this->passSimple($cats);
	}

	private function getCategories()
	{
		switch ($this->request->view)
		{
			case 'item' :
				return $this->getCategoryIDFromItem();
				break;

			case 'itemlist' :
				return $this->getCategoryID();
				break;

			default:
				return '';
		}
	}

	private function getCategoryID()
	{
		return $this->request->id ?: JFactory::getApplication()->getUserStateFromRequest('com_k2itemsfilter_category', 'catid', 0, 'int');
	}

	private function getCategoryIDFromItem()
	{
		if ($this->article && isset($this->article->catid))
		{
			return $this->article->catid;
		}

		$query = $this->db->getQuery(true)
			->select('i.catid')
			->from('#__k2_items AS i')
			->where('i.id = ' . (int) $this->request->id);
		$this->db->setQuery($query);

		return $this->db->loadResult();
	}

	public function passTags()
	{
		if ($this->request->option != 'com_k2')
		{
			return $this->pass(false);
		}

		$tag = trim(JFactory::getApplication()->input->getString('tag', ''));
		$pass = (
			($this->params->inc_tags && $tag != '')
			|| ($this->params->inc_items && $this->request->view == 'item')
		);

		if (!$pass)
		{
			return $this->pass(false);
		}

		if ($this->params->inc_tags && $tag != '')
		{
			$tags = array(trim(JFactory::getApplication()->input->getString('tag', '')));

			return $this->passSimple($tags, true);
		}

		$query = $this->db->getQuery(true)
			->select('t.name')
			->from('#__k2_tags_xref AS x')
			->join('LEFT', '#__k2_tags AS t ON t.id = x.tagID')
			->where('x.itemID = ' . (int) $this->request->id)
			->where('t.published = 1');
		$this->db->setQuery($query);
		$tags = $this->db->loadColumn();

		return $this->passSimple($tags, true);
	}

	public function passItems()
	{
		if (!$this->request->id || $this->request->option != 'com_k2' || $this->request->view != 'item')
		{
			return $this->pass(false);
		}

		$pass = false;

		// Pass Article Id
		if (!$this->passItemByType($pass, 'ContentIds'))
		{
			return $this->pass(false);
		}

		// Pass Content Keywords
		if (!$this->passItemByType($pass, 'ContentKeywords'))
		{
			return $this->pass(false);
		}

		// Pass Meta Keywords
		if (!$this->passItemByType($pass, 'MetaKeywords'))
		{
			return $this->pass(false);
		}

		// Pass Authors
		if (!$this->passItemByType($pass, 'Authors'))
		{
			return $this->pass(false);
		}

		return $this->pass($pass);
	}

	public function getItem($fields = array())
	{
		$query = $this->db->getQuery(true)
			->select($fields)
			->from('#__k2_items')
			->where('id = ' . (int) $this->request->id);
		$this->db->setQuery($query);

		return $this->db->loadObject();
	}

	private function getCatParentIds($id = 0)
	{
		return $this->getParentIds($id, 'k2_categories', 'parent');
	}
}
