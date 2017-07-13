<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_slider_banners
 *
 * @copyright   Copyright (C) 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="row">
	<div id="top_banners" class="owl-carousel owl-theme">
		<?php foreach($list_images as $img): ?>
			<div class="item">
				<a href="#">
					<img src="<?php echo $img ?>" alt=""/>
				</a>
			</div>
		<?php endforeach; ?>
	</div><!-- end /.owl-carousel owl-theme -->
	<div class="owl-controls">
		<div class="owl-nav">
			<a class="owl-prev"><i class="fa fa-chevron-left fa-3x" aria-hidden="true"></i>
			</a>
			<a class="owl-next"><i class="fa fa-chevron-right fa-3x" aria-hidden="true"></i>
			</a>
		</div>				
	</div><!-- end /.owl-controls -->
</div><!-- end /.row -->
