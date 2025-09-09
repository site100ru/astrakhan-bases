<?php
	// Настройки БД
	$db_host = 'localhost';
	$db_name = 'u1538455_astrakhan-base';
	$db_user = 'u1538455_default';
	$db_password = '8eHZIi9Y633RE2pp';
	
	// Подключение к БД
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
	
	// Делаем правильную кодировку
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
	mysqli_query($connection, "SET CHARACTER SET 'utf8'");
	

	// Подключаемся к таблице баз c сортировкой по умолчанию (по id)
	$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_id` DESC");

?>

<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Карта рыболовных баз Астраханской области, на раскатах реки волги, с описанием, фотографиями, отзывами и ценами без посредников на проживание и услуги в 2025 году" />
		<meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, карта, на карте, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2025, году" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="Рыболовные базы в Астраханской области" />
		<meta property="og:title" content="Рыболовные базы на карте Астраханской области - рыбалка, охота и отдых в дельте реки Волги по ценам 2025 года" />
		<meta property="og:description" content="Карта рыболовных баз Астраханской области, на раскатах реки волги, с описанием, фотографиями, отзывами и ценами без посредников на проживание и услуги в 2025 году" />
		<!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
		<!-- Yandex.Webmaster -->
		<meta name="yandex-verification" content="70fe58b7e11a9545" />
		<title>Рыболовные базы на карте Астраханской области - рыбалка, охота и отдых в дельте реки Волги по ценам 2025 года</title>
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Style CSS -->
		<link href="css/theme.css" rel="stylesheet">
		
		<link rel="icon" href="https://xn----7sbaabf0atet6a7amek4c2g.xn--p1ai/favicon.ico" type="image/x-icon">
		
		<!-- Yandex.RTB -->
		<script>window.yaContextCb=window.yaContextCb||[]</script>
		<script src="https://yandex.ru/ads/system/context.js" async></script>
		
		<!-- Yandex.RTB R-A-2083129-3
		<script>
			window.yaContextCb.push(()=>{
				Ya.Context.AdvManager.render({
					"blockId": "R-A-2083129-3",
					"type": "fullscreen",
					"platform": "touch"
				})
			})
		</script> -->
		
		<!-- Ajax -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
		<script>
			// Удаляем сообщение об обновлении данных формы после отправки
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}
		</script>
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
								<img src="/img/ico/menu-point.svg" class="pb-2">
							</span>
						</li>
						<li class="menu-item nav-item">
							<a href="/map.php" class="nav-link active" aria-current="page">Базы на карте</a>
						</li>
						<li class="nav-item d-none d-xl-inline">
							<span class="nav-link px-2">
								<img src="/img/ico/menu-point.svg" class="pb-2">
							</span>
						</li>
						<li class="menu-item nav-item">
							<a href="/archive-articles.php" class="nav-link">Рыбалка в астрахани</a>
						</li>
					
						<!-- Mobile menu -->
						<li class="nav-item d-xl-none">
							<!-- <a class="nav-link top-menu-tel pt-1 pb-2" href="tel:89307878068">8 (930) 78-78-0-68</a>
							<div class="location-block">
								<img src="./img/location-ico.svg" style="width: 10px;" class="me-1">
									<span>Москва</span>
							</div> -->
							<!--div style="font-size: 12px; font-family: HelveticaNeueCyr-Light; text-transform: none;">
								<img src="img/ico/clock-ico.svg" style="width: 10px; position: relative; top: -1px;" class="me-1">Ежедневно с 9:00 до 21:00
							</div-->
						</li>
						<li class="nav-item d-xl-none pt-2 pb-2">
							<a class="ico-button pe-2" href="#"><img src="/img/ico/vk-ico.svg"></a>
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
						<a href="" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="menu-item nav-link pt-2">Добавить&nbsp;базу</a>
					</div>
					<div class="col">
						<a href="/adm" class="btn btn-outline-success" type="button">Войти</a>
					</div>	
				</div>
			</div>
		</nav>
		<!-- /Menu header -->

		
		<header style="background: url(img/header-bg.webp) center; padding-top: 50px; padding-bottom: 50px;">
			<div class="container">
				<div class="row">
					<div class="col text-light">
						<h1 class="home-title">Рыболовные базы на карте Астраханской области</h1>
						<h2 class="home-subtitle">Рыбалка, охота и отдых в дельте реки Волги по ценам 2025 года</h2>
						<h3 class="home-description mb-0 fw-light fs-4">Карта рыболовных баз Астраханской области, на раскатах реки волги, с описанием, фотографиями, отзывами и ценами без посредников на проживание и услуги в 2025 году.<h3>
					</div>
				</div>
			</div>
		</header>
		
		
		<?php
			// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
			//$rand = rand(0, 1);
			$rand = 2; // Показывать только рекламный баннер
				
			if ( $rand == 0 ) { ?>
				<section>
					<div class="container pt-5">
						<div class="row mb-5">
							<div class="col">
								<!-- Yandex.RTB R-A-2083129-1
								<div id="yandex_rtb_R-A-2083129-1-1"></div>
								<script>window.yaContextCb.push(()=>{
									Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-2083129-1-1',
										blockId: 'R-A-2083129-1',
										pageNumber: 1
									})
								})</script> -->
							</div>
						</div>
						<hr class="m-0 mt-5">
					</div>
				</section>
			<?php } else if ( $rand == 1 ) { ?>
				<section>
					<div class="container pt-5">
						<div class="row mb-5">
							<div class="col">
								<!-- Yandex.RTB R-A-2083129-2
								<div id="yandex_rtb_R-A-2083129-2-2"></div>
								<script>window.yaContextCb.push(()=>{
									Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-2083129-2-2',
										blockId: 'R-A-2083129-2',
										pageNumber: 2
									})
								})</script> -->
							</div>
						</div>
						<hr class="m-0 mt-5">
					</div>
				</section>
			<?php } else if ( $rand == 2 ) { ?>
				<section>
					<div class="container pt-5">
						<div class="row mb-5">
							<div class="col">
								<a href="https://fat-fish.ru" onclick="ym(90515560,'reachGoal','bannerOnClick'); return true;" target="blank">
									<img src="img/banner-2.webp" class="d-none d-md-inline-block img-fluid">
									<img src="img/banner-mobail-2.webp" class="d-md-none img-fluid">
								</a>
							</div>
						</div>
						<hr class="m-0 mt-5">
					</div>
				</section>
			<?php }
		?>
		
		
		<section>
			<div class="container pt-5">
				<style>
					@font-face {
						font-family: HelveticaNeueCyr-Roman;
						src: url(fonts/Helvetica/HelveticaNeueCyr-Light.ttf);
					}
					
					.btn.btn-corporate-color-1:first-child:hover, :not(btn-corporate-color-1.btn-check)+.btn-corporate-color-1.btn:hover {
						color: 646464;
						background-color: #e1e1e1;
						border-color: #ebebeb;
					}
					
					.btn-corporate-color-1 {
						height: 45px;
						background-color: #f0f0f0;
						border-color: #ebebeb;
						font-family: HelveticaNeueCyr-Roman;
						color: #646464;
						font-size: 20px;
					}
					
					.btn-corporate-color-1:hover {
						background-color: #e1e1e1;
					}
					
					#sortSelect {
						height: 45px;
						background-color: #f0f0f0;
						border-color: #ebebeb;
						font-family: HelveticaNeueCyr-Roman;
						color: #646464;
						font-size: 20px;
						cursor: pointer;
						transition: .2s;
					}
					
					#sortSelect:hover {
						background-color: #e1e1e1;
					}
					
					.option {
						cursor: pointer;
						background: #ffffff;
					}
				</style>
				<div class="row justify-content-center">
					<div class="col-md-3 order-md-2">
						<a href="/" type="button" class="btn btn-corporate-color-1 w-100 mb-3 mb-md-0">Показать список баз</a>
					</div>
				</div>
			</div>
		</section>
		
		
		<!--section>
			<div class="container pt-5">
				<hr class="m-0 mb-5">
				<div class="row mb-2">
					<div class="col">
						<!-- Yandex.RTB R-A-1954371-1 -->
						<!--div id="yandex_rtb_R-A-1954371-1"></div>
						<script>window.yaContextCb.push(()=>{
						  Ya.Context.AdvManager.render({
							renderTo: 'yandex_rtb_R-A-1954371-1',
							blockId: 'R-A-1954371-1'
						  })
						})</script>
					</div>
				</div>
			</div>
		</section-->
		
		
		<section>
			<div class="container">
				<div class="row">
					<div class="col">
						<hr class="m-0 mb-5 mt-5">
						<div id="map" style="width: 100%; height: 575px; border-radius: 5px; overflow: hidden;"></div>
					</div>
				</div>
			</div>
		</section>
		
		
<?php
	// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
	//$rand = rand(0, 1);
	$rand = 0;
	
	if ( $rand == 0 ) { ?>
		<section>
			<div class="container py-5">
				<hr class="m-0 mb-5">
				<div class="row mb-2">
					<div class="col">
						<!-- Yandex.RTB R-A-10263123-1 -->
						<div id="yandex_rtb_R-A-10263123-1"></div>
						<script>
							window.yaContextCb.push(() => {
								Ya.Context.AdvManager.render({
									"blockId": "R-A-10263123-1",
									"renderTo": "yandex_rtb_R-A-10263123-1"
								})
							})
						</script>
					</div>
				</div>
			</div>
		</section>
	<?php } else if ( $rand == 1 ) { ?>
		<section>
			<div class="container py-5">
				<hr class="m-0 mb-5">
				<div class="row mb-2">
					<div class="col">
						<!-- Yandex.RTB R-A-2083129-2
						<div id="yandex_rtb_R-A-2083129-2"></div>
						<script>window.yaContextCb.push(()=>{
							Ya.Context.AdvManager.render({
								renderTo: 'yandex_rtb_R-A-2083129-2',
								blockId: 'R-A-2083129-2'
							})
						})</script> -->
					</div>
				</div>
			</div>
		</section>
	<?php }
?>


<?php include 'footer.php'; ?>