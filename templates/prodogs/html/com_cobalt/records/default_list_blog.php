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
							<a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini">
								<?php echo HTMLFormatHelper::icon('gear.png');  ?>
							</a>
							<ul class="dropdown-menu">
								<?php echo list_controls($item->controls);?>
							</ul>
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

				<div class="post_info">
					<?php foreach ($item->fields_by_id AS $field):?>
						<?php if (isset($field->value['image'])) :?>
							<div class="post_image">
									<!-- <a href="#" title="Название статьи" alt="Название статьи">
											<img class="img-thumbnail" src="<?php echo $field->value['image'] ?>" alt="" title="">
										</a> -->
										<?php echo $field->result; ?>
									</div>
									<?php break;?>
								<?php endif;?>
							<?php endforeach;?>	

							<div class="post_text">
								<dl class="dl-horizontal text-overflow">
									<?php foreach ($item->fields_by_id AS $field):?>
										<?php if(in_array($field->key, $this->exclude)) continue; ?>
										<?php if (isset($field->value['image'])) :?>
											<?php continue;?>
										<?php endif;?>
										<?php if($field->params->get('core.show_lable') > 1):?>
											<dt id="<?php echo $field->id;?>-lbl" for="field_<?php echo $field->id;?>" class="<?php echo $field->class;?>" >
												<?php echo $field->label; ?>
												<?php if($field->params->get('core.icon')):?>
													<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
												<?php endif;?>
											</dt>
										<?php endif;?>
										<dd class="input-field<?php echo ($field->params->get('core.label_break') > 1 ? '-full' : NULL)?> <?php echo $field->fieldclass;?>">
											<?php echo $field->result; ?>
										</dd>
									<?php endforeach;?>
								</dl>
							</div><!-- /.post_text -->

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
							$author['author'] = JText::sprintf('CWRITTENBY', CCommunityHelper::getName($item->user_id, $obj->section));
						}
						if($params->get('tmpl_core.item_author_filter'))
						{
							$author['author_filter'] = FilterHelper::filterButton('filter_user', $item->user_id, NULL, JText::sprintf('CSHOWALLUSERREC', CCommunityHelper::getName($item->user_id, $obj->section, array('nohtml' => 1))), $obj->section);
						}
						if($params->get('tmpl_core.item_ctime'))
						{
							$time['ctime'] = JText::sprintf('CONDATE', JHtml::_('date', $item->created, $params->get('tmpl_core.item_time_format')));
						}

						if($params->get('tmpl_core.item_mtime'))
						{
							$time['mtime'] = sprintf('%s: %s', JText::_('CCHANGEON'), JHtml::_('date', $item->modify, $params->get('tmpl_core.item_time_format')));
						}

						if($params->get('tmpl_core.item_extime'))
						{
							$time['extime'] = sprintf('%s: %s', JText::_('CEXPIREON'), $item->expire ? JHtml::_('date', $item->expire, $params->get('tmpl_core.item_time_format')) : JText::_('CNEVER'));
						}

						if($params->get('tmpl_core.item_type'))
						{
							$details['type'] = sprintf('%s: %s %s', JText::_('CTYPE'), $item->type_name, ($params->get('tmpl_core.item_type_filter') ? FilterHelper::filterButton('filter_type', $item->type_id, NULL, JText::sprintf('CSHOWALLTYPEREC', $item->type_name), $obj->section) : NULL));
						}
						if($params->get('tmpl_core.item_hits'))
						{
							$details['hits'] = sprintf('%s: %s', JText::_('CHITS'), $item->hits);
						}
						if($params->get('tmpl_core.item_comments_num'))
						{
							$details['comments_num'] = sprintf('%s: %s', JText::_('CCOMMENTS'), CommentHelper::numComments($obj->submission_types[$item->type_id], $item));
						}
						if($params->get('tmpl_core.item_vote_num'))
						{
							$details['vote_num'] = sprintf('%s: %s', JText::_('CVOTES'), $item->votes);
						}
						if($params->get('tmpl_core.item_favorite_num'))
						{
							$details['favorite_num'] = sprintf('%s: %s', JText::_('CFAVORITED'), $item->favorite_num);
						}
						if($params->get('tmpl_core.item_follow_num'))
						{
							$details['follow_num'] = sprintf('%s: %s', JText::_('CFOLLOWERS'), $item->subscriptions_num);
						}
						?>

						<!-- Конец формирования метаинформации о статье-->


						<!-- Начало вывода Метаинформации о статье -->
						<div class="post_metainfo">
							<ul>
								
							</ul>
						</div>
						<!-- Конец вывода Метаинформации о статье -->

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
											<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/favorite.png" alt="В избранном" title="В избранном" width="24px" height="24px">
												<span title="В избранном">
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
											<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/star.png" alt="Оценок" title="Оценок" width="24px" height="24px">
												<span title="Оценок">
													<?php echo $details['follow_num']; ?>
												</span>
											</li>
										<?php endif; ?>

									<?php endif; ?> <!-- end if $details -->

									<?php if($author): ?>
										<?php if(isset($author['author'])): ?>
											<li><img src="<?php echo JUri::base().'templates/';?>prodogs/images/content/article/icons_metainfo/autor.png" alt="Автор" title="Автор" width="24px" height="24px">
												<span id="autor" title="Автор">
													<?php echo $author['author']; ?>
														<?php if(isset($author['author_filter'])): ?>
															<?php echo $author['author_filter']; ?>
														<?php endif; ?>
												</span>
											</li>
										<?php endif; ?>

									<?php endif; ?> <!-- end if $author-->

									<?php if($params->get('tmpl_core.item_author_avatar')):?>
										<div class="pull-right">
											<img class="img-polaroid" src="<?php echo CCommunityHelper::getAvatar($item->user_id, $params->get('tmpl_core.item_author_avatar_width', 40), $params->get('tmpl_core.item_author_avatar_height', 40));?>" />
										</div>
									<?php endif;?>

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
	<div class="items-leading">
		<?php for($i = 0; $i < $leading; $i++): ?>
			<div class="leading-<?php echo $i;?>">
				<?php echo $helper->display($this);?>
			</div>
		<?php endfor;?>
	</div>
<?php endif;?>
<div class="clearfix"></div>

<?php if($intro && $helper->isnext($this)):?>
	<?php for($r = 0; $r < $rows; $r++):?>
		<div class="row-fluid">
			<?php for($c = 0; $c < $cols; $c++):?>
				<div class="span<?php echo round((12 / $cols));?>">
					<?php echo $helper->display($this);?>
				</div>
			<?php endfor;?>
		</div>
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

