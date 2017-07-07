<?php
/**
 * AG Picture field for Cobalt by MintJoomla
 * 
 * @name		ag_picture.php
 * @package		AG Picture field
 * @subpackage	default field controller
 * @author		Abstrakt Graphics - http://abstrakt.fr/
 * @copyright	Copyright (C) 2013 Abstrakt (http://www.abstrakt.fr). All rights reserved.
 */

defined('_JEXEC') or die();
//require_once JPATH_ROOT.DS.'components/com_cobalt/library/php/fields/cobaltfield.php';
require_once JPATH_ROOT.'/components/com_cobalt/library/php/fields/cobaltfield.php';


class JFormFieldCAg_picture extends CFormField
{
	static $_loaded		= false;
	
	/**
	 * Allowed extensions
	 *
	 * @var	array
	 */
	protected $_exts	= array('gif', 'png', 'jpg', 'jpeg');


	/**
	 * Get the input form field
	 *
	 * @return	string	HTML
	 */
	public function getInput()
	{
		JHtml::_('behavior.framework', true);

		if(is_string($this->value))
		{
			$this->value	= json_decode($this->value, true);
			if(!is_array($this->value))
			{
				settype($this->value, 'array');
			}
		}
		
	    $subfolder			= str_replace('\\', DS, $this->params->get('params.subfolder', $this->field_type));
	    if (isset($this->value['subfolder'])) {
	    	$subfolder		= $this->value['subfolder'];
	    }
		$this->directory	= JComponentHelper::getParams('com_cobalt')->get('general_upload').DS.$subfolder;
		
		return $this->_display_input();
	}

	public function onJSValidate()
	{
		return parent::onJSValidate();
	}

	/**
	 * Validate the file extension and size
	 * 
	 * @param	mixed	value
	 * @param	object	record
	 * @param	string	type
	 * @param	mixed	section
	 * @return	boolean	result
	 */
	public function validate($value, $record, $type, $section)
	{
		$newfile	= JRequest::getVar('file'.$this->id, null, 'files', 'array');
		$name		= '';
//		echo '<pre>';print_r($newfile);echo '</pre>';exit;
	
		if ($newfile && !$newfile['error']) {
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			
		    $subfolder	= str_replace('\\', DS, $this->params->get('params.subfolder', $this->field_type)) . DS;
			$folder		= JPath::clean(JPATH_ROOT . DS . JComponentHelper::getParams('com_cobalt')->get('general_upload') . DS . $subfolder);
			
			$name		= JFile::makeSafe($newfile['name']);
			$size		= (int)($newfile['size']/1024);
			$ext 		= strtolower(substr($name, strrpos($name, '.') + 1));
			
			//Create folder SUBFOLDER
			if (!JFolder::exists($folder))
			{
				if (!JFolder::create($folder, 0777)
//				 || !JFolder::create($folder.'thumbnail_blog', 0777)
//				 || !JFolder::create($folder.'thumbnail_article', 0777)
				 || !JFile::write($folder . 'index.html', $index = '<html><body></body></html>')
				 )
				{
					$message	= JText::_('Cannot create folder(s), Please, check upload directory is correct and accessible');
					$this->setError($message);
					return false;
				}
			}
			
			//Test extension
			if (!in_array($ext, $this->_exts))
			{
				$message	= JText::_("File is not appropriate format");
				$message	.= "<br/>File: ".basename($name);
				$message	.= "<br/>Allowed Formats: ".implode(", ", $this->_exts);
				$this->setError($message);
				return false;
			}
			
			//Test size
			$max_size	= $this->params->get('params.max', '2048');
			if (($size > $max_size) && $max_size)
			{
				$message	= JText::_("File exceed allowed size");
				$message	.= "<br\>File: ".$name;
				$message	.= "<br\>Size: ".number_format($size, 0, '', ',');
				$message	.= "<br\>Allowed Size: ".number_format($max_size, 0, '', ',');
				$this->setError($message);
				return false;
			}
			
			//Test file already exist
			if(!$this->params->get('params.attach', 0)) {
				//Test file existance
				$dest	= $folder.$name;
				if (JFile::exists($dest) && !$this->params->get('params.overwrite', 1))
				{
					$message	= JText::_("This File already Exists");
					$message	.= "<br\>File: ".$name;
					$this->setError($message);
					return false;
				}
			}
		} elseif ((!isset($value['image']) || isset($value['remove'])) && !$this->params->get('params.default_img')) {
			//Validate field empty for required
			$value		= null;
		}
	
		return parent::validate($value, $record, $type, $section);
	}
	
