<?php
defined('_JEXEC') or die;

jimport('joomla.filesystem.folder');

class listImagesHelper{
	
	public function getImagesFromFolder($folder){
		$images = array();
		$path_folder =JPATH_BASE.'/images/'.$folder;
		$filesFromFolder = JFolder::files($path_folder);
		foreach($filesFromFolder as $image){
			$image_path = JUri::base().'images/'.$folder.'/'.$image;
			array_push($images,$image_path);
		}
		return $images;
	}
}

?>