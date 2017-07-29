<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();

if(!class_exists('CarticleHelper'))
{
	class CarticleHelper
	{

		var $k = 0;
		var $countTab =1;
		var $countContentTab = 1;

		public function isnext($obj)
		{
			return (isset($obj->items[$this->k]));
		}
		public function display(&$obj)
		{
			if(empty($obj->items[$this->k]))
			{
				return;
			}
			$params = $obj->tmpl_params['list'];
			$item = $obj->items[$this->k];
			unset($obj->items[$this->k++]);
			?>
			<!-- Начало вывода основного содержания статьи-->
			<div class="post">
				<div class="post_header">
					<?php if($params->get('tmpl_core.item_title')):?>
						<?php if(in_array($params->get('tmpl_core.item_link'), $obj->user->getAuthorisedViewLevels())):?>
							<a <?php echo $item->nofollow ? 'rel="nofollow"' : '';?> href="<?php echo JRoute::_($item->url);?>">
								<h1><?php echo $item->title?></h1>
							</a>
						<?php else :?>
							<h1><?php echo $item->title?></h1>
						<?php endif;?>
					<?php endif;?>
					<?php echo CEventsHelper::showNum('record', $item->id);?>
				</div><!-- /.post_header -->

				<?php
				$category = array();

				if($params->get('tmpl_core.item_categories') && $item->categories_links)
				{
					$category[] = sprintf('%s', implode(', ', $item->categories_links));
				}
				if($params->get('tmpl_core.item_user_categories') && $item->ucatid)
				{
					$category[] = sprintf('%s', $item->ucatname_link);
				}
				?>


				<div class="post_category">
					<span class="category">
						<?php if($category):?>
							<!-- <?php echo JText::_('CCATEGORY');?> -->
							<i class="fa fa-hashtag" aria-hidden="true"></i>
							<?php echo implode(' ', $category);?>
						<?php endif;?>
					</span>
					<div class="btn-group" role="group">
						<?php echo HTMLFormatHelper::bookmark($item, $obj->submission_types[$item->type_id], $params);?>
						<?php echo HTMLFormatHelper::follow($item, $obj->section);?>
						<?php echo HTMLFormatHelper::repost($item, $obj->section);?>
						<?php echo HTMLFormatHelper::compare($item, $obj->submission_types[$item->type_id], $obj->section);?>
						<?php if($item->controls):?>
							<div class="btn-group" role="group" data-toggle="tooltip" data-placement="top" title="Параметры">
								<button button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-cog" aria-hidden="true"></i>
									<span class="caret"></span>
								</button>

								<ul class="dropdown-menu">
									<?php echo list_controls($item->controls);?>
								</ul>
							</div>
						<?php endif;?>
					</div>
				</div><!-- /.post_category -->

				<div class="post_rating">
					<?php if($params->get('tmpl_core.item_rating')):?>
						<div class="content_rating">
							<?php echo $item->rating;?>
						</div>
					<?php endif;?>
				</div>

				<?php //print_r ($item);?>
				
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
							<?php echo '<ul class="nav nav-tabs nav-justified" role="tablist">' ;?>
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
											<?php foreach ($fields as $field_id => $field):?>
												<?php if($field->params->get('core.show_lable') > 1):?>
													<?php echo '<p>' ;?>
													<?php echo $field->label; ?>
													<?php if($field->params->get('core.icon')):?>
														<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
													<?php endif;?>
													<?php echo $field->result; ?>
													<?php echo '</p>' ;?>
												<?php else:?>
													<?php echo '<p>' ;?>
														<?php echo $field->result; ?>
													<?php echo '</p>' ;?>
												<?php endif;?>
											<?php endforeach;?>
											<?php //echo '</ul>' ;?>
										<?php endif;?>
										<?php echo '</div>' ;?>
										<?php $fl_cont = false; ?>
									<?php else:?>
										<?php echo '<div id="tab'.$countContentTab.'" class="tab-pane fade" role="tabpanel">' ;?>
										<?php if(!empty($group_name)):?>
											<?php //echo '<ul>' ;?>
											<?php foreach ($fields as $field_id => $field):?>
												<?php if($field->params->get('core.show_lable') > 1):?>
													<?php echo '<p>' ;?>
													<?php echo $field->label; ?>
													<?php if($field->params->get('core.icon')):?>
														<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
													<?php endif;?>
													<?php echo $field->result; ?>
													<?php echo '</p>' ;?>
												<?php endif;?>
											<?php endforeach;?>
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

					<!-- Вывод кнопки Читать далее -->
					<?php if($params->get('tmpl_core.item_readon')): ?>
						<a href="<?php echo JRoute::_($item->url);?>">
							<button class="seemore btn btn-info">
								<?php echo JText::_('CREADMORE'); ?>
							</button>
						</a>
					<?php endif;?>
					<!-- Конец кнопки Читать далее -->

				</div><!-- /.post_info -->

				<!-- Начало вывода Тэгов -->
				<div class="post_tags">
					
				</div>
				<!-- Конец вывода Тэгов -->

				<!-- Конец вывода основного содержания статьи-->

				<!-- Начало формирования метаинформации о статье-->

				<?php
				$author = array();
				$details = array();
				$time = array();

				if($params->get('tmpl_core.item_author') && $item->user_id)
				{
					$author['author'] = JText::sprintf( 'CWRITTENBY',CCommunityHelper::getName($item->user_id, $obj->section));
				}
				if($params->get('tmpl_core.item_author_filter'))
				{
					$author['author_filter'] = FilterHelper::filterButton('filter_user', $item->user_id, NULL, JText::sprintf('CSHOWALLUSERREC', CCommunityHelper::getName($item->user_id, $obj->section, array('nohtml' => 1))), $obj->section);
				}
				if($params->get('tmpl_core.item_ctime'))
				{
					$time['ctime'] = JText::sprintf(JHtml::_('date', $item->created, $params->get('tmpl_core.item_time_format')));
				}

				if($params->get('tmpl_core.item_mtime'))
				{
					$time['mtime'] = sprintf('%s',JHtml::_('date', $item->modify, $params->get('tmpl_core.item_time_format')));
				}

				if($params->get('tmpl_core.item_extime'))
				{
					$time['extime'] = sprintf('%s', $item->expire ? JHtml::_('date', $item->expire, $params->get('tmpl_core.item_time_format')) : JText::_('CNEVER'));
				}

				if($params->get('tmpl_core.item_type'))
				{
					$details['type'] = sprintf('%s: %s %s', JText::_('CTYPE'), $item->type_name, ($params->get('tmpl_core.item_type_filter') ? FilterHelper::filterButton('filter_type', $item->type_id, NULL, JText::sprintf('CSHOWALLTYPEREC', $item->type_name), $obj->section) : NULL));
				}
				if($params->get('tmpl_core.item_hits'))
				{
					$details['hits'] = sprintf('%s', $item->hits);
				}
				if($params->get('tmpl_core.item_comments_num'))
				{
					$details['comments_num'] = sprintf('%s', CommentHelper::numComments($obj->submission_types[$item->type_id], $item));
				}
				if($params->get('tmpl_core.item_vote_num'))
				{
					$details['vote_num'] = sprintf('%s', $item->votes);
				}
				if($params->get('tmpl_core.item_favorite_num'))
				{
					$details['favorite_num'] = sprintf('%s', $item->favorite_num);
				}
				if($params->get('tmpl_core.item_follow_num'))
				{
					$details['follow_num'] = sprintf('%s', $item->subscriptions_num);
				}
				?>

				<!-- Конец формирования метаинформации о статье-->


				<?php if($author || $details || $time): ?>

					<!-- Начало вывода мета-информации о статье -->

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
									<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/eye.png" alt="Просмотров" title="Просмотров" width="24px" height="24px">
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
				<!-- Конец вывода мета-информации о статье -->

			</div><!-- end class="post" -->

			<?php
		} // end function display
	} // end class CarticleHelper
} //end if
?>

