<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();

$item = $this->item;
$params = $this->tmpl_params['record'];
$icons = array();
$category = array();
$author = array();
$details = array();
$time = array();
$started = FALSE;
$i = $o = 0;

$countTab = 1;
$countContentTab = 1;

?>
<style>
	.dl-horizontal dd {
		margin-bottom: 10px;
	}

	.line-brk {
		margin-left: 0px !important;
	}
	<?php echo $params->get('tmpl_params.css');?>
</style>

<?php
if($params->get('tmpl_core.item_categories') && $item->categories_links)
{
	$category['categories'] = sprintf('%s : %s', (count($item->categories_links) > 1 ? JText::_('CCATEGORIES') : JText::_('CCATEGORY')), implode(', ', $item->categories_links));
}
if($params->get('tmpl_core.item_user_categories') && $item->ucatid)
{
	$category['user_categories'] = sprintf('<dt>%s<dt> <dd>%s<dd>', JText::_('CUCAT'), $item->ucatname_link);
}
if($params->get('tmpl_core.item_author') && $item->user_id)
{
	$a['name'] = JText::sprintf('CWRITTENBY', CCommunityHelper::getName($item->user_id, $this->section));
	if($params->get('tmpl_core.item_author_filter'))
	{
		$a['author_filter'] = FilterHelper::filterButton('filter_user', $item->user_id, NULL, JText::sprintf('CSHOWALLUSERREC', CCommunityHelper::getName($item->user_id, $this->section, array('nohtml' => 1))), $this->section);
	}
}
if($params->get('tmpl_core.item_ctime'))
{
	$time['ctime'] = JText::sprintf('CONDATE', JHtml::_('date', $item->created, $params->get('tmpl_core.item_time_format')));
}

if($params->get('tmpl_core.item_mtime'))
{
	$time['mtime'] = JText::_('CMTIME').': '.JHtml::_('date', $item->modify, $params->get('tmpl_core.item_time_format'));
}
if($params->get('tmpl_core.item_extime'))
{
	$time['extime'] = JText::_('CEXTIME').': '.($item->expire ? JHtml::_('date', $item->expire, $params->get('tmpl_core.item_time_format')) : JText::_('CNEVER'));
}

if($params->get('tmpl_core.item_type'))
{
	$details['type'] = sprintf('%s: %s %s', JText::_('CTYPE'), $this->type->name, ($params->get('tmpl_core.item_type_filter') ? FilterHelper::filterButton('filter_type', $item->type_id, NULL, JText::sprintf('CSHOWALLTYPEREC', $this->type->name), $this->section) : NULL));
}
if($params->get('tmpl_core.item_hits'))
{
	$details['hits'] = sprintf('%s: %s', JText::_('CHITS'), $item->hits);
}
if($params->get('tmpl_core.item_comments_num'))
{
	$details['comments_num'] = sprintf('%s: %s', JText::_('CCOMMENTS'), CommentHelper::numComments($this->type, $this->item));
}
if($params->get('tmpl_core.item_favorite_num'))
{
	$details['favorite_num'] = sprintf('%s: %s', JText::_('CFAVORITED'), $item->favorite_num);
}
if($params->get('tmpl_core.item_vote_num'))
{
	$details['vote_num'] = sprintf('%s', $item->votes);
}
if($params->get('tmpl_core.item_follow_num'))
{
	$details['follow_num'] = sprintf('%s: %s', JText::_('CFOLLOWERS'), $item->subscriptions_num);
}
?>

