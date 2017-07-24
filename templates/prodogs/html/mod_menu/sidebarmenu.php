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
$class = '';
?>
<ul>
<?php foreach ($list as $i => &$item)
{
	if (in_array($item->id, $path))
	{
		$class .= ' active';
		echo '<li class="' . $class . '">';
	}
	else
	{
		echo '<li>';
	}

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'sidebarmenu_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'sidebarmenu_url');
			break;
	endswitch;

	
	echo '</li>';
}
?></ul>
