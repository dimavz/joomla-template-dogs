<?php
/**
 * AG Picture field for Cobalt by MintJoomla
 * 
 * @name		full.php
 * @package		AG Picture field
 * @subpackage	default full view
 * @author		Abstrakt Graphics - http://abstrakt.fr/
 * @copyright	Copyright (C) 2013 Abstrakt (http://www.abstrakt.fr). All rights reserved.
 */
defined('_JEXEC') or die();

$value		= &$this->value;
$size		= $this->params->get('params.full_mode', 0);
$upload		= JComponentHelper::getParams('com_cobalt')->get('general_upload');
$subfolder	= $value['subfolder']?$upload . DS . $value['subfolder']:'';
if ($size) {
	$width		= $this->params->get('params.thumbs_width', 100);
	$height		= $this->params->get('params.thumbs_height', 100);
	$quality	= $this->params->get('params.thumbs_quality', 80);
	$stretch	= $this->params->get('params.thumbs_stretch', 0);
	$mode		= $this->params->get('params.thumbs_mode', 1);
	
	$path		= $upload . DS . 'thumbs_cache' . DS . 'ag_picture' . DS;
	if (!JFolder::exists($path))
	{
		JFolder::create($path, 0777);
		JFile::write($path . DS . 'index.html', $index = '<html><body></body></html>');
	}
	$url		= str_replace(JPATH_ROOT, '', $path);
	$url		= str_replace("\\", '/', $url);
	$url		= preg_replace('#^\/#iU', '', $url);
	$url		= JURI::root() . str_replace("//", "/", $url);
	
	$ext		= JFile::getExt($value['image']);
	$new_name	= md5($value['image'] . 'ag_picture' . $width . $height . $mode . $quality . $stretch . $this->id) . '.' . $ext;
	$img		= $path . DS . $new_name;
	
	if (!JFile::exists($img))
	{
		jimport('mint.resizeimage');
		$resizer						= new JS_Image_Resizer();
		$resizer->stretch_if_smaller	= $stretch;
		$resizer->quality				= $quality;
		$resizer->setImage(JPATH_ROOT . DS . $subfolder . $value['image']);
		switch ($mode)
		{
			case 1 :
				$resizer->resize_crop($width, $height, $img);
				break;
			case 2 :
				$resizer->resize_fit($width, $height, $img);
				break;
			case 3 :
				$resizer->resize($width, $height, $img);
				break;
			case 4 :
				$resizer->resizeByWidth($width, $img);
				break;
			case 5 :
				$resizer->resizeByHeight($height, $img);
				break;
			case 6 :
				$resizer->resize_limitwh($width, $height, $img);
				break;
		}
	}
	$url		.= $new_name;
} else {
	$value['image']	= str_replace(DS, '/', $value['image']);
	$url			= JURI::base() . $subfolder . $value['image'];
}

$attrib		= array();
if (isset($value['image_title']) && $value['image_title']) {
	$attrib['title']	= $value['image_title'];
	$attrib['alt']		= $value['image_title'];
} else {
	$attrib['alt']		= $this->getLabelName();
}
if($class = $this->params->get('core.field_class')) {
	$attrib['class']	= $class;
}
$html_img	= JHTML::image($url, $attrib['alt'], $attrib);
?>

<?php if ($this->params->get('params.allow_caption', 0)) : ?>
	<table class="imageTable <?php echo $this->params->get('core.field_class', '');?>">
		<tr>
			<td><?php echo $html_img;?></td>
		</tr>
		<tr>
			<td><?php echo $value['image_title'];?></td>
		</tr>
	</table>
<?php else : ?>
	<?php echo $html_img;?>
<?php endif; ?>
<?php if(in_array($this->params->get('params.allow_download', 0), $this->user->getAuthorisedViewLevels())):?>
	<div class="ag_download">
		<a href="<?php echo JURI::base() . $subfolder . $value['image'];?>" target="_blank">
			<img src="<?php echo JURI::root()?>/media/mint/icons/16/disk.png" alt="<?php echo JText::_('CDOWNLOAD')?>">
		</a>
	</div>
<?php endif;?>
