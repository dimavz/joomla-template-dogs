<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');

// load objects
$app = JFactory::getApplication();
$document = JFactory::getDocument();

// load cobalt api
include_once JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_cobalt' . DIRECTORY_SEPARATOR . 'api.php';

// load tws framwork lib
include_once JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_cobalt' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'tws' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'helper.php';

// load css/js files of carousel
$mf['carouseldefault'] =  "css";
$mf['carouseltheme'] =  "css";
$mf['carouseltransitions'] = "css";
$mf['owl.carousel'] = "js";

// check and add to header
mFileLoader($mf);

// Init params
$picture_field = $params->get('picture_field');
$desc_field = $params->get('desc_field');
$lazy_load = $params->get('lazy_load',0);
$nav = $params->get('nav',0);
$cItems = $params->get('cItems',5);
$caption = $params->get('caption',0);
$desc = $params->get('caption',0);
$autoplay = $params->get('auto_play',5000);
$hoverstop = $params->get('hoverstop',0);
$scrollperpage = $params->get('scrollperpage',0);
$mousedrag = $params->get('mousedrag',1);
$touchdrag = $params->get('touchdrag',1);
$titlelimit = $params->get('titlelimit',20);
$desclimit = $params->get('desclimit',100);
//init carousel style
$document->addStyleSheet(JUri::root(TRUE).'/modules/mod_cobalt_carousel_pro/assets/css/initCarousel.css');

//init carousel script
$carouselScript = 'jQuery(document).ready(function() {
  						jQuery("#cobaltCarousel").owlCarousel({
    						items : '.$cItems.','
    						.'autoPlay: '.$autoplay.','
    						.'autoHeight : true,'
    						.($hoverstop ? 'stopOnHover : true,':'')
    						.($mousedrag ? 'mouseDrag : true,':'mouseDrag : false,')
    						.($touchdrag ? 'touchDrag : true,':'touchDrag : false,')
    						.($scrollperpage ? 'scrollPerPage : true,':'')
    						.'navigationText: ["<i class=\'icon-chevron-left icon-white\'>'.JText::_('CCPREV').'</i>","<i class=\'icon-chevron-right icon-white\'>'.JText::_('CCNEXT').'</i>"],'
    						.($lazy_load ? 'lazyLoad : true,':'')
    						.($nav ? 'navigation : true':'')
 						 .'});
					});';

$document->addScriptDeclaration($carouselScript);

$section_id = $app->input->get('section_id');

$user_id = $cat_id = NULL;
$user    = JFactory::getUser();

$author = $app->input->get('user_id');
if(!$author && $app->input->get('option') == 'com_cobalt' && $app->input->getCmd('view') == 'record' && $app->input->getInt('id'))
{
	$record = ItemsStore::getRecord($app->input->getInt('id'));
	$author = $record->user_id;
}

switch($params->get('user_restrict'))
{
	case 1:
		$user_id = $user->get('id');
		break;
	case 2:
		$user_id = $author;
		break;
	case 3:
		$user_id =  $author ? $author : $user->get('id');
		break;
	case 4:
		$user_id = $user->get('id', $author);
		break;
}
$cat_id = 0;
if($params->get('cat_restrict') && $section_id == $params->get('section_id') && $app->input->getInt('cat_id'))
{
	$cat_id = $app->input->getInt('cat_id');

	if($params->get('cat_restrict') == 2)
	{
		$section = ItemsStore::getSection($section_id);
		if(!$section->params->get('general.records_mode'))
		{
			$db  = JFactory::getDbo();
			$sql = "SELECT lft, rgt FROM `#__js_res_categories` WHERE id = {$cat_id}";
			$db->setQuery($sql);
			$res = $db->loadObject();

			if($res)
			{
				$cat_sql = "SELECT id FROM `#__js_res_categories`
					WHERE lft >= " . (int)$res->lft . " AND rgt <= " . (int)$res->rgt . "
					AND section_id = {$section_id}
					AND published = 1";
				$db->setQuery($cat_sql);
				$cats = $db->loadColumn();
				$cat_id = implode(',', $cats);
			}
		}
	}
}
if($params->get('catids'))
{
	$cat_id = $params->get('catids');
}

if($params->get('force_itemid'))
{
	$app->input->set('force_itemid', $params->get('force_itemid'));
}

$app->input->set('section_id', $params->get('section_id'));

$api    = new CobaltApi();
$result = $api->records(
	$params->get('section_id'),
	$params->get('view_what', 'all'),
	$params->get('orderby'),
	$params->get('types', 0),
	$user_id,
	$cat_id,
	$params->get('limit', 5),
	$params->get('tmpl'),
	FALSE,
	FALSE,
	$params->get('lang_mode', 0));

$app->input->set('force_itemid', null);
$app->input->set('section_id', $section_id);

function getCAttributs($title, $pic, $lazy_load){
	switch ($lazy_load) {
		case 0:
			$attrs = 'src="'.$pic.'" alt="'.$title.'"';
			break;
		case 1:
			$attrs = 'class="lazyOwl" data-src="'.$pic.'" alt="'.$title.'"';
			break;
		default:
			$attrs = 'src="'.$pic.'" alt="'.$title.'"';
			break;
	}
	return $attrs;

}

require JModuleHelper::getLayoutPath('mod_cobalt_carousel_pro', 'default');