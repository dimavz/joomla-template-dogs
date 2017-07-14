<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true));

?>
<div class="top_search">
	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
	<div class="form_find">
		<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline">
			<div class="form-group">
				<label class="sr-only" for="mod-search-searchword<?php echo $module->id ?>">Поиск</label>
				<div class="input-group">
					<input type="text" class="form-control" id="mod-search-searchword<?php echo $module->id ?>" placeholder="<?php echo $text ?>" size="150" width="250px">
					<div class="input-group-addon btn btn-info" type="submit" onclick="this.form.searchword.focus();">Найти</div>
				</div><!-- end /.input-group -->
			</div><!-- end /.form-group -->
	
			<input type="hidden" name="task" value="search" />
			<input type="hidden" name="option" value="com_search" />
			<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		</form>
	</div><!-- end /.form_find -->
</div>