<?php defined("_JEXEC") or die();?>
<?php
$templateparams = JFactory::getApplication()->getTemplate(true)->params;
$site_logo = $templateparams->get('site_logo');
$site_name = $templateparams->get('site_name');
$site_desc = $templateparams->get('site_desc');
//print_r($templateparams);

$doc = JFactory::getDocument();

$menu = JFactory::getApplication()->getMenu();

$activePage = $menu->getActive()->id;
$defaultPage = $menu->getDefault()->id;

$user = JFactory::getUser();

if ($user->guest)
{
	$showGuest=true;
}
else
{
	$showGuest=false;
}

//Подключение стилей (stylesheets)
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/favicon.png');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/bootstrap.min.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/libs/fancybox/jquery.fancybox.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/libs/owl-carousel2/assets/owl.carousel.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/libs/owl-carousel2/assets/owl.theme.default.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/libs/countdown/jquery.countdown.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/fonts.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/font-awesome.min.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/custom.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/main.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/media.css');
$doc->addStyleSheet(JUri::base().'templates/'.$doc->template.'/css/animate.min.css');

//Подключение скриптов (scripts)
//$doc->addScript(JUri::base().'templates/'.$doc->template.'/libs/jquery/jquery-1.11.1.min.js');

//Проверяем выводиться ли какие либо модули
if ($doc->countModules('position-3'))
{
	$showSubscribe = TRUE;
}
if ($doc->countModules('position-4'))
{
	$showMainMenu = TRUE;
}
if ($doc->countModules('position-5'))
{
	$showSlider = TRUE;
}
if ($doc->countModules('position-6'))
{
	$showTopSliderBanners = TRUE;
}
if ($doc->countModules('position-7'))
{
	$showNavigator = TRUE;
}
if ($doc->countModules('position-8'))
{
	$showSidebar = TRUE;
}
if ($doc->countModules('position-9'))
{
	$showUpBlockAds = TRUE;
}
if ($doc->countModules('position-10'))
{
	$showDownBlockAds = TRUE;
}

if ($doc->countModules('position-12'))
{
	$showBottomSliderBanners = TRUE;
}
if ($doc->countModules('position-14 or position-15 or position-16'))
{
	$showFooterModules = TRUE;
}
if ($doc->countModules('position-17'))
{
	$showFooterBottomLine = TRUE;
}



// Отключение стандартных скриптов Joomla (Конфликтуют с подключаемыми скриптами шаблона)
//JHtml::_('jquery.framework');
//unset($doc->_scripts[JURI::root(true). '/media/jui/js/jquery.min.js']);
//unset($doc->_scripts[JURI::root(true). '/media/system/js/core.js']);
//unset($doc->_scripts[JURI::root(true). '/media/jui/js/jquery-migrate.min.js']);
//unset($doc->_scripts[JURI::root(true). '/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[JURI::root(true). '/media/jui/js/bootstrap.min.js']);
//unset($doc->_scripts[JURI::root(true). '/media/system/js/mootools-core.js']);
//unset($doc->_scripts[JURI::root(true). '/media/system/js/modal.js']);
unset($doc->_scripts[JURI::root(true). '/media/system/js/mootools-more.js']);
//unset($doc->_scripts[JURI::root(true). '/components/com_cobalt/library/tws/js/owl.carousel.min.js']);

//print_r($doc->params);
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>
<body>
	<header class="top_header">
		<nav id="header_topline" class="navbar navbar-fixed-top">
			<div class="container">
				<div class="row">
					<div class="top_main_menu">
						<div class="form_search">
							<form class="form-inline ">
								<div class="form-group">
									<label class="sr-only" for="InputFind">Поиск</label>
									<div class="input-group">
										<input type="text" class="form-control" id="InputFind" placeholder="Что ищем?">
										<div class="input-group-addon btn btn-info" type="submit">Найти</div>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-info">
								<div class="panel-heading" >
									<h4 class="panel-title">
										<a href="#">
											Главная
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="collapsed"  data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false">
											Новости
										</a>
									</h4>
								</div>
								<div id="collapse2" class="panel-collapse collapse">
									<div class="panel-body">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
									</div>
								</div>
							</div>
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false">
											Объявления
											<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
										</a>
									</h4>
								</div>
								<div id="collapse3" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Продать/Купить Хаски</a></li>
											<li><a href="#">Дрессировка собак</a></li>
											<li><a href="#">Знакомства для вязки</a></li>
											<li><a href="#">Медицина и ветеринария</a></li>
											<li><a href="#">Гроуминг и стрижки</a></li>
											<li><a href="#">Розыск собаки</a></li>
											<li><a href="#">Ищу хозяина</a></li>
											<li><a href="#">Прочее</a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false">
											Полезное
											<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
										</a>
									</h4>
								</div>
								<div id="collapse4" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Продать/Купить Хаски</a></li>
											<li><a href="#">Дрессировка собак</a></li>
											<li><a href="#">Знакомства для вязки</a></li>
											<li><a href="#">Медицина и ветеринария</a></li>
											<li><a href="#">Гроуминг и стрижки</a></li>
											<li><a href="#">Розыск собаки</a></li>
											<li><a href="#">Ищу хозяина</a></li>
											<li><a href="#">Прочее</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.top_main_menu -->
					<div class="col-md-6 col-sm-6 col-xs-3">
						<div class="top_brand">
							<button class="menu_button hidden-sm hidden-md hidden-lg">
								<span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
							</button>
							<a href="/">
								<h1 class="hidden-xs wow fadeInDown"><?php echo $site_name ?  $site_name : 'ProDogs.Info'?></h1>
							</a>
						</div>

						<!-- <div class="top_search">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							<div class="form_find">
								<form class="form-inline">
									<div class="form-group">
										<label class="sr-only" for="InputSearch">Поиск</label>
										<div class="input-group">
											<input type="text" class="form-control" id="InputSearch" placeholder="Что ищем?" size="150" width="250px">
											<div class="input-group-addon btn btn-info" type="submit">Найти</div>
										</div>
									</div>
								</form>
							</div>
						</div> -->
						<!-- /.top_search -->
						<jdoc:include type="modules" name="position-0"/>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-9">
						<div class="top_links">
							<button class="auth_button  hidden-md hidden-lg">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
							</button>
							<?php if ($showGuest):?>
								<div class="top_login">
									<a href="#login" class="fancybox"><i class="fa fa-key" aria-hidden="true"></i>Вход</a>
									<a href="/component/users/?view=registration"><i class="fa fa-user" aria-hidden="true"></i>Регистрация</a>
								</div>
							<?php else:?>
								<div class="top_user">
									<jdoc:include type="modules" name="position-1"/>
								</div>
							<?php endif;?>
						</div><!-- /.top_links -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-4">
					<div class="logo_img wow bounceInDown" data-wow-delay="0.5s">
						<?php if($site_logo) :?>
							<a href="<?php echo JUri::base();?>">
								<img src="<?php echo $site_logo ?>" alt="<?php echo $site_desc ?  $site_desc : 'Сообщество любителей собак. Всё о собаках.' ?>">
							</a>
						<?php else:?>
							<a href="<?php echo JUri::base();?>">
								<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/logo.png" alt="<?php echo $site_desc ?  $site_desc : 'Сообщество любителей собак. Всё о собаках.' ?>">
							</a>
						<?php endif;?>
					</div>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-8">
					<div class="logo_text">
						<div class="logo_title visible-xs-block">
							<a href="/"><h1><?php echo $site_name ?  $site_name : 'ProDogs.Info'?></h1></a>
						</div>
						<div class="greeting wow flipInX">
							<h3><?php echo $site_desc ?  $site_desc : 'Сообщество любителей собак. Всё о собаках.' ?></h3> 
						</div>
					</div><!-- /.logo_text -->
				</div>
				<?php if($showSubscribe):?>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="main_subscribe wow slideInDown">
							<jdoc:include type="modules" name="position-3" style="default"/>
						</div><!-- /.main_subscribe -->
					</div><!-- /.col-md-4 col-sm-4 col-xs-12 -->
				<?php endif;?>
				<!-- <div class="col-md-4 col-sm-4 col-xs-12">
					<div class="main_subscribe wow slideInDown">
						<h2>Подписка на новости</h2>
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Имя</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputName" placeholder="Ваше Имя">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">E-mail</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="inputPassword3" placeholder="Ваш e-mail">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-info">Получать новости</button>
								</div>
							</div>
						</form>
					</div><!-- /.main_subscribe -->
					<!-- </div> --> 
				</div><!-- /.row -->
				<?php if($showMainMenu):?>
					<div class="row">
						<jdoc:include type="modules" name="position-4" style="default"/>
					</div><!-- /.row -->
				<?php endif;?>
			</div><!-- /.container -->
		</header>
		<section class="content">
			<div class="container">

				<?php if($showSlider):?>
					<jdoc:include type="modules" name="position-5"/>
				<?php endif;?>

				<?php if($showTopSliderBanners):?>
					<div class="row">
						<jdoc:include type="modules" name="position-6"/>
					</div><!-- end /.row -->
				<?php endif;?>

				<?php if($activePage != $defaultPage) :?>
					<div class="row mod_content">

						<?php if($showNavigator):?>
							<nav class="path_links">
								<jdoc:include type="modules" name="position-7"/>
							</nav>
						<?php endif;?>

						<?php if($showSidebar):?>
							<div class="col-md-9 col-md-push-3">
							<?php else:?>
								<div class="col-md-12">
								<?php endif;?>

								<?php if($showUpBlockAds):?>
									<div class="block_ads">
										<jdoc:include type="modules" name="position-9" />
									</div>
								<?php endif;?>

								<jdoc:include type="message" />
								<jdoc:include type="component" />
								<?php if($showDownBlockAds):?>
									<div class="block_ads">
										<jdoc:include type="modules" name="position-10" />
									</div>
								<?php endif;?>
							</div>


							<?php if($showSidebar):?>
								<div class="col-md-3 col-md-pull-9">
									<div class="block_sidebar">
										<?php if ($doc->countModules('position-8') >=2) :?>
											<div class="row">
												<jdoc:include type="modules" name="position-8" style="sidebarmenu" />
											</div>
											<div class="clearfix"></div>
										<?php else :?>
											<div class="row">
												<jdoc:include type="modules" name="position-8" style="sidebarmenu" />
											</div>
										<?php endif;?>
									</div><!-- /.block_sidebar -->
								</div>
							<?php endif;?>


							<div class="clearfix"></div>

							<?php if($showNavigator):?>
								<nav class="path_links">
									<jdoc:include type="modules" name="position-7"/>
								</nav>
							<?php endif;?>

						</div><!-- /.row mod_content -->
					<?php else :?>
						<div class="row">
							<div class="modules">
								<jdoc:include type="message" />
								<div class="dogs-row">
									<h2>Объявления о продаже щенков</h2>
									<div class="post-row">
										<div class="col-sm-4 col-xs-6">
											<div class="post_widget">
												<div class="price">$70000</div>
												<div class="vip">
													VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/haski.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Ирландский мягкошёрстный пшеничный терьер</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia natus molestias eaque saepe doloremque qui minima iure modi quas, facilis dicta consectetur fugit corporis facere repellat beatae laborum. Ex, error.
															</a>
														</div>
													</div><!-- /.post_content -->
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
											<div class="col-sm-4 col-xs-6">
												<div class="post_widget">
													<div class="price">$700</div>
													<div class="vip">VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/laika2.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Дальневосточная лайка</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
															</a>
														</div>
													</div>
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
											<div class="col-sm-4 col-xs-6">
												<div class="post_widget">
													<div class="price">$400</div>
													<div class="vip">VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/ovcharka2.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Немецкая овчарка</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
															</a>
														</div>
													</div>
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
											<div class="col-sm-4 col-xs-6">
												<div class="post_widget">
													<div class="price">$500</div>
													<div class="vip">VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/rotveiler.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Ротвейлер</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
															</a>
														</div>
													</div>
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
											<div class="col-sm-4 col-xs-6">
												<div class="post_widget">
													<div class="price">$500</div>
													<div class="vip">VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/rotveiler2.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Ротвейлер</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
															</a>
														</div>
													</div>
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
											<div class="col-sm-4 col-xs-6">
												<div class="post_widget">
													<div class="price">$500</div>
													<div class="vip">VIP</div>
													<div class="post_img">
														<a href="#">
															<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/ads/haski2.jpg" alt="заголовок статьи" title="Подробнее">
														</a>
													</div><!-- end /.post_img -->
													<div class="post_content">
														<div class="header">
															<a href="#">
																<div class="breed">Сибирский Хаски</div>
															</a>
														</div><!-- end /.header -->
														<div class="geo">
															<a href="#">
																Минск, Минская область, Беларусь
															</a>
														</div><!-- /.geo -->
														<div class="cont">
															<a href="#">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sapiente quo praesentium aliquam fuga illo iste ratione! Molestias animi aspernatur, neque accusamus, reprehenderit laudantium saepe ex aut distinctio vitae aliquid.
															</a>
														</div>
													</div>
												</div><!-- end /.post_widget -->
											</div><!-- /.col-sm-4 col-xs-4 -->
										</div><!-- end /.post-row -->
										<div class="all_dogs">
											<a class="btn btn-info" href="#" role="button">Смотреть все объявления о продаже щенков...
											</a>
										</div>										
									</div><!-- end /.dogs-row -->
									<ul class="nav nav-tabs nav-justified wow zoomIn" role="tablist" id="ArticleTab">
										<li class="active"><a href="#post_news" role="tab" data-toggle="tab">Новое</a></li>
										<li><a href="#famous" role="tab" data-toggle="tab">Популярное</a></li>
										<li><a href="#comments" role="tab" data-toggle="tab">Комментируемое</a></li>
										<li><a href="#rating" role="tab" data-toggle="tab">Рейтинговое</a></li>
									</ul>
									<div class="tab-content wow zoomIn">
										<div class="tab-pane active" id="post_news">
											<div class="news-row">
												<h2>Новости</h2>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="article_main_widget">
														<div>
															<div class="article_main_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.article_main_img -->
															<div class="article_main_content">
																<div class="article_main_header">
																	<div class="data">
																		<span class="day">27</span>
																		<span class="month">Сентября</span>
																		<span class="year">2017</span>
																	</div>
																	<h3>
																		<a href="#">
																			Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																		</a>
																	</h3>
																</div><!-- end /.article_main_header -->
																<div class="article_main_post">
																	<a href="#">
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione pariatur nihil, voluptatum magni voluptatem voluptate atque nobis tenetur omnis eos quisquam quis nulla animi quia sunt neque, accusamus rem officia.
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
																		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
																	</a>
																</div>
															</div><!-- end /.article_main_content -->
														</div>
													</div><!-- end /.article_main_widget -->
												</div>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="article_widget">
														<div class="article_img">
															<a href="#">
																<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
															</a>
														</div><!-- end /.article_img -->
														<div class="article_header">
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
															<div class="article_data">
																25 сентября 2017
															</div>
														</div><!-- end /.article_header -->
														<div class="article_post">
															<a href="#" alt="">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione pariatur nihil, voluptatum magni voluptatem voluptate atque nobis tenetur omnis eos quisquam quis nulla animi quia sunt neque, accusamus rem officia.
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
															</a>
														</div>
													</div><!-- end /.article_widget -->
													<div class="article_widget">
														<div class="article_img">
															<a href="#">
																<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="заголовок статьи" title="Подробнее">
															</a>
														</div><!-- end /.article_img -->
														<div class="article_header">
															<h3>
																<a href="#">
																	Заголовок статьи.
																</a>
															</h3>
															<div class="article_data">
																25 сентября 2017
															</div>
														</div><!-- end /.article_header -->
														<div class="article_post">
															<a href="#" alt="">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione pariatur nihil, voluptatum magni voluptatem voluptate atque nobis tenetur omnis eos quisquam quis nulla animi quia sunt neque, accusamus rem officia.
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
															</a>
														</div>
													</div><!-- end /.article_widget -->
													<div class="article_widget">
														<div class="article_img">
															<a href="#">
																<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
															</a>
														</div><!-- end /.article_img -->
														<div class="article_header">
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
															<div class="article_data">
																25 сентября 2017
															</div>
														</div><!-- end /.article_header -->
														<div class="article_post">
															<a href="#" alt="">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione pariatur nihil, voluptatum magni voluptatem voluptate atque nobis tenetur omnis eos quisquam quis nulla animi quia sunt neque, accusamus rem officia.
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci natus commodi voluptates numquam ex debitis quo iste laboriosam rerum iusto provident in earum aut quibusdam, officia at eos nemo recusandae!
															</a>
														</div>
													</div><!-- end /.article_widget -->

												</div>
												<div class="col-sm-12 col-xs-12">
													<div class="all_news">
														<a class="btn btn-info" href="#" role="button">
															Смотреть все новости...
														</a>
													</div><!-- end/.all_news -->
												</div>
											</div><!-- end /.news-row -->


										</div><!-- конец вкладки Новое -->
										<div class="tab-pane" id="famous">
											<div class="post-row">
												<!-- <h2>Популярное</h2> -->
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>		
											</div><!-- end /.post-row -->
										</div><!-- Конец вкладки Популярное -->
										<div class="tab-pane" id="comments">
											<div class="post-row">
												<!-- <h2>Комментируемое</h2> -->
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>		
											</div><!-- end /.post-row -->
										</div><!-- Конец вкладки Комментируемое -->
										<div class="tab-pane" id="rating">
											<div class="post-row">
												<!-- <h2>Новые Объявления</h2> -->
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>		
											</div><!-- end /.post-row -->
										</div><!-- Конец вкладки Объявления -->
									</div><!-- Конец /.tab-content ArticleTab -->

									<ul class="nav nav-tabs nav-justified wow zoomIn" role="tablist" id="Wanted">
										<li class="active">
											<a href="#wanted_pets" role="tab" data-toggle="tab">Розыск собаки</a>
										</li>
										<li>
											<a href="#wanted_person" role="tab" data-toggle="tab">Ищу хозяина</a>
										</li>
									</ul>
									<div class="tab-content wow pulse" data-wow-iteration="1" id="content_wanted">
										<div class="tab-pane active" id="wanted_pets">
											<!-- Начало слайдера поиска собаки -->
											<div id="carousel-wanted_pets" class="carousel slide" data-ride="carousel" data-interval="false">
												<!-- Wrapper for slides -->
												<div class="carousel-inner" role="listbox">
													<div class="item active">
														<a href="#" id="link_img"><img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt=""></a>
														<div class="carousel-caption">
															<h3>Внимание розыск!</h3>
															<div class="caption-content">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>

															</div>
															<a class="btn btn-info" href="#">Подробнее...</a>
															<div class="contact-info">
																<div class="phone">
																	<span class="glyphicon glyphicon-phone"></span>+375 (29) 608-89-63
																</div>
																<div class="skype">
																	<i class="fa fa-skype fa-lg" aria-hidden="true"></i>zatulenko`2324124

																</div>
																<div class="mail">
																	<span class="glyphicon glyphicon-envelope"></span><a href="">vash_adres565675@mail.ru</a> 
																</div>
															</div>
														</div><!-- /.carousel-caption -->
													</div><!--/.item -->
													<div class="item">
														<a href="#"><img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt=""></a>
														<div class="carousel-caption">
															<h3>Внимание розыск!</h3>
															<div class="caption-content">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
															</div>
															<a class="btn btn-info" href="#">Подробнее...</a>
															<div class="contact-info">
																<div class="phone">
																	<span class="glyphicon glyphicon-phone"></span>+375 (29) 608-89-63
																</div>
																<div class="skype">
																	<i class="fa fa-skype fa-lg" aria-hidden="true"></i>zatulenko

																</div>
																<div class="mail">
																	<span class="glyphicon glyphicon-envelope"></span><a href="mailto:vash_adres@mail.ru"">vash_adres@mail.ru</a> 
																</div>
															</div>
														</div><!-- /.carousel-caption -->
													</div><!--/.item -->
													<div class="item">
														<a href="#"><img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt=""></a>
														<div class="carousel-caption">
															<h3>Внимание розыск!</h3>
															<div class="caption-content">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum error enim, ducimus commodi explicabo optio, consequatur reprehenderit deleniti iste officia, quo quod distinctio rerum! Non quibusdam voluptas, quidem unde dicta.</p>
															</div>
															<a class="btn btn-info" href="#">Подробнее...</a>
															<div class="contact-info">
																<div class="phone">
																	<span class="glyphicon glyphicon-phone"></span>+375 (29) 608-89-63
																</div>
																<div class="skype">
																	<i class="fa fa-skype fa-lg" aria-hidden="true"></i>zatulenko

																</div>
																<div class="mail">
																	<span class="glyphicon glyphicon-envelope"></span><a href="mailto:vash_adres@mail.ru"">vash_adres@mail.ru</a> 
																</div>
															</div>
														</div><!-- /.carousel-caption -->
													</div><!--/.item -->
												</div><!-- /.carousel-inner -->

												<!-- Controls -->
												<a class="left carousel-control" href="#carousel-wanted_pets" role="button" data-slide="prev">
													<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
													<span class="sr-only">Предыдущий</span>
												</a>
												<a class="right carousel-control" href="#carousel-wanted_pets" role="button" data-slide="next">
													<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
													<span class="sr-only">Следующий</span>
												</a>

												<!-- Indicators -->
												<ul class="carousel-indicators">
													<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="" data-target="#carousel-wanted_pets" data-slide-to="0" class="active">

													<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="" data-target="#carousel-wanted_pets" data-slide-to="1">

													<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="" data-target="#carousel-wanted_pets" data-slide-to="2">
												</ul>				
											</div>
											<!-- Конец слайдера поиска собаки -->
											<div class="all_wanted_pets">
												<a href="#" class="btn btn-danger">Смотреть все объявления о розыске собак...</a>
											</div>
										</div><!-- /#wanted_pets -->
										<div class="tab-pane" id="wanted_person">
											<div class="post-row">
												<!-- <h2>Новоcти</h2> -->
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_2.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_3.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи.
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="col-sm-3 col-xs-6">
													<div class="post_widget">
														<div>
															<div class="post_img">
																<a href="#">
																	<img src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/images/slider/slide_1.jpg" alt="заголовок статьи" title="Подробнее">
																</a>
															</div><!-- end /.post_img -->
															<h3>
																<a href="#">
																	Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи. Очень длинный при длинный заголовок статьи
																</a>
															</h3>
														</div>
													</div><!-- end /.post_widget -->
												</div>
												<div class="butt_wanted">
													<button class="btn btn-info">
														Подать объявление
													</button>
													<button class="btn btn-success">
														Смотреть все...
													</button>
												</div>		
											</div><!-- end /.post-row -->
										</div><!-- /#wanted_person -->
									</div><!-- Конец /.tab-content Wanted -->


								</div><!-- /.modules -->
							</div><!-- /.row -->
						<?php endif;?>


						<?php if($showBottomSliderBanners):?>
							<div class="row">
								<jdoc:include type="modules" name="position-12"/>
							</div><!-- end /.row -->
						<?php endif;?>


						<!-- /.conteiner -->
					</div>
				</section>
				<footer class="wow pulse">
					<div class="main_footer">
						<div class="footer_subscribe">
							<div class="container">
								<div class="row">
									<form class="form-inline">
										<div class="form-group">
											<label for="Name">Имя:</label>
											<input type="text" class="form-control" id="Name" placeholder="Введите ваше Имя">
										</div>
										<div class="form-group">
											<label for="Email">Email:</label>
											<input type="email" class="form-control" id="Email" placeholder="Введите ваш Email">
										</div>
										<button type="submit" class="btn btn-info">Получать новости</button>
									</form>
								</div>
							</div>
						</div>
						<?php if($showFooterModules):?>
							<div class="footer_topline">
								<div class="container">
									<div class="row">
										<jdoc:include type="modules" name="position-14" style="footer_left_block"/>
										<jdoc:include type="modules" name="position-15" style="footer_center_block"/>
										<jdoc:include type="modules" name="position-16" style="footer_right_block"/>
									</div><!-- /.row -->
								</div><!-- /.container -->
							</div><!-- /.footer_topline -->
						<?php endif;?>
					</div>
					<?php if($showFooterBottomLine):?>
						<jdoc:include type="modules" name="position-17" style="footer_bottomline"/>
					<?php endif;?>
				</footer>
				<button id="top" class="up" data-spy="affix" data-offset-top="50" title="Наверх"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i>
				</button>
				<div class="hidden">
					<div id="login">
						<jdoc:include type="modules" name="position-1"/>
					</div>

				<!-- <form action="" id="login" class="login_form">
					<h3>Вход на сайт</h3>
					<div class="form-group has-success has-feedback">
						<label for="inputEmail" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="inputEmail" placeholder="Введите Ваш Email" required>
						</div>
					</div>
					<div class="form-group has-success has-feedback">
						<label for="inputPassword" class="col-sm-3 control-label">Пароль</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword" placeholder="Введите Ваш Пароль" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Запомнить меня
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Войти</button>
						</div>
					</div>
				</form> -->

<!-- 				<form id="register" class="form-horizontal" role="form">
					<div class="form-group has-success has-feedback">
						<label class="control-label col-sm-3" for="inputSuccess3">Input with success</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="inputSuccess3">
							<span class="glyphicon glyphicon-ok form-control-feedback"></span>
						</div>
					</div>
				</form> -->
			</div>
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->

	<!-- Подключение скриптов (Scripts) -->
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/scrollto/jquery.scrollTo.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/owl-carousel2/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/countdown/jquery.countdown-ru.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/libs/landing-nav/navigation.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/js/wow.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::base();?>templates/<?php echo $doc->template; ?>/js/common.js"></script>

	
	<!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
	<!-- Google Analytics counter --><!-- /Google Analytics counter -->
</body>
</html>