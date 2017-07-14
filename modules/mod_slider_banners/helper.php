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
	
	public function getImages($params){
		$images = array();
		$count=1;
		while($count<=10){
			$img_item = array();
			if($params->get('image'.$count)!='' && $params->get('link_image'.$count)!='' ){
				$img_item['src'] = Juri::base().$params->get('image'.$count);
				$img_item['link'] = $params->get('link_image'.$count);
				array_push($images,$img_item);
			}
			else if($params->get('image'.$count)!='' && $params->get('link_image'.$count)==''){
				$img_item['src'] = Juri::base().$params->get('image'.$count);
				array_push($images,$img_item);
			}
			$count++;
		}
		//print_r($images);
		return $images;
	}
}

?>