<?php
defined('JPATH_PLATFORM') or die;

// главная функция этого файла, имя этой функции изменять нельзя
function pagination_list_render($list){
    $html = '';
    $gwpages = array();
    // перебираем массив со всеми кнопками пагинации
    foreach ($list['pages'] as $number => $page) {
        if($page['active'] === false){
            $current = $number;
        }
        $countPages = $number;
    }
    // конец перебора массива
    // Далее отрисовываем пагинацию так, как нам захочется
    if($current == 1)
    {
    	$html .= $list['pages'][$current]['data'];
    }
    if($current > 1)
    {
    	$html .= $list['start']['data'];
    	$html .= $list['previous']['data'];
    }
    if($current > 2) //
    {
    	$html .= $list['pages'][$current-2]['data'];
    	//$html .= '<li><span>...</span></li>';
    } 	
    if(isset($list['pages'][$current-1]))
    {
    	$html .= $list['pages'][$current-1]['data'];
    	$html .= $list['pages'][$current]['data'];
    }    
    if(isset($list['pages'][$current+1]))
    {
    	 if(isset($list['pages'][$current+2]))
    		{
    			$html .= $list['pages'][$current+1]['data'];
    			$html .= $list['pages'][$current+2]['data'];
    	 		$html .= $list['next']['data'];
    		}
    		else
    		{
    			$html .= $list['pages'][$current+1]['data'];
    	 		$html .= $list['next']['data'];
    		}
    	 
    } 
    
    if($current < $countPages)
    {
    	$html .= $list['end']['data'];
    } 
    return '<div class="pag_block">
									<div class="pages">
										<div class="wraper_ul"><ul>'.$html.'</div>
									</div>
								</div></ul>';
}
// конец главной функции
function pagination_item_active($item)
{
	//print_r($item);
	$html ='';
	$end = JText::sprintf('JLIB_HTML_END');
	$start = JText::sprintf('JLIB_HTML_START');
	$next = JText::sprintf('JNEXT');
	$prev = JText::sprintf('JPREV');
	if ($item->text == $end )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="end" > >| </a></li>';
		return $html;
	}
	if ($item->text == $start )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="start" >|<</a></li>';
		return $html;
	}
	if ($item->text == $next )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="next" >></a></li>';
		return $html;
	}
	if ($item->text == $prev )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="prev" ><</a></li>';
		return $html;
	}
	$html ='<li><a href="'.$item->link.'" title="'.$item->text.'">'.$item->text.'</a></li>';
	return $html;
}
function pagination_item_inactive($item)
{
	$html 	= '';
	$end 		= JText::sprintf('JLIB_HTML_END');
	$start 	= JText::sprintf('JLIB_HTML_START');
	$next 	= JText::sprintf('JNEXT');
	$prev 	= JText::sprintf('JPREV');
	if(isset($item->active)&& $item->active )
	{
		$html .='<li><a class="active">'.$item->text.'</a></li>';
		return $html;
	}
	else
	{
		return '';
	}
	
	if ($item->text == $end )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="end" > >| </a></li>';
		return $html;
	}
	if ($item->text == $start )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="start" >|<</a></li>';
		return $html;
	}
	if ($item->text == $next )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="next" >></a></li>';
		return $html;
	}
	if ($item->text == $prev )
	{
		$html .='<li><a href="'.$item->link.'" title="'.$item->text.'" class="prev" ><</a></li>';
		return $html;
	}
}
function pagination_list_footer($list)
{
	$html = '';
	return $html;
}
?>