<div class="post">
	<?php if($params->get('tmpl_core.item_title')):?>
		<?php if($this->type->params->get('properties.item_title')):?>
			<div class="post_header">
				<<?php echo $params->get('tmpl_params.title_tag', 'h1')?>>
				<?php echo $item->title?>
				<?php echo CEventsHelper::showNum('record', $item->id);?>
				</<?php echo $params->get('tmpl_params.title_tag', 'h1')?>>
			</div>
		<?php endif;?>
	<?php endif;?>
	<div class="post_category">
		<span class="category">
			<?php if($category):?>
				<?php echo implode(' ', $category);?>
			<?php endif;?>
		</span>
		<div class="btn-group" role="group">
			<?php if(!$this->print):?>
				<div class="pull-right controls">
					<div class="btn-group">
						<?php if($params->get('tmpl_core.item_print')):?>
							<a class="btn btn-mini" onclick="window.open('<?php echo JRoute::_($this->item->url.'&tmpl=component&print=1');?>','win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;">
								<?php echo HTMLFormatHelper::icon('printer.png', JText::_('CPRINT'));  ?></a>
							<?php endif;?>

							<?php if($this->user->get('id')):?>
								<?php echo HTMLFormatHelper::bookmark($item, $this->type, $params);?>
								<?php echo HTMLFormatHelper::follow($item, $this->section);?>
								<?php echo HTMLFormatHelper::repost($item, $this->section);?>
								<?php if($item->controls):?>
									<a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini">
										<?php echo HTMLFormatHelper::icon('gear.png');  ?></a>
										<ul class="dropdown-menu">
											<?php echo list_controls($item->controls);?>
										</ul>
									<?php endif;?>
								<?php endif;?>
							</div>
						</div>
					<?php else:?>
						<div class="pull-right controls">
							<a href="#" class="btn btn-mini" onclick="window.print();return false;"><?php echo HTMLFormatHelper::icon('printer.png', JText::_('CPRINT'));  ?></a>
						</div>
					<?php endif;?>
				</div>
			</div><!-- /.post_category -->
			
			<!-- Начало вывода основного содержания статьи (Полей)-->
			<div class="post_info">
				<!-- Вывод полей без группы -->
				<?php if($item->fields_by_groups[null]):?>
					<?php foreach ($item->fields_by_groups[null] as $field_id => $field):?>
						<?php if (isset($field->value['image'])) :?>
							<div class="post_image">
								<?php echo $field->result; ?>
							</div>
							<?php continue;?>
						<?php endif;?>

						<dt id="<?php echo 'dt-'.$field_id; ?>" class="<?php echo $field->class;?>">
							<?php if($field->params->get('core.show_lable') > 1):?>
								<label id="<?php echo $field->id;?>-lbl">
									<?php echo $field->label; ?>
									<?php if($field->params->get('core.icon')):?>
										<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
									<?php endif;?>
								</label>
								<?php if($field->params->get('core.label_break') > 1):?>
								<?php endif;?>
							<?php endif;?>
						</dt>
						<dd id="<?php echo 'dd-'.$field_id; ?>" class="<?php echo $field->fieldclass;?><?php echo ($field->params->get('core.label_break') > 1 ? ' line-brk' : NULL) ?>">
							<?php echo $field->result; ?>
						</dd>
					<?php endforeach;?>
					<?php unset($item->fields_by_groups[null]);?>
				<?php endif;?>
				<!-- Конец Вывода полей без группы -->

				<div class="clearfix"></div>

				<!-- Вывод полей с группой -->
				<div class="post_text">

					<!-- Формируем ТАБЫ -->
					<?php if(isset($item->fields_by_groups)):?>
						<?php $countTab = $this->countTab; /*Счётчик табов*/ ?>
						<?php echo '<ul class="nav nav-tabs" role="tablist">' ;?>
						<?php $fl = true ; // Флаг активности таба?>
						<?php foreach ($item->fields_by_groups as $group_name => $fields) :?>

							<?php if(!empty($group_name)):?>
								<?php if($fl):?>
									<?php echo '<li role="presentation" class="active">';?>
									<?php echo '<a href="#tab'.$countTab.'" aria-controls="tab'.$countTab.'" role="tab" data-toggle="tab" aria-expanded="true">';?>
									<?php if(!empty($item->field_groups[$group_name]['icon']) && $params->get('tmpl_params.show_groupicon', 1)): ?>
										<?php echo HTMLFormatHelper::icon($item->field_groups[$group_name]['icon']) ?>
									<?php endif; ?>
									<?php echo $group_name;?>
									<?php echo '</a>';?>
									<?php echo '</li>' ;?>
									<?php $fl = false;?>
								<?php else:?>
									<?php echo '<li role="presentation">';?>
									<?php echo '<a href="#tab'.$countTab.'" aria-controls="tab'.$countTab.'" role="tab" data-toggle="tab" aria-expanded="false">';?>
									<?php if(!empty($item->field_groups[$group_name]['icon']) && $params->get('tmpl_params.show_groupicon', 1)): ?>
										<?php echo HTMLFormatHelper::icon($item->field_groups[$group_name]['icon']) ?>
									<?php endif; ?>
									<?php echo $group_name;?>
									<?php echo '</a>';?>
									<?php echo '</li>' ;?>
								<?php endif;?>
							<?php endif;?>
							<?php $countTab++; /*Увеличиваем Счётчик табов*/ ?>	
							<?php $this->countTab = $countTab; /*Увеличиваем Счётчик табов*/ ?>	
						<?php endforeach;?>
						<?php echo '</ul>' ;?>
					<?php endif;?>
					<!-- Конец формирования ТАБОВ -->

					<!-- Формируем поля ТАБОВ -->
					<div class="tab-content">
						<?php if(isset($item->fields_by_groups)):?>
							<?php $countContentTab = $this->countContentTab; /*Счётчик контента*/ ?>
							<?php $fl_cont = true ; // Флаг активности контента таба?>
							<?php foreach ($item->fields_by_groups as $group_name => $fields) :?>
								<?php if($fl_cont):?>
									<?php echo '<div id="tab'.$countContentTab.'" class="tab-pane fade in active" role="tabpanel">' ;?>
									<?php if(!empty($group_name)):?>
										<?php //echo '<ul>' ;?>
										<dl class="dl-horizontal text-overflow">
											<?php foreach ($fields as $field_id => $field):?>
												<?php if($field->params->get('core.show_lable') > 1):?>
													<dt id="<?php echo $field->id;?>-lbl" for="field_<?php echo $field->id;?>" class="<?php echo $field->class;?>" >
														<?php echo $field->label; ?>
														<?php if($field->params->get('core.icon')):?>
															<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
														<?php endif;?>
													</dt>
													<dd class="input-field<?php echo ($field->params->get('core.label_break') > 1 ? '-full' : NULL)?> <?php echo $field->fieldclass;?>">
														<?php echo $field->result; ?>
													</dd>
												<?php else:?>
													<dd class="input-field<?php echo ($field->params->get('core.label_break') > 1 ? '-full' : NULL)?> <?php echo $field->fieldclass;?>">
														<?php echo $field->result; ?>
													</dd>
												<?php endif;?>
											<?php endforeach;?>
										</dl>
										<?php //echo '</ul>' ;?>
									<?php endif;?>
									<?php echo '</div>' ;?>
									<?php $fl_cont = false; ?>
								<?php else:?>
									<?php echo '<div id="tab'.$countContentTab.'" class="tab-pane fade" role="tabpanel">' ;?>
									<?php if(!empty($group_name)):?>
										<?php //echo '<ul>' ;?>
										<dl class="dl-horizontal text-overflow">
											<?php foreach ($fields as $field_id => $field):?>
												<?php if($field->params->get('core.show_lable') > 1):?>
													<dt id="<?php echo $field->id;?>-lbl" for="field_<?php echo $field->id;?>" class="<?php echo $field->class;?>" >
														<?php echo $field->label; ?>
														<?php if($field->params->get('core.icon')):?>
															<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
														<?php endif;?>
													</dt>
													<dd class="input-field<?php echo ($field->params->get('core.label_break') > 1 ? '-full' : NULL)?> <?php echo $field->fieldclass;?>">
														<?php echo $field->result; ?>
													</dd>
												<?php else:?>
													<dd class="input-field<?php echo ($field->params->get('core.label_break') > 1 ? '-full' : NULL)?> <?php echo $field->fieldclass;?>">
														<?php echo $field->result; ?>
													</dd>
												<?php endif;?>
											<?php endforeach;?>
										</dl>
										<?php //echo '</ul>' ;?>
									<?php endif;?>
									<?php echo '</div>' ;?>
								<?php endif;?>
								<?php $countContentTab++; /*Увеличение Счётчика  контента*/ ?>
								<?php $this->countContentTab = $countContentTab; /*Увеличение Счётчика  контента*/ ?>
							<?php endforeach;?>
						<?php endif;?>
					</div><!-- /.tab-content -->
					<!-- Конец формирования полей ТАБОВ -->

				</div><!-- /.post_text -->
				<!-- Конец вывода полей с группой -->
			</div><!-- /.post_info -->
			<!-- Конец вывода основного содержания статьи (Полей)-->

			<div class="post_tags">
				<?php echo $this->loadTemplate('tags');?>
			</div>

			<!-- Начало вывода рейтинга -->
			<?php if($params->get('tmpl_core.item_rating')):?>
				<div class="post_rating">
					<span>
						<?php echo $item->rating;?>
					</span>
				</div><!-- /.post_rating -->
			<?php endif;?>
			<!-- Конец вывода рейтинга -->

			<?php if($time || $author || $details): ?>
				<div class="post_metainfo">
					<ul>
						<?php if($time): ?>
							<?php if(isset($time['ctime'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/calendar.png" alt="Дата публикации" title="Дата публикации" width="24px" height="24px">
									<span title="Дата публикации">
										<?php echo $time['ctime']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($time['mtime'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/calendar_edit.png" alt="Дата редактирования" title="Дата редактирования" width="24px" height="24px">
									<span id="data_edit" title="Дата редактирования">
										<?php echo $time['mtime']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($time['extime'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/calendar_edit.png" alt="Заканчивается" title="Заканчивается" width="24px" height="24px">
									<span id="data_edit" title="Заканчивается">
										<?php echo $time['extime']; ?>
									</span>
								</li>
							<?php endif; ?>

						<?php endif; ?> <!-- end if $time -->

						<?php if($details): ?>
							<?php if(isset($details['hits'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/eye_24x24.png" alt="Просмотров" title="Просмотров" width="24px" height="24px">
									<span title="Просмотров">
										<?php echo $details['hits']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($details['comments_num'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/comments.png" alt="Комментариев" title="Комментариев" width="24px" height="24px">
									<span title="Комментариев">
										<?php echo $details['comments_num']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($details['favorite_num'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/bookmark_24x24.png" alt="В закладках" title="В закладках" width="24px" height="24px">
									<span title="В закладках">
										<?php echo $details['favorite_num']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($details['vote_num'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/star.png" alt="Оценок" title="Оценок" width="24px" height="24px">
									<span title="Оценок">
										<?php echo $details['vote_num']; ?>
									</span>
								</li>
							<?php endif; ?>

							<?php if(isset($details['follow_num'])): ?>
								<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/sled_24x24.png" alt="Следят" title="Следят" width="24px" height="24px">
									<span title="Следят">
										<?php echo $details['follow_num']; ?>
									</span>
								</li>
							<?php endif; ?>

						<?php endif; ?> <!-- end if $details -->

						<?php if($author): ?>
							<?php if(isset($author['author'])): ?>
								<li>
									<?php if($params->get('tmpl_core.item_author_avatar')):?>
										<img class="img-polaroid" src="<?php echo CCommunityHelper::getAvatar($item->user_id, $params->get('tmpl_core.item_author_avatar_width', 24), $params->get('tmpl_core.item_author_avatar_height', 24));?>" />
										<span id="autor" title="Автор">
											<?php echo $author['author']; ?>
											<?php if(isset($author['author_filter'])): ?>
												<?php echo $author['author_filter']; ?>
											<?php endif; ?>
										</span>
									<?php else:?>
										<img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/autor.png" alt="Автор" title="Автор" width="24px" height="24px">
										<span id="autor" title="Автор">
											<?php echo $author['author']; ?>
											<?php if(isset($author['author_filter'])): ?>
												<?php echo $author['author_filter']; ?>
											<?php endif; ?>
										</span>
									<?php endif;?>
								</li>
							<?php endif; ?>

						<?php endif; ?> <!-- end if $author-->
					</ul>
				</div><!-- /.post_metainfo -->
			<?php endif;?>
		</div><!-- end class="post" -->