	/**
	 * Save Prepare
	 * Upload the image file if necessary
	 *
	 * @param	mixed	value
	 * @param	object	record
	 * @param	string	type
	 * @param	mixed	section
	 * @return	boolean	result
	 */
	public function onPrepareSave($value, $record, $type, $section)
	{
		$newfile	= JRequest::getVar('file'.$this->id, null, 'files', 'array');
		
		if (!$value && !$newfile) return;
		
		$params		= &$this->params;
	    $subfolder	= str_replace('\\', DS, $params->get('params.subfolder', $this->field_type)) . DS;
		$folder		= JPath::clean(JPATH_ROOT . DS . JComponentHelper::getParams('com_cobalt')->get('general_upload') . DS . $subfolder);

		jimport('joomla.filesystem.file');
		
		// Delete old file :
		if (isset($value['remove']) && isset($value['image'])) {
			JFile::delete($folder.$value['image']);
//			JFile::delete($folder.'thumbnail_blog'.DS.$value['image']);
//			JFile::delete($folder.'thumbnail_article'.DS.$value['image']);
			unset($value['image']);
			unset($value['remove']);
			unset($value['subfolder']);
		}
		
		// Add new file image
		if ($newfile && !$newfile['error']) {
			$tmp_name	= $newfile['tmp_name'];
			$name		= JFile::makeSafe($newfile['name']);
			$size		= (int)($newfile['size']/1024);
			$ext 		= strtolower(substr($name, strrpos($name, '.') + 1));
			
			if($params->get('params.attach', 0)) {
				$name	= time().'_'.$name;
			}
//			$db				= JFactory::getDbo();
//			$value['image']	= $db->escape($name);

			$dest		= $folder.$name;
			if (!JFile::upload($tmp_name, $dest))
			{
				$message	= JText::_("Could not upload the file");
				$message		.= "<br\>File: ".$name;
				JError::raiseError(403, $msg);
				return false;
			}
			
			$value['image']		= $name;
			$value['subfolder']	= $subfolder;
		}

		if ($value)
		{
			$value = json_encode($value);
		}
		return $value;
	}

	public function onRenderFull($record, $type, $section)
	{
		return $this->_render('full', $record, $type, $section);
	}

	public function onRenderList($record, $type, $section)
	{
		return $this->_render('list', $record, $type, $section);
	}
	
	/**
	 * Render generic function
	 *
	 * @param	string	client (full/list)
	 * @param	object	record
	 * @param	string	type
	 * @param	mixed	section
	 * @return	string	HTML output
	 */
	private function _render($client, $record, $type, $section)
	{
		if (!$this->value)
			return;

		$value		= json_decode($this->value, true);
		if (!$value)
			return;

		if((!isset($value['image']) || !$value['image']) && $this->params->get('params.default_img'))
		{
			$value['image']		= str_replace('\\', '/', $this->params->get('params.default_img'));
			$value['subfolder']	= '';
		}

		if ($value['image'])
		{
			$this->value	= $value;
			JFactory::getDocument()->addStyleSheet(JURI::root() . 'components/com_cobalt/fields/ag_picture/css/ag_picture.css');
			$this->user		= JFactory::getUser();

			return $this->_display_output($client, $record, $type, $section);
		}
		return;
	}
}
