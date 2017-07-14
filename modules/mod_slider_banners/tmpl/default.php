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
	<div  class="owl-carousel owl-theme"><!-- Вырезал id="top_banners" -->
				<?php foreach($list_images as $img): ?>
					<?php if(is_array($img) ): ?>
						<div class="item">
							<?php if($img['link']!=''): ?>
							<a href="<?php echo $img['link']; ?>">
								<img src="<?php echo $img['src'] ?>" alt="Alt"/>
							</a>
							<?php else: ?>
								<img src="<?php echo $img['src'] ?>" alt="Alt"/>
							<?php endif; ?>
						</div>
					<?php else: ?>
						<div class="item">
							<img src="<?php echo $img ?>" alt="Alt"/>	
						</div>
					<?php endif; ?>
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
