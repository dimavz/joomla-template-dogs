<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_slider_banners
 *
 * @copyright   Copyright (C) 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
require_once(__DIR__.'/helper.php');

$list_images=array();

if($params->get('images_folder')!= -1){
	//echo 'Пользователь выбрал папку';
	//echo $params->get('images_folder');
	$folder_images = listImagesHelper::getImagesFromFolder($params->get('images_folder'));
	//print_r($folder_images);
	
	foreach($folder_images as $img){
		array_push($list_images,$img);
	}
}
else
{
	
}
//$doc->addStyleSheet(JUri::base().'modules/mod_slider_banners/assets/css/owl.carousel.min.css');
//$doc->addStyleSheet(JUri::base().'modules/mod_slider_banners/assets/css/owl.theme.default.min.css');
//$doc->addScript(JUri::base().'modules/mod_slider_banners/assets/js/owl.carousel.min.js'); 

require JModuleHelper::getLayoutPath('mod_slider_banners',$params->get('layout','default'));

?>

