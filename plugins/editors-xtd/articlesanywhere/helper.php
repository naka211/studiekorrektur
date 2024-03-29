<?php
/**
 * Plugin Helper File
 *
 * @package         Articles Anywhere
 * @version         3.8.4
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Plugin that places the button
 */
class plgButtonArticlesAnywhereHelper
{
	public function __construct(&$params)
	{
		$this->params = $params;
	}

	/**
	 * Display the button
	 *
	 * @return array A two element array of ( imageName, textToInsert )
	 */
	function render($name)
	{
		$button = new JObject;

		if (JFactory::getApplication()->isSite() && !$this->params->enable_frontend)
		{
			return $button;
		}

		require_once JPATH_PLUGINS . '/system/nnframework/helpers/functions.php';
		nnFrameworkFunctions::loadLanguage('plg_editors-xtd_articlesanywhere');

		JHtml::_('behavior.modal');
		JHtml::stylesheet('nnframework/style.min.css', false, true);

		$class = 'nonumber icon-articlesanywhere';
		$link = 'index.php?nn_qp=1'
			. '&folder=plugins.editors-xtd.articlesanywhere'
			. '&file=articlesanywhere.inc.php'
			. '&name=' . $name;

		$text_ini = strtoupper(str_replace(' ', '_', $this->params->button_text));
		$text = JText::_($text_ini);
		if ($text == $text_ini)
		{
			$text = JText::_($this->params->button_text);
		}

		$button->modal = true;
		$button->class = 'btn';
		$button->link = $link;
		$button->text = trim($text);
		$button->name = $class;
		$button->options = "{handler: 'iframe', size: {x:window.getSize().x-100, y: window.getSize().y-100}}";

		return $button;
	}
}
