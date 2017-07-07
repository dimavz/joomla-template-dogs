<?php
/**
 * Addthis Pro Field for Cobalt CCK
 * Author Website: http://www.tadamonet.net/
 * @copyright Copyright (C) 2012 TADAMONET Web Solutions (http://www.tadamonet.net). All rights reserved.
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die();
require_once JPATH_ROOT . DIRECTORY_SEPARATOR . 'components/com_cobalt/library/php/fields/cobaltfield.php';

class JFormFieldCAddthispro extends CFormField
{
	public function getInput()
	{
		return;
	}	

	public function onRenderFull($record, $type, $section)
	{
		if(!$this->params->get('params.pos_full'))
			return $this->_render('full', $record, $type, $section);
		else
			return $this->_render('full', $record, $type, $section, 1);
	}

	public function onRenderList($record, $type, $section)
	{
		return $this->_render('list', $record, $type, $section);
	}

		public function onImport($value, $params, $record = null)
	{
		return;
	}

	public function onImportForm($heads, $defaults)
	{
		return $this->_import_fieldlist($heads, $defaults->get('field.' . $this->id));
	}
	
	// render addthis field
	private function _render($client, $record, $type, $section, $pos = null)
	{	
		
		$ids = $this->_getFieldId();
	
		$item_title = $record->title;
		$item_link 	= $record->href;
		if(!empty($ids['img']))
			$item_pic_url = $this->_getFieldInfo($ids['img'], $record, true);
		else 
			$item_pic_url = '';
		if(!empty($ids['desc']))
			$item_desc = $this->_getFieldInfo($ids['desc'], $record);
		else 
			$item_desc = '';

		$profile_id = $this->params->get('params.profile_id');
		$jsf 		= "//s7.addthis.com/js/300/addthis_widget.js#pubid=".$profile_id;		
		$doc 		= JFactory::getDocument();
		$doc->addScript($jsf);
		$services 	= $this->params->get('params.services_icons');
		$services_counts_v = $this->params->get('params.services_counts_v');
		$services_counts_h = $this->params->get('params.services_counts_h');
		$style 		= $this->params->get('params.style');
		$attrs 		= $this->_addthisAttrs($item_title, $item_link, $item_desc);
		// required for pinterest share button
		$pin_attrs 	= $this->_pinAttrs($item_link, $item_title, $item_pic_url);
		if($style == 'with_counts')
		{
			if(empty($services_counts_v)){
				$services_counts_v[] 	= 'fl';
				$services_counts_v[]	= 'tt';
				$services_counts_v[] 	= 'g1';
				$services_counts_v[] 	= 'li';
				$services_counts_v[] 	= 'ppi';
				$services_counts_v[] 	= 'ac';
			}
			$out_v = '';
			foreach ($services_counts_v as $iv => $sv) {
				if($sv == 'fl')
					$out_v = $out_v.'<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>';
				elseif($sv == 'tt')
					$out_v = $out_v.'<a class="addthis_button_tweet" tw:count="vertical"></a>';
				elseif($sv == 'g1')
					$out_v = $out_v.'<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>';
				elseif($sv == 'li')
					$out_v = $out_v.'<a class="addthis_button_linkedin_counter" li:counter="top"></a>';
				elseif($sv == 'ppi')
					$out_v = $out_v.'<a class="addthis_button_pinterest_pinit"'.$pin_attrs.'pi:pinit:layout="vertical"></a>';
				elseif($sv == 'ac')
					$out_v = $out_v.'<a class="addthis_counter"></a>';
			}
			$out = '<div class="addthis_toolbox addthis_default_style"'.$attrs.'>'.$out_v.'</div>';
		}
		elseif ($style == "with_counts_h") {
			if(empty($services_counts_h)){
				$services_counts_h[] 	= 'fl';
				$services_counts_h[] 	= 'tt';
				$services_counts_h[] 	= 'g1';
				$services_counts_h[] 	= 'li';
				$services_counts_h[] 	= 'ppi';
				$services_counts_h[] 	= 'ac';
			}
			$out_h = '';
			foreach ($services_counts_h as $iv => $sh) {
				if($sh == 'fl')
					$out_h = $out_h.'<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>';
				elseif($sh == 'fr')
					$out_h = $out_h.'<a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:action="recommend"></a>';
				elseif($sh == 'tt')
					$out_h = $out_h.'<a class="addthis_button_tweet" tw:via="addthis"></a>';
				elseif($sh == 'g1')
					$out_h = $out_h.'<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>';
				elseif($sh == 'li')
					$out_h = $out_h.'<a class="addthis_button_linkedin_counter"></a>';
				elseif($sh == 'ppi')
					$out_h = $out_h.'<a class="addthis_button_pinterest_pinit"'.$pin_attrs.'pi:pinit:layout="horizontal"></a>';
				elseif($sh == 'su')
					$out_h = $out_h.'<a class="addthis_button_stumbleupon_badge"></a>';
				elseif($sh == 'ac')
					$out_h = $out_h.'<a class="addthis_counter addthis_pill_style"></a>';
			}
			$out = '<div class="addthis_toolbox addthis_default_style"'.$attrs.'>'.$out_h.'</div>';
		}
		else
		{
			if(empty($services)){
				$services[] = 'facebook';
				$services[]	= 'google_plusone_share';
				$services[] = 'twitter';
				$services[] = 'linkedin';
				$services[] = 'compact';
			}
			$servicesOut = '';		
			foreach ($services as $index => $serviceName) 
			{
				$servicesOut =$servicesOut.'<a class="addthis_button_'.$serviceName.'"></a>';
			}	
			$out = 	'<div class="addthis_toolbox addthis_default_style addthis_'.$style.'_style"'.$attrs.'>
					'.$servicesOut.(in_array('compact', $services) ? '<a class="addthis_counter addthis_bubble_style"></a>' : '').'
					</div>';
		}
		$this->print = $out;		

		if($pos AND $client == 'full')
		{			
			$doc->addScriptDeclaration($this->_getJsPos());
			echo $out;
		}
		else
		return $this->_display_output('$client', $record, $type, $section);
	}
	
	// field position in record return js code.
	private function _getJsPos(){

		$ppos 			= $this->params->get('params.pos_full');
		$custom_pos 	= $this->params->get('params.custom_pos_full');
		$after_before = 'append';
		if($ppos == 3)			
		$after_before	= $this->params->get('params.after_before_full');

		$selector = '';

		if($ppos == 1)
			$selector = 'div.page-header';
		elseif ($ppos == 2)
			$selector = 'article';
		elseif ($ppos == 3)
			$selector = $custom_pos;		
		
		$jsc = "jQuery(document).ready(function(){
					var addthispro = jQuery('div.addthis_toolbox');
					jQuery('".$selector."').".$after_before."(addthispro);
				});";
		return $jsc;
	}
	
	// return common addthis attributes
	private function _addthisAttrs($t, $l, $desc){
		$addthisAttrs =  ' addthis:url="'.$l.'" addthis:title="'.$t.'" addthis:description="'.$desc.'"';
		return $addthisAttrs;
	}
	
	// return pinterest attributes
	private function _pinAttrs($l, $t, $img){
		$pinAttrs = ' pi:pinit:url="'.$l.'" pi:pinit:description="'.$t.'" pi:pinit:media="'.$img.'" ';
		return $pinAttrs;
	}
	
	//get field info picture url or text description
	private function _getFieldInfo($id, $record, $isPIC = null){
		$fields =json_decode($record->fields, true);
		if($isPIC)
		{
			$pic = $fields[$id]['image'];
			return $pic;
		}
		else 
		{
			$desc = substr(strip_tags($fields[$id]), 0, 300);
			return $desc;
		}
	}
	
	// return ids
	private function _getFieldId(){	
		
		$id = array();		
			
		if($this->params->get('params.field_type'))
			
			$id = array('pic' => $this->params->get('params.pic_id'), 'desc' => $this->params->get('params.desc_id'));
		
		else
			
			$id = array('pic' => $this->_getFieldIdFromDB($this->params->get('params.pic_key')), 'desc' => $this->_getFieldIdFromDB($this->params->get('params.desc_key')));
			
		return $id ;	
		
	}
	
	// return field id of given field key
	private function _getFieldIdFromDB($key){
			
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id');
		$query->from($db->quoteName('#__js_res_fields'));
		$query->where($db->quoteName('key')." = ".$db->quote($key));		
		
		$db->setQuery($query);
		$id = $db->loadResult();		
		
		return $id;
		
	}

}