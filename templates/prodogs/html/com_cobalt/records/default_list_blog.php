<?php
/**
 * Cobalt by MintJoomla
 * a component for Joomla! 1.7 - 2.5 CMS (http://www.joomla.org)
 * Author Website: http://www.mintjoomla.com/
 * @copyright Copyright (C) 2012 MintJoomla (http://www.mintjoomla.com). All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');

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

						<?php //print_r($item->flink);?>
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
									<?php foreach ($item->fields_by_id AS $field):?>
										<p>
										<?php if(in_array($field->key, $this->exclude)) continue; ?>
										<?php if (isset($field->value['image'])) :?>
											<?php continue;?>
										<?php endif;?>
											<?php if($field->params->get('core.show_lable') > 1):?>
													
													<?php echo $field->label; ?>
													<?php if($field->params->get('core.icon')):?>
														<?php echo HTMLFormatHelper::icon($field->params->get('core.icon'));  ?>
													<?php endif;?>
											<?php endif;?>
												<?php echo $field->result; ?>
												</p>
									<?php endforeach;?>
							</div><!-- /.post_text -->
						</div><!-- /.post_info -->
						<?php
					}
				}
			}
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
					<!-- <div class="row-fluid"> -->
					<div class="post">
						<?php for($c = 0; $c < $cols; $c++):?>
							<?php echo $helper->display($this);?>
						<?php endfor;?>
					</div>
					<!-- </div> -->
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


