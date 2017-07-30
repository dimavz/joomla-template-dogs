<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();

$list_items = $this->items;

?>

	<ul>
		<?php foreach ($list_items AS $item):?>
			<pre>
			 <?php print_r($item);?>
			</pre>
			<?php break;?> 

		<?php endforeach;?>
	</ul>




