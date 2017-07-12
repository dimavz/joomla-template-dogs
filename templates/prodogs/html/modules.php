<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.system
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/*
 * none (output raw module content)
 */
function modChrome_empty($module, &$params, &$attribs)
{
	if($module->content){
		echo $module->content;
	}
}

function modChrome_footer_left_block($module, &$params, &$attribs)
{
	if($module->content){
		echo '<div class="col-md-4 col-sm-4 col-xs-12">';
		echo '<div class="footer_left_block wow fadeInDown" data-wow-delay="0.2s">';
			echo '<h3 class="add_ad" role="button">';
			echo $module->title;
			echo '</h3>';
			echo $module->content;
			echo '</div>';
		echo '</div>';
	}
}
function modChrome_footer_center_block($module, &$params, &$attribs)
{
	if($module->content){
		echo '<div class="col-md-4 col-sm-4 col-xs-12">';
		echo '<div class="footer_center_block wow fadeInDown"data-wow-delay="0.4s">';
			echo '<h3 class="reclama" role="button">';
			echo $module->title;
			echo '</h3>';
			echo $module->content;
			echo '</div>';
		echo '</div>';
	}
}
function modChrome_footer_right_block($module, &$params, &$attribs)
{
	if($module->content){
		echo '<div class="col-md-4 col-sm-4 col-xs-12">';
		echo '<div class="footer_right_block wow fadeInDown" data-wow-delay="0.6s">';
			echo '<h3 class="contacts" role="button">';
			echo $module->title;
			echo '</h3>';
			echo $module->content;
			echo '</div>';
		echo '</div>';
	}
}