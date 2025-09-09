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
	
	/* Получаем id базы */
	$base_id = $_GET[ 'base_id' ];
	
	/* Делаем пагинацию
	if ( isset( $_GET[ 'page' ] ) ) {
		$page = $_GET[ 'page' ]; // Читаем GET-запрос номера страницы
	} else {
		$page = 1;
	}
	
	$baseOfPage = 25; // Количество баз на странице
	$fromPage = ( $page - 1 ) * $baseOfPage; // Какую страницу по счету показываем
	 */
	
	
	// Принимаем данные из API Yandex Map и записываем в БД
	if ( isset( $_POST[ 'baseYandexId'] ) ) {
		$base_yandex_id = $_POST[ 'baseYandexId' ];
		$base_yandex_rating = $_POST[ 'baseYandexRating' ];
		$base_yandex_gps_x = $_POST[ 'baseYandexGpsX' ];
		$base_yandex_gps_y = $_POST[ 'baseYandexGpsY' ];
		$base_yandex_gps = $base_yandex_gps_x.','.$base_yandex_gps_y;
		$result = mysqli_query( $connection, "UPDATE `base` SET `base_yandex_rating` = '$base_yandex_rating', `base_gps` = '$base_yandex_gps' WHERE `base_yandex_id` = '$base_yandex_id'");
	}
	
	// Формируем title
	$result = mysqli_query($connection, "SELECT * FROM `base` WHERE `base_id` = $base_id");
	$record = mysqli_fetch_assoc( $result );
	$title = strip_tags( $record[ 'base_name' ] );
	
	// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
	//$rand = rand(0, 1);
	
?>

