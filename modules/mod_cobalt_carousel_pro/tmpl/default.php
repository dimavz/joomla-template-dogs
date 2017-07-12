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
<div id="cobaltCarousel" class="owl-carousel">
	<?php foreach($result['list'] AS $record): ?>
	<?php preg_match('/<img .*src=["|\']([^"|\']+)/i',$record->fields_by_id[$picture_field]->result,$img_urlRel); ?>
		<div class="item cobaltlRecord">
			<div>
				<a href="<?php echo $record->url; ?>">
					<img <?php echo getCAttributs($record->title,$img_urlRel[1],$lazy_load)?>">
				</a>
			</div>
			<?php if($caption): ?>
				<div class="recordCaption">
					<a href="<?php echo $record->url; ?>"><?php echo JHtml::_('string.truncate', $record->title, $titlelimit); ?></a>
				</div>
			<?php endif; ?>
			<?php if($desc): ?>
				<div class="recordDesc">
					<?php echo JHtml::_('string.truncate', strip_tags(html_entity_decode($record->fields_by_id[$desc_field]->result)), $desclimit); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
