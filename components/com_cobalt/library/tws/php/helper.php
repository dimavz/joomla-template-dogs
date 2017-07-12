<?php
/**
 * TWS Framework by TADAMONET Web Solutions
 * Author Website: http://www.tadamonet.net/
 * @copyright Copyright (C) 2012 TADAMONET Web Solutions (http://www.tadamonet.net). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die();

//Smart Media files loader.
function mFileLoader(array $filename){	
	$document = JFactory::getDocument();
	$headData = $document->getHeadData();
	foreach ($filename as $file => $type){
		switch ($type) {
			case 'css':
				if(!isset($headData["styleSheets"]["/components/com_cobalt/library/tws/".$type."/".$file.".min.css"])){
					$document->addStyleSheet(JUri::root(TRUE).'/components/com_cobalt/library/tws/'.$type.'/'.$file.'.min.css');						
				}
			break;
			case 'js':
				if(!isset($headData["scripts"]["/components/com_cobalt/library/tws/".$type."/".$file.".min.js"])){
					$document->addScript(JUri::root(TRUE).'/components/com_cobalt/library/tws/'.$type.'/'.$file.'.min.js');
				}
			break;
		}
	}
}

//load addthis script
function atshare($pubid,$track,$url,$title,$desc){
	if($track) $trackme ='<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>'; else $trackme='';
	$desc = strip_tags($desc);
	$url ='http://'.$_SERVER['HTTP_HOST'].$url;
	$ats = '<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style" addthis:url="'.$url.'" addthis:title="'.$title.'" addthis:description="'.$desc.'">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	<a class="addthis_counter addthis_bubble_style"></a>
	</div>'.$trackme.'<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$pubid.'"></script>
	<!-- AddThis Button END -->';
	return $ats;
}

// Link checker and maker
function urlm($link,$label,$rs = ''){
	if(preg_match('[http|https]', $link)) $newlink = '<a href="'.$link.'"'.$rs.'>'.$label.'</a>';
	else $newlink = '<a href="http://'.$link.'"'.$rs.'>'.$label.'</a>';
	return $newlink;
}

function surlm($link,$label){
	if(preg_match('[http|https]', $link)) $newlink = '<a href="'.$link.'">'.$label.'</a>';
	else $newlink = '<a href="http://'.$link.'" target="_blank">'.$label.'</a>';
	return $newlink;
}


// add absolute path to videos links if http or https not found


// check if url is youtube/youtu.be or vimeo
function videoType($link) {
	if (strpos($link, 'youtube') > 0) {
		return 'youtube';
	} elseif (strpos($link, 'vimeo') > 0) {
		return 'vimeo';
	}elseif (strpos($link, 'yout.be') > 0) {
		return 'youtube';
	} else {
		return 'unknown';
	}
}

function getYoutubeID($url) {
	$pattern =
	'%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
			;
			$result = preg_match($pattern, $url, $matches);
			if (false !== $result) {
				return $matches[1];
			}
			return false;
}

function getVimeoID($url) {
	$regex = '~
		# Match Vimeo link and embed code
		(?:<iframe [^>]*src=")?         # If iframe match up to first quote of src
		(?:                             # Group vimeo url
				https?:\/\/             # Either http or https
				(?:[\w]+\.)*            # Optional subdomains
				vimeo\.com              # Match vimeo.com
				(?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
				\/                      # Slash before Id
				([0-9]+)                # $1: VIDEO_ID is numeric
				[^\s]*                  # Not a space
		)                               # End group
		"?                              # Match end quote if part of src
		(?:[^>]*></iframe>)?            # Match the end of the iframe
		(?:<p>.*</p>)?                  # Match any title information stuff
		~ix';

	preg_match( $regex, $url, $matches );

	return $matches[1];
}

// Get video ID from youtube or vimeo
function getVideoID($link){
	$type = videoType($link);
	$videoID = 'NOTFOUND';
	if($type == 'youtube'){
		$videoID = getYoutubeID($link);
	}
	if($type == 'vimeo'){
		$vimeoID = getVimeoID($link);
	}
	return $videoID;	
}

function videoLinkC($link){
	$type = videoType($link);
	$videoID = 'NOTFOUND';
	if($type == 'youtube'){
		$videoID = getYoutubeID($link);
		$url = 'http://youtu.be/'.$videoID;
	}
	if($type == 'vimeo'){
		$vimeoID = getVimeoID($link);
		$url = 'http://vimeo.com/'.$vimeoID;
	}
	return $url;
}

function getVideoEmbed($link,$width,$height){
	$type = videoType($link);
	$embedCode = '';
	if($type == 'youtube'){
		$videoID = getYoutubeID($link);
		return $embedCode='<iframe width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.$videoID.'" frameborder="0" allowfullscreen></iframe>';
	}
	if($type == 'vimeo'){
		$vimeoID = getVimeoID($link);
		return $embedCode='<iframe src="//player.vimeo.com/video/'.$vimeoID.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}else{
		return '<p style="color:red"><strong>Invalid Video, Please Enter valid video link.</strong></p>';
	}
}

// return video thumb from youtube or vimeo
function getVideoThumbUrl($link){
	$type = videoType($link);
    $videoID = 'NOTFOUND';
    $thumbLink="";
	if($type == 'youtube'){
		$videoID = getYoutubeID($link);
		$thumbLink = 'http://img.youtube.com/vi/'.$videoID.'/0.jpg';
	}
	if($type == 'vimeo'){
		$vimeoID = getVimeoID($link);
		$vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$vimeoID.".php"));
		//$small = $vimeo[0]['thumbnail_small'];
		//$large = $vimeo[0]['thumbnail_large'];
		$thumbLink = $vimeo[0]['thumbnail_medium'];
	}
	return $thumbLink;
}

// Load twitter card feature in doc head
function tcard($url,$title,$desc,$img_url){
	$desc = strip_tags($desc);
	$url ='http://'.$_SERVER['HTTP_HOST'].$url;
	$img_furl ='http://'.$_SERVER['HTTP_HOST'].$img_url;
	$tcard = '<meta name="twitter:card" content="summary">'.
	'<meta name="twitter:url" content="'.$url.'">'.
	'<meta name="twitter:title" content="'.$title.'">'.
	'<meta name="twitter:description" content="'.$desc.'">'.
	'<meta name="twitter:image" content="'.$img_furl.'">';
	$document = JFactory::getDocument();
	$document->addCustomTag($tcard);
}

// Load Open graph feature in doc head
function openg($url,$title,$desc,$img_url,$type){
	$desc = strip_tags($desc);
	$config = JFactory::getConfig();
	$url ='http://'.$_SERVER['HTTP_HOST'].$url;
	$img_furl ='http://'.$_SERVER['HTTP_HOST'].$img_url;
	$og = '<meta property="og:type" content="'.$type.'" />'. 
	'<meta property="og:url" content="'.$url.'" />'.
	'<meta property="og:site_name" content="'.$config->get('sitename').'"/>'.
	'<meta property="og:title" content="'.$title.'" />'.
	'<meta property="og:description" content="'.$desc.'"/>'.
	'<meta property="og:image" content="'.$img_furl.'" />';
	$document = JFactory::getDocument();
	$document->addCustomTag($og);
}

function relatedRecords(array $option){	    
	
		$app = JFactory::getApplication();
	
		$section_id = $option['item_section_id'];
	
		$user_id = $cat_id = NULL;
		$user    = JFactory::getUser();
	
		$author = $app->input->get('user_id');
		
		if(!$author && $app->input->get('option') == 'com_cobalt' && $app->input->getCmd('view') == 'record' && $app->input->getInt('id'))
		{
			$record = ItemsStore::getRecord($app->input->getInt('id'));
			$author = $record->user_id;
		}
	
		switch($option['user_restrict'])
		{
			case 1:
				$user_id = $user->get('id');
				break;
			case 2:
				$user_id = $author;
				break;
			case 3:
				$user_id =  $author ? $author : $user->get('id');
				break;
			case 4:
				$user_id = $user->get('id', $author);
				break;
		}
		$cat_id = implode(',',array_keys($option['item_categories']));
	
		if($option['cat_restrict'])
		{	
			if($option['cat_restrict'] == 2)
			{
				$section = ItemsStore::getSection($section_id);
				if(!$section->params->get('general.records_mode'))
				{
					$db  = JFactory::getDbo();
					$sql = "SELECT lft, rgt FROM `#__js_res_categories` WHERE id = {$cat_id}";
					$db->setQuery($sql);
					$res = $db->loadObject();
	
					if($res)
					{
						$cat_sql = "SELECT id FROM `#__js_res_categories`
						WHERE lft >= " . (int)$res->lft . " AND rgt <= " . (int)$res->rgt . "
							AND section_id = {$section_id}
						AND published = 1";
						$db->setQuery($cat_sql);
						$cats = $db->loadColumn();
						$cat_id = implode(',', $cats);
					}
				}
			}
		}
		if($option['catids'])
		{
		$cat_id = $option['catids'];
		}
	
		if($option['force_itemid'])
		{
		$app->input->set('force_itemid', $option['force_itemid']);
		}
	
		$app->input->set('section_id', $option['section_id']);
	
		$api    = new CobaltApi();
		$result = $api->records(
				$section_id,
				$option['view_what'],
				$option['orderby'],
				$option['type_id'],
				$user_id,
				$cat_id,
				$option['limit'],
				null,
				FALSE,
				FALSE,
			$option['lang_mode']);
	  
	 return $result;
}