<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Мы собрали для Вас недорогие рыболовные базы в Астраханской области, на раскатах реки Волги, с описанием, фотографиями, отзывами и ценами на 2025 год - <?php echo $title; ?>" />
		<meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2025, году" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="Рыболовные базы в Астраханской области цены в 2025 году" />
		<meta property="og:title" content="Рыболовные базы в Астраханской области цены в 2025 году - <?php echo $title; ?>" />
		<meta property="og:description" content="Мы собрали для Вас недорогие рыболовные базы в Астраханской области, на раскатах реки Волги, с описанием, фотографиями, отзывами и ценами на 2025 год - <?php echo $title; ?>" />
		<!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
		<!-- Yandex.Webmaster -->
		<meta name="yandex-verification" content="70fe58b7e11a9545" />
		<title>Рыболовные базы в Астраханской области цены в 2025 году - <?php echo $title; ?></title>
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Style CSS -->
		<link href="css/theme.css" rel="stylesheet">
		
		<link rel="icon" href="https://xn----7sbaabf0atet6a7amek4c2g.xn--p1ai/favicon.ico" type="image/x-icon">
		
		<!-- Yandex.RTB -->
		<script>window.yaContextCb=window.yaContextCb||[]</script>
		<script src="https://yandex.ru/ads/system/context.js" async></script>
		
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
							<a href="/map.php" class="nav-link">Базы на карте</a>
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
						<h1 class="home-title">Рыболовные базы в Астраханской области цены в 2025 году</h1>
						<h2 class="home-subtitle">Рыбалка, охота и отдых в дельте реки Волги</h2>
						<h3 class="home-description mb-0 fw-light fs-4">
							<?php
								$result = mysqli_query($connection, "SELECT * FROM `base` WHERE `base_id` = $base_id");
								$record = mysqli_fetch_assoc( $result );
								echo $record[ 'base_name' ];
							?>
						<h3>
					</div>
				</div>
			</div>
		</header>
		
		
		<?php /*
			if ( $rand == 0 ) { ?>
				<section>
					<div class="container pt-5">
						<hr class="m-0 mb-5">
						<div class="row mb-2">
							<div class="col">
								<!-- Yandex.RTB R-A-2083129-1 -->
								<div id="yandex_rtb_R-A-2083129-1"></div>
								<script>window.yaContextCb.push(()=>{
									Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-2083129-1',
										blockId: 'R-A-2083129-1'
									})
								})</script>
							</div>
						</div>
					</div>
				</section>
			<?php } */
		?>
		
		
		<?php
			// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
			//$rand = rand(0, 1);
			$rand = 2; // Показывать только рекламный баннер
				
			if ( $rand == 0 ) { ?>
				<section>
					<div class="container pt-5">
						<div class="row mb-5">
							<div class="col">
								<!-- Content -->
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
								<!-- Yandex.RTB R-A-2083129-2 -->
								<div id="yandex_rtb_R-A-2083129-2-2"></div>
								<script>window.yaContextCb.push(()=>{
									Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-2083129-2-2',
										blockId: 'R-A-2083129-2',
										pageNumber: 2
									})
								})</script>
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
			<div class="container">
				<?php
					$pic1 = false;
					/* Получаем базы */
					$result = mysqli_query($connection, "SELECT * FROM `base`");
					while ( $record = mysqli_fetch_assoc( $result ) ) {
						if ( $record[ 'base_id' ] == $base_id ) { ?>
							<hr class="m-0 mb-5">
							<div class="row pt-2">
								<div class="col-md-8">
									<h2 class="d-md-none mb-3"><?php echo $record[ 'base_name' ]; ?></h2>
									<div id="carousel-<?php echo $record[ 'base_id' ]; ?>" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="9999999999">
										<div class="carousel-inner mb-3 mb-md-0">
											<?php
												$img_dir = $record[ 'base_image' ]; // Папка с изображениями
												if( file_exists( $img_dir ) ) {
													$img_count = array();
													$d = opendir( $img_dir );
													while ( $file_name = readdir($d) ) {
														if ($file_name == '.' or $file_name == '..' or is_dir($img_dir.'/'.$file_name)) continue;
														$img_count[] = $img_dir.'/'.$file_name;
														
													} closedir($d);
													
													
												} else { echo '404 not found'; }
												
												sort( $img_count ); // Сортируем фото
												
												if (!empty($img_count)) {
													foreach($img_count as $pic) {
														if ($pic1 == false) { echo '
															<div class="carousel-item active">
																<img data-src="'.$pic.'" class="d-block w-100 rounded lazyload" loading="lazy" alt="'.isset( $record['title'] ).'">
															</div>
														'; $pic1 = true; } else {
														echo '
															<div class="carousel-item">
																<img data-src="'.$pic.'" class="d-block w-100 rounded lazyload" loading="lazy" alt="'.isset( $record['title'] ).'">
															</div>
														'; }
													}
													$pic1 = false;
												}
											?>
										</div>
										<button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $record[ 'base_id' ]; ?>" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $record[ 'base_id' ]; ?>" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
								</div>
								<div class="col-md-4">
									<h2 class="d-none d-md-block mb-3"><?php echo $record[ 'base_name' ]; ?></h2>
									<ul class="" style="padding-left: 0; list-style: none;">
										<?php if ( $record[ 'base_price' ] != 0 ) { ?>
											<li class="mb-3"><strong>Цена:</strong> от <?php echo $record[ 'base_price' ]; ?> руб/чел/сутки</li>
										<?php } ?>
										<li class="mb-3"><strong>Адрес:</strong> <?php echo $record[ 'base_location' ]; ?></li>
										<?php if ( $record[ 'base_gps' ] != '' ) { ?>
											<li class="mb-3"><strong>GPS-координаты:</strong> <?php echo $record[ 'base_gps' ]; ?></li>
										<?php } ?>
										<?php if ( $record[ 'base_site' ] != '' ) { ?>
											<li class="mb-3"><strong>Сайт:</strong> <a href="http://<?php echo $record[ 'base_site' ]; ?>" target="blank"><?php echo $record[ 'base_site' ]; ?></a></li>
										<?php } ?>
										<li class="mb-3"><strong>Телефон:</strong> <?php echo $record[ 'base_phone' ]; ?></li>
										<?php
											if ( $record[ 'base_yandex_id' ] != 0 ) { ?>
												<li class="mb-3"><strong>Рейтинг в Яндексе:</strong> <?php echo $record[ 'base_yandex_rating' ]; ?></li>
												<li class="mb-3"><strong>Количество отзывов:</strong> <span id="review-<?php echo $record[ 'base_id' ]; ?>"></span> <a href="<?php echo 'https://yandex.ru/profile/'.$record[ 'base_yandex_id' ]; ?>" target="blank">Читать</a></li>
												<li class="mb-3"><a a href="/map.php?base_id=<?php echo $record[ 'base_id' ]; ?>">Показать на карте</a></li>
											<?php }
										?>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<?php
										if ( $record[ 'base_description' ] != '' ) { ?>
											<p class="mb-2"><strong>Описание:</strong></p>
											<?php echo $record[ 'base_description' ]; ?>
										<?php }
									?>
									<a href="#" class="d-block" onclick="window.history.go(-1); return false;">Вернуться обратно</a>
								</div>
							</div>
						<?php }
					}
				?>
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
						<!-- Yandex.RTB R-A-2083129-2 --
						<div id="yandex_rtb_R-A-2083129-2-2"></div>
						<script>window.yaContextCb.push(()=>{
							Ya.Context.AdvManager.render({
								renderTo: 'yandex_rtb_R-A-2083129-2-2',
								blockId: 'R-A-2083129-2',
								pageNumber: 2
							})
						})</script-->
					</div>
				</div>
			</div>
		</section>
	<?php }
?>
		
		
<?php include 'footer.php'; ?>