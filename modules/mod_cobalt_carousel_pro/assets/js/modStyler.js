jQuery(document).ready(function(){
  jQuery('div#general > div.row-fluid > div.span9 > div.control-group').addClass('GroupFieldElem');
  jQuery('span.myHeadGroup').parent().parent().parent().removeClass('GroupFieldElem').addClass('HeadGroup');

});