<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die();
$image = new JRegistry($this->value);
?>

<?php if($this->params->get('params.full_mode', 0)):?>
	<?php $url = CImgHelper::getThumb(JPATH_ROOT . DIRECTORY_SEPARATOR . $image->get('image'), $this->params->get('params.thumbs_width', 100), $this->params->get('params.thumbs_height', 100), 'image', $record->user_id,
	array(
		'mode' => $this->params->get('params.thumbs_mode', 1),
		'strache' => $this->params->get('params.thumbs_stretch', 0),
		'background' => $this->params->get('params.thumbs_bg', "#000000"),
		'quality' => $this->params->get('params.thumbs_quality', 80))); ?>
<?php else:?>
	<?php $url = JUri::root(TRUE).'/'.$this->value['image'];?>
<?php endif;?>

<?php if($this->params->get('params.lightbox_full', 0)):?>
	<?php JHtml::_('lightbox.init');?>
	<a href="<?php echo JUri::root(TRUE).'/'.$image->get('image');?>" title="<?php echo $image->get('image_title');?>" rel="lightbox">
<?php elseif ($this->params->get('params.allow_custom_url')):?>
            <a href="<?php echo $image->get('image_customurl');?>" target="<?php echo $this->params->get('params.custom_url_target'); ?>">
<?php endif;?>

<img src="<?php echo $url;?>"
	class="img-polaroid"
	hspace="<?php echo $this->params->get('params.img_hspace');?>"
	vspace="<?php echo $this->params->get('params.img_vspace');?>"
	alt="<?php echo htmlspecialchars($image->get('image_title', $record->title), ENT_COMPAT, 'UTF-8');?>"
	title="<?php echo htmlspecialchars($image->get('image_title', $record->title), ENT_COMPAT, 'UTF-8');?>">

<?php if($this->params->get('params.lightbox_full', 0)):?>
        </a>
<?php elseif ($this->params->get('params.allow_custom_url')):?>
        </a>
<?php endif;?>

<?php if($image->get('image_title')):?>
	<br><small><?php echo  $image->get('image_title'); ?></small>
<?php endif;?>

