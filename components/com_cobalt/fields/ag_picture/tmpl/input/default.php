<?php
/**
 * AG Picture field for Cobalt by MintJoomla
 * 
 * @name		ag_picture.php
 * @package		AG Picture field
 * @subpackage	default input view
 * @author		Abstrakt Graphics - http://abstrakt.fr/
 * @copyright	Copyright (C) 2013 Abstrakt (http://www.abstrakt.fr). All rights reserved.
 */
defined('_JEXEC') or die();

/*<pre><?php print_r($this); ?></pre>*/
/*<input type="file" name="jform[fields][<?php echo $this->id?>][file]" />*/
?>
<?php if (!$this->_loaded): ?>
<script type="text/javascript" language="javascript">
<!--
window.addEvent('domready', function() {
	$('adminForm').setProperty('enctype','multipart/form-data');
});
-->
</script>
<?php $this->_loaded = true;?>
<?php endif;?>

<input type="file" name="file<?php echo $this->id?>" /><br/>
<?php echo JText::_('F_ALLOWED_FORMATS_ARE')." : ".implode(', ', $this->_exts);?><br/>
<?php if(@$this->value['image']):?>
	<span class="small">
		<input type="checkbox" value="1" name="jform[fields][<?php echo $this->id?>][remove]" id="remove<?php echo $this->id?>" />
		<label for="remove<?php echo $this->id?>"><?php echo JText::_('Remove Current')." ({$this->value['image']})";?></label>
		<input type="hidden" name="jform[fields][<?php echo $this->id?>][image]" value="<?php echo $this->value['image'];?>" />
		<input type="hidden" name="jform[fields][<?php echo $this->id?>][subfolder]" value="<?php echo $this->value['subfolder'];?>" />
	</span>
<br/><br/>
<img src="<?php echo $this->directory.$this->value['image'];?>" alt="<?php echo JText::_('I_IMGPREVIEW');?>" name="imagelib<?php echo $this->id;?>" id="imagelib<?php echo $this->id;?>" style="max-width: 400px;" />
<?php endif;?>

<?php /*if($this->params->get('params.allow_caption', 0)):*/?>
<div class="priceblock">
	<table style="border:0px;">
		<tr>
			<td>
				<label for="imagetitle<?php echo $this->id;?>">
					<?php echo JText::_('IMAGETITLE');?>:</label>
			</td>
			<td>
				<input id="imagetitle<?php echo $this->id;?>" type="text"  style="width:230px;" name="jform[fields][<?php echo $this->id;?>][image_title]"
				value="<?php echo (isset($this->value['image_title']) ? stripslashes($this->value['image_title']) : '');?>" class="inputbox"/>
			</td>
		</tr>
	</table>
</div>
<?php /*endif;*/?>
