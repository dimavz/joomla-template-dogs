<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>
<div class="col-xs-6 col-md-12">
	<div class="wrap_panel">
<?php foreach ($list as $i => &$item)
{
	// Если ID входит в путь ссылки, то делаем ссылку активной
	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	
		echo '<div class="header_panel">';
		echo '<h3 class="title_panel">';
		echo $item->title;
		echo '</h3></div>';										

	//require JModuleHelper::getLayoutPath('mod_menu', 'usermenu_url');
	print_r($item);

}
?>
</div><!-- wrap_panel -->
</div><!-- col-xs-6 col-md-12 -->
