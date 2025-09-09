<?php
	session_start();
	
	include 'config.php';
	
	// Подключение к БД
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
	
	// Делаем правильную кодировку
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
	mysqli_query($connection, "SET CHARACTER SET 'utf8'");
	
	/* Получаем название статьи */
	$article_title = $_GET['article_title'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $article_title; ?>" />
		<meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2025, году" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="Рыболовные базы в Астраханской области цены в 2025 году" />
		<meta property="og:title" content="<?php echo $article_title; ?>" />
		<meta property="og:description" content="<?php echo $article_title; ?>" />
		<!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
		
		<!-- Yandex.Webmaster -->
		<meta name="yandex-verification" content="70fe58b7e11a9545" />
			
		<!-- Bootstrap CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">

		<!-- Style CSS -->
		<link href="/css/theme.css" rel="stylesheet">

		<!--link rel="shortcut icon" type="image/x-icon" href="favicon.ico"-->	
		<link rel="shortcut icon" type="image/x-icon" href="/img/logo-ico.svg">	

		<title><?php echo $article_title; ?></title>
	</head>
	<body>
		
		
		<!-- Menu header -->
		<nav id="top-menu-2" class="navbar navbar-expand-xl navbar-light bg-white shadow pb-2 pb-md-1">
			<div class="container">
				<a class="navbar-brand me-4 mb-1 desktop-brand" href="/">
					<img src="/img/logo-dark.svg">
				</a>
				<a class="navbar-brand  d-xl-none d-md-none mobile-brand" href="/">
					<img src="/img/mobile-logo-dark.svg">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="main-menu">			
					<ul id="menu-main-menu" class="navbar-nav">
						<li class="menu-item nav-item">
							<a href="/" class="nav-link">Рыболовные базы</a>
						</li>
						<li class="nav-item d-none d-xl-inline">
							<span class="nav-link px-2">
								<img src="img/ico/menu-point.svg" class="pb-2">
							</span>
						</li>
						<li class="menu-item nav-item">
							<a href="/map.php" class="nav-link">Базы на карте</a>
						</li>
						<li class="nav-item d-none d-xl-inline">
							<span class="nav-link px-2">
								<img src="/img/ico/menu-point.svg" class="pb-2">
							</span>
						</li>
						<li class="menu-item nav-item">
							<a href="/archive-articles.php" class="nav-link active">Рыбалка в астрахани</a>
						</li>

						<!-- Mobile menu -->
						<li class="nav-item d-xl-none">
							<!-- <a class="nav-link top-menu-tel pt-1 pb-2" href="tel:89307878068">8 (930) 78-78-0-68</a>
							<div style="font-size: 12px; font-family: HelveticaNeueCyr-Light; text-transform: none;">
								<img src="./img/location-ico.svg" style="width: 10px;" class="me-1">
									<span>Москва</span>
							</div> -->
							<!--div style="font-size: 12px; font-family: HelveticaNeueCyr-Light; text-transform: none;">
								<img src="img/ico/clock-ico.svg" style="width: 10px; position: relative; top: -1px;" class="me-1">Ежедневно с 9:00 до 21:00
							</div-->
						</li>
						<li class="nav-item d-xl-none pt-3">
							<a class="ico-button pe-2" href="#"><img src="img/ico/vk-ico.svg"></a>
						</li>
						<!-- End mobile menu -->
						<div class="row mobile-header-items">
							<div class="col">
								<a href="#" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="menu-item nav-link pt-2">Добавить&nbsp;базу</a>
							</div>
							<div class="col">
								<a href="/adm" class="btn btn-outline-success" type="button">Войти</a>
							</div>	
						</div>
					</ul>
				</div>		
				<div class="row desctop-header-items">
					<div class="col">
						<a href="#" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="menu-item nav-link pt-2">Добавить&nbsp;базу</a>
					</div>
					<div class="col">
						<a href="/adm" class="btn btn-outline-success" type="button">Войти</a>
					</div>	
				</div>				
			</div>
		</nav>
		<!-- /Menu header -->

		
		<!-- Home -->
		<div id="home-sp" class="scroll-point"></div>
		<header class="home-header">
			<div class="container">
				<div class="row">
					<div class="col">
						<h1 class="home-title "><?php echo $article_title; ?></h1>
						<h2 class="home-subtitle  me-md-5">Куда поехать, лучшие места для рыбалки, стоимость проживания</h2>
						<h3 class="home-description">Мы собрали для Вас полезную информацию о рыбалке и отдыхе в Астраханской области</h3>
					</div>
				</div>
			</div>
		</header>
		<!-- /Home -->
		
		
		<!-- single-article -->
		<div id="single-article-sp" class="scroll-point"></div>
		<section class="single-article bg-white py-5">
			<div class="container">
				<div class="row">
					<div class="col">
						<?php
							// Получаем и выводим контент статьи
							$result = mysqli_query($connection, "SELECT * FROM `articles` WHERE `article_title` = '$article_title'");
							$record = mysqli_fetch_assoc( $result );
							echo $record[ 'article_content' ];
						?>
						<button class="btn btn-danger single_btn" type="button" onclick="window.history.go(-1); return false;">
							Назад
						</button>
					</div>
				</div>
			</div>
		</section>

		
		<!-- Archive-article section --
		<div id="archive-article-sp" class="scroll-point"></div>
		<section class="archive-article bg-arhive py-5">
			<div class="container">
				<div class="row">
					<div class="archive-article-block">
						<h3 class="article-block-title mb-3">
							Другие статьи о рыбалке в Астрахани
						</h3>
						<div class="article-block-decorate">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4 article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
						<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="col-md-4  article-card">
						<a href="#">
							<!--div class="approximation project-container-2 rounded"--
							<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							<!--/div--
						</a>
						<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
					</div>
					<div class="row hide-cards hidden">
						<div class="col-md-4  article-card">
							<a href="#">
								<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
							</a>
							<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
						</div>
						<div class="col-md-4 article-card">
							<a href="#">
								<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">													
							</a>
							<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
						</div>
						<div class="col-md-4  article-card">
							<a href="#">
						
								<img src="img/service-img-1.jpg" class="img-fluid border-0" alt="">					
								
							</a>
							<h4 class="pt-3">Место для рыбалки в Астрахани</h4>		
						</div>
					</div>
					<div class="col">
						<button class="btn btn-danger arhive_btn" type="button">Все статьи</button>
					</div>
					<!-- --
				</div>
			</div>		
		</section>	
		<!--/Archive-article section-->
		

		<!-- Contacts -->
		<div id="contacts-sp" class="scroll-point"></div>
		<section class="contacts-section pt-md-5">
			<div class="container"><!-- section .container -->
				<div class="row align-items-center justify-content-center mobile-contacts-row"><!-- section .row -->
					<div class="col-md-12 pt-4 pb-4">
						<nav id="contacts-menu-1" class="navbar-light">
							<!-- Desktop version -->
							<div class="row h-100 justify-content-between align-items-center d-none d-lg-flex">
									<div class="col-3">
										<a class="navbar-brand navbar-logo navbar-logo-white me-2" href="#">
											<img src="/img/logo-light.svg">
										</a>
									</div>
									<div class="col-6">
										<nav id="contacts-menu-2" class="navbar navbar-expand-xl navbar-light">
											<div class="collapse navbar-collapse">
												<ul id="menu-main-menu-2" class="navbar-nav  mb-2 mb-lg-0">
													<li class="menu-item nav-item">
														<a href="index.html" class="nav-link" aria-current="page">Рыболовные базы</a>
													</li>
													<li class="nav-item d-none d-xl-inline">
														<span class="nav-link px-2">
															<img src="/img/ico/menu-point.svg">
														</span>
													</li>
													<li class="menu-item nav-item">
														<a href="#" class="nav-link">Базы на карте</a>
													</li>
													<li class="nav-item d-none d-xl-inline">
														<span class="nav-link px-2">
															<img src="/img/ico/menu-point.svg">
														</span>
													</li>
													<li class="menu-item nav-item">
														<a href="#" class="nav-link active">Рыбалка в Астрахани</a>
													</li>
												</ul>
											</div>
										</nav>			
									</div>								
								<div class="col-3 d-flex justify-content-end">
									<div class="row align-items-center">
										<div class="col">
											<a href="#" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="contact-link pt-2">Добавить&nbsp;базу</a>
										</div>
										<div class="col">
											<a href="/adm" class="btn btn-outline-success" type="button">Войти</a>
										</div>
									</div>
								</div>		
							</div>
							<!-- End Desktop version -->
							
							<!-- Mobail version -->
							<div class="row d-lg-none mobile-contacts-block">
								<div class="col-12 mt-2 mb-4">
									<a class="navbar-brand navbar-logo navbar-logo-white" href="#">
										<img src="/img/mobile-logo-light.svg">
									</a>
								</div>
								<div class="col-12 mb-2">
									<p class="footer-text ">Мы регулярно ищем и добавляем на сайт полезную информацию о рыбалке в Астрахани. Посещайте наш сайт регулярно, если Вас интересует тема отдыха и рыбалки в Астраханской области. Добавьте сайт в закладки, чтобы не потерять его и всегда иметь возможность быстро перейти к интересующей Вас информации (нажмите одновременно Ctrl+D).</p>
								</div>
								<div class="col-12 mb-1 ">
									<a href="/" class="contact-link ps-0" aria-current="page">Рыболовные базы</a>
								</div>	
								<div class="col-12 mb-1 ">		
									<a href="/map.php" class="contact-link ps-0" aria-current="page">Базы на карте</a>
								</div>
								<div class="col-12 mb-1 ">	
									<a href="/archive-articles.php" class="contact-link active ps-0 " aria-current="page">Рыбалка в Астрахани</a>
								</div>
								<div class="col-12 mb-1 ">	
									<a href="offer.php" class="contact-link ps-0" aria-current="page">Реклама на сайте</a>
								</div>
								<div class="col-12 mb-1 ">	
									<a href="#" data-bs-toggle="modal" data-bs-target="#messageModal" class="contact-link ps-0" aria-current="page">Написать нам</a>
								</div>
								<div class="col-12 mb-2 ">	
									<a href="#" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="contact-link ps-0" aria-current="page">Добавить базу</a>
								</div>
								<div class="col">
									<a href="adm" class="btn btn-outline-success mobile-btn" type="button">Войти</a>
								</div>
								<div class="col-12 d-xl-none d-md-none">
									<a class="ico-button pe-2" href="#"><img src="/img/ico/vk-ico.svg"></a>
								</div>	
							</div>
							<!-- END Mobail version -->
						</nav>
					</div>
				</div><!-- /section .row -->

				<div class="row pt-2 d-none d-lg-flex justify-content-center">
					<div class="col-10">
						<p class="footer-text text-center">Мы регулярно ищем и добавляем на сайт полезную информацию о рыбалке в Астрахани. Посещайте наш сайт регулярно, если Вас интересует тема отдыха и рыбалки в Астраханской области. Добавьте сайт в закладки, чтобы не потерять его и всегда иметь возможность быстро перейти к интересующей Вас информации (нажмите одновременно Ctrl+D).</p>
					</div>
				</div>	
				<div class="row footer-link-block">
					<div class="col text-center">
						<!-- <a class="footer-text-link link-offset-3" href="#">Реклама на сайте | Написать нам</a> -->
						<a class="footer-text-link link-offset-1" href="offer.php">Реклама на сайте</a>
						<span class="footer-text-divider">|</span>
						<a data-bs-toggle="modal" data-bs-target="#messageModal" class="footer-text-link link-offset-1" href="#"> Написать нам</a>
					</div>
				</div>	
				<div class="row mb-3  social-block">
					<div class="col text-center">
						<a class="ico-button pe-2" href="https://vk.com/public219332964"><img src="/img/ico/vk-ico.svg"></a>
					</div>
				</div>			
			</div><!-- /section .container -->
			<footer>
				<div class="container">
					<div class="row">
						<div class="col  footer-block-text">
							<!--div id="company-in-footer">©2023 100 окон - производство и установка окон</div-->
							<div class="footer-text">©<?php echo date( 'Y' ); ?>г. | <a href="https://астраханские-базы.рф " class="footer-text-link link-offset-3 text-decoration-none">астраханские-базы.рф</a></div>
						</div>
					</div>
				</div>
			</footer>
		</section>
		<!-- /Contacts -->
	
	
		<!-- Add Base Modal -->
		<div class="modal fade" id="addBaseModal" tabindex="-1" aria-labelledby="addBaseModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="/mls/add_base_mls.php">
						<div class="modal-header">
							<h5 class="modal-title fs-5" id="addBaseModalLabel">Добавить базу</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p><small>Спасибо за проявленный интерес к нашему сервису. В данный момент сервис находится в процессе разработки и Вы не можете добавить Вашу ,базу самостоятельно. Но мы с удовольствием добавим ее туда сами в ближайшее время и сообщим Вам об этом дополнительно. Всю информацию мы возьмем с Вашего сайта. А как только будет готов личный кабинет пользователя, в котором Вы сможете редактировать всю информацию самостоятельно, мы вышлем Вам логин и пароль для входа.</small></p>
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="form-control mb-3 mb-md-0" name="site" placeholder="Введите сайт">
								</div>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" placeholder="Введите Ваш email">
								</div>
							</div>
						</div>
						<div class="modal-footer" style="justify-content: flex-start;">
							<input type="hidden" id="g-recaptcha-response-add-base" name="g-recaptcha-response">
							<a type="button" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="btn btn-primary">Добавить</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Base Modal -->
		
		
		<!-- Other Modal -->
		<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="/mls/message_mls.php">
						<div class="modal-header">
							<h5 class="modal-title fs-5" id="messageModalLabel">Напишите Ваше сообщение</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!--p><small>Спасибо за проявленный интерес к нашему сервису. В данный момент сервис находится в процессе разработки и Вы не можете добавить Вашу ,базу самостоятельно. Но мы с удовольствием добавим ее туда сами в ближайшее время и сообщим Вам об этом дополнительно. Всю информацию мы возьмем с Вашего сайта. А как только будет готов личный кабинет пользователя, в котором Вы сможете редактировать всю информацию самостоятельно, мы вышлем Вам логин и пароль для входа.</small></p-->
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="form-control mb-3" name="name" placeholder="Ваше имя">
								</div>
								<div class="col-md-6">
									<input type="email" class="form-control mb-3" name="email" placeholder="Ваш email">
								</div>
							</div>
							<textarea class="form-control" name="mes" placeholder="Ваше сообщение"></textarea>
						</div>
						<div class="modal-footer" style="justify-content: flex-start;">
							<input type="hidden" id="g-recaptcha-response-send-message" name="g-recaptcha-response">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Other Modal -->
	
		
		<!-- Bootstrap JS -->
		<script src="/js/bootstrap.bundle.min.js"></script>
		
		
		<!-- Theme JS
		<script src="/js/script.js"></script> -->
		
		
		<!-- reCaptcha v3 New from Google -->
		<script src='https://www.google.com/recaptcha/api.js?render=6LdV1IcUAAAAADRQAhpGL8dVj5_t0nZDPh9m_0tn'></script>
		<script>
			grecaptcha.ready(function() {
				grecaptcha.execute('6LdV1IcUAAAAADRQAhpGL8dVj5_t0nZDPh9m_0tn', {action: 'action_name'}).then(function(token) {
					document.getElementById('g-recaptcha-response-send-message').value=token;
					document.getElementById('g-recaptcha-response-add-base').value=token;
				});
			});
		</script>
	</body>
</html>		