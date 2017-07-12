<?php
/**
 * @package 	Cobalt Carousel Pro Module by JoomBoost
 * @version 	1.0
 * @author 		JoomBoost
 * @website		www.joomboost.com
 * @copyright 	Copyright (C) 2012 - JoomBoost
 * @license 	GNU/GPL http://www.gnu.org/copyleft/gpl.html
 **/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="main_slider">
	<div id="carousel-main" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
		<?php $count=0; ?>
		<?php foreach($result['list'] AS $record): ?>
			<?php if ($count==0):?>
				<li data-target="#carousel-main" data-slide-to="<?php echo $count;?>" class="active"></li>
			<?php else:?>
				<li data-target="#carousel-main" data-slide-to="<?php echo $count;?>"></li>
			<?php endif;?>
			<?php $count++; ?>
			
		<?php endforeach; ?>
		</ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php $count=0;?>
			 <?php foreach($result['list'] AS $record): ?>
			 <?php preg_match('/<img .*src=["|\']([^"|\']+)/i',$record->fields_by_id[$picture_field]->result,$img_urlRel); ?>
				<?php if ($count==0):?>
				<div class="item active">
					<a href="<?php echo $record->url; ?>">
						<img <?php echo getCAttributs($record->title,$img_urlRel[1],$lazy_load)?>">
					</a>
					<div class="carousel-caption">
						<h3>
							<a href="<?php echo $record->url; ?>">
								<?php echo JHtml::_('string.truncate', $record->title, $titlelimit); ?>
							</a>
						</h3>
						<div class="item_text">
							<?php echo JHtml::_('string.truncate', strip_tags(html_entity_decode($record->fields_by_id[$desc_field]->result)), $desclimit); ?>			
						</div><!-- /.item_text -->
						<a href="<?php echo $record->url; ?>" class="btn btn-info">Подробнее...</a>
					</div><!-- /.carousel-caption -->	
				</div><!-- /.item active -->
				<?php $count++;?>
			<?php else:?>
				<div class="item">
					<a href="<?php echo $record->url; ?>">
						<img <?php echo getCAttributs($record->title,$img_urlRel[1],$lazy_load)?>">
					</a>
					<div class="carousel-caption">
						<h3>
							<a href="<?php echo $record->url; ?>">
								<?php echo JHtml::_('string.truncate', $record->title, $titlelimit); ?>
							</a>
						</h3>
						<div class="item_text">
							<?php echo JHtml::_('string.truncate', strip_tags(html_entity_decode($record->fields_by_id[$desc_field]->result)), $desclimit); ?>			
						</div><!-- /.item_text -->
						<a href="<?php echo $record->url; ?>" class="btn btn-info">Подробнее...</a>
					</div><!-- /.carousel-caption -->	
				</div><!-- /.item -->
			<?php endif;?>
			
			<?php endforeach; ?>
		</div><!-- /.carousel-inner -->
		<!-- Controls -->
					<a class="left carousel-control" href="#carousel-main" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Предыдущий</span>
					</a>
					<a class="right carousel-control" href="#carousel-main" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Следующий</span>
					</a>
	</div><!-- /#carousel-main -->
</div><!-- /.main_slider -->