<?php
$k = 0;
$params = $this->tmpl_params['list'];
$leading = $params->get('tmpl_params.leading', 1);
$cols = $params->get('tmpl_params.blog_cols', 2);
$intro = $params->get('tmpl_params.blog_intro', 6);
$links = $params->get('tmpl_params.blog_links', 5);
$l = 0;
JHtml::_('dropdown.init');
$rows = $cols ? ceil($intro / $cols) : 0;
if($rows <= 0) $rows = 0;

$helper = new CarticleHelper();
$helper->k = 0;

$exclude = $params->get('tmpl_params.field_id_exclude');
settype($exclude, 'array');
foreach ($exclude as &$value) {
	$value = $this->fields_keys_by_id[$value];
}
$helper->exclude = $exclude;
?>
<?php if($params->get('tmpl_core.show_title_index')):?>
	<h2><?php echo JText::_('CONTHISPAGE')?></h2>
	<ul>
		<?php foreach ($this->items AS $item):?>
			<li><a href="#record<?php echo $item->id?>"><?php echo $item->title?></a></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>

<style>
	.dl-horizontal dd {
		margin-bottom: 10px;
	}
	.input-field-full {
		margin-left: 0px !important;
	}
</style>


<?php if($leading && $helper->isnext($this)):?>

	<?php for($i = 0; $i < $leading; $i++): ?>

		<?php echo $helper->display($this);?>

	<?php endfor;?>

<?php endif;?>


<?php if($intro && $helper->isnext($this)):?>
	<?php for($r = 0; $r < $rows; $r++):?>

		<?php for($c = 0; $c < $cols; $c++):?>

			<?php echo $helper->display($this);?>

		<?php endfor;?>
	<?php endfor;?>
<?php endif;?>

<?php if($links && $helper->isnext($this)):?>
	<div class="items-more">
		<h3><?php echo JText::_('CMORERECORDS')?></h3>
		<ul class="nav nav-tabs nav-stacked">
			<?php foreach ($this->items AS $item):?>
				<li class="has-context">
					<div class="pull-right controls">
						<div class="btn-group" style="display: none;">
							<?php echo HTMLFormatHelper::bookmark($item, $this->submission_types[$item->type_id], $params);?>
							<?php echo HTMLFormatHelper::follow($item, $this->section);?>
							<?php echo HTMLFormatHelper::repost($item, $this->section);?>
							<?php echo HTMLFormatHelper::compare($item, $this->submission_types[$item->type_id], $this->section);?>
							<?php if($item->controls):?>
								<a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini">
									<?php echo HTMLFormatHelper::icon('gear.png');  ?>
								</a>
								<ul class="dropdown-menu">
									<?php echo list_controls($item->controls);?>
								</ul>
							<?php endif;?>
						</div>
					</div>

					<a <?php echo $item->nofollow ? 'rel="nofollow"' : '';?> href="<?php echo JRoute::_($item->url);?>">
						<?php echo $item->title;?>
						<?php echo CEventsHelper::showNum('record', $item->id);?>
					</a>

				</li>
			<?php endforeach;?>
		</ul>
	</div>
<?php endif;?>
</div><!-- end class="list_posts"> -->
