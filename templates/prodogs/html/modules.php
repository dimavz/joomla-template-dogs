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
function modChrome_default($module, &$params, &$attribs)
{
	if($module->content){

		if ($module->showtitle)
		{
			echo "<h".$headerLevel.">";
			echo $module->title; 
			echo "</h".$headerLevel.">";
		}
		echo $module->content;
	}
}

function modChrome_sidebarmenu($module, &$params, &$attribs)
{
	if($module->content)
	{
		echo "<div class='col-xs-6 col-md-12'>";
		echo "<div class='wrap_panel'>";

		if ($module->showtitle)
		{
			echo "<div class='header_panel'>"; 
			echo "<h3 class='title_panel'>".$module->title."</h3>";
			echo "</div>";
		}
		echo "<div class='body_panel'>";
		echo $module->content;
		echo "</div>"; //body_panel
		echo "</div>"; //wrap_panel
		echo "</div>"; //col-xs-6 col-md-12
		//print_r($params);
	}
}

function modChrome_empty($module, &$params, &$attribs)
{
	if($module->content)
	{
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
function modChrome_footer_bottomline($module, &$params, &$attribs)
{
	if($module->content){
		echo '<div class="footer_bottomline">
						<div class="conteiner">
							<div class="row">
								<div class="col-md-12">';
			echo $module->content;
			echo '</div>
					</div>
						</div>
							</div>';

	}
}