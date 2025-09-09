<?php
	
	session_start();
	
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
	
	/* Делаем пагинацию */
	if ( isset( $_GET[ 'page' ] ) ) {
		$page = $_GET[ 'page' ]; // Читаем GET-запрос номера страницы
	} else {
		$page = 1;
	}
	
	$baseOfPage = 20; // Количество баз на странице
	$fromPage = ( $page - 1 ) * $baseOfPage; // Какую страницу по счету показываем
	
	
	
	/* Принимаем данные из API Yandex Map и записываем в БД */
	if ( isset( $_POST[ 'baseYandexId'] ) ) {
		$base_yandex_id = $_POST[ 'baseYandexId' ];
		$base_yandex_rating = $_POST[ 'baseYandexRating' ];
		$base_yandex_gps_x = $_POST[ 'baseYandexGpsX' ];
		$base_yandex_gps_y = $_POST[ 'baseYandexGpsY' ];
		$base_yandex_gps = $base_yandex_gps_x.','.$base_yandex_gps_y;
		$result = mysqli_query( $connection, "UPDATE `base` SET `base_yandex_rating` = '$base_yandex_rating', `base_gps` = '$base_yandex_gps' WHERE `base_yandex_id` = '$base_yandex_id'");
	}
	
	
	
	/* Фильтр */
	// При нажатии на кнопку filter -> submit
	// Получаем значения чекбоксов и записываем их в переменную сессии
	if ( isset( $_POST[ 'filter' ] ) ) {
		// Если чекбокс 1 выбран
		if ( isset( $_POST[ 'base-stay-cost-checkbox' ][1] ) ) {
			// То записываем занчение чекбокса 1 в сессию
			$_SESSION[ 'filter1' ] = "`base_price` >= 0 AND `base_price` <= 1000";
		} else { // Иначе убиваем чекбокс 1
			$_SESSION[ 'filter1' ] = null;
		}
		// И так далее
		if ( isset( $_POST[ 'base-stay-cost-checkbox' ][2] ) ) {
			$_SESSION[ 'filter2' ] = "`base_price` >= 1000 AND `base_price` <= 2500";
		} else {
			$_SESSION[ 'filter2' ] = null;
		}
		
		if ( isset( $_POST[ 'base-stay-cost-checkbox' ][3] ) ) {
			$_SESSION[ 'filter3' ] = "`base_price` >= 2500 AND `base_price` <= 5000";
		} else {
			$_SESSION[ 'filter3' ] = null;
		}
		
		if ( isset( $_POST[ 'base-stay-cost-checkbox' ][4] ) ) {
			$_SESSION[ 'filter4' ] = "`base_price` >= 5000";
		} else {
			$_SESSION[ 'filter4' ] = null;
		}
	} 
	
	/* Выводим значения чекбоксов
	if ( isset( $_SESSION[ 'base-stay-cost-checkbox' ][1] ) ) { echo $_SESSION[ 'base-stay-cost-checkbox' ][1]; }
	if ( isset( $_SESSION[ 'base-stay-cost-checkbox' ][2] ) ) { echo $_SESSION[ 'base-stay-cost-checkbox' ][2]; }
	if ( isset( $_SESSION[ 'base-stay-cost-checkbox' ][3] ) ) { echo $_SESSION[ 'base-stay-cost-checkbox' ][3]; }
	if ( isset( $_SESSION[ 'base-stay-cost-checkbox' ][4] ) ) { echo $_SESSION[ 'base-stay-cost-checkbox' ][4]; } */


	
	/* Сортировка */
	if ( isset( $_POST[ 'sortSelect' ] ) ) {
		$_SESSION[ 'sortSelect' ] = $_POST[ 'sortSelect' ];
		
		if ( $_SESSION[ 'sortSelect' ] == 'fromMinPriceSort' ) {
			// Подключаемся к таблице баз c сортировкой по цене (от меньшей)
			//$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price` LIMIT $fromPage,$baseOfPage");
			$order = " ORDER BY `base_price` LIMIT $fromPage,$baseOfPage";
		
		} else if ( $_SESSION[ 'sortSelect' ] == 'fromMaxPriceSort' ) {
			// Подключаемся к таблице баз c сортировкой по цене (от большей)
			//$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price` DESC LIMIT $fromPage,$baseOfPage");
			$order = " ORDER BY `base_price` DESC LIMIT $fromPage,$baseOfPage";
			
		} else if ( $_SESSION[ 'sortSelect' ] == 'fromMaxRatingSort' ) {
			// Подключаемся к таблице баз c сортировкой по рейтингу (от меньшего)
			//$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating` DESC LIMIT $fromPage,$baseOfPage" );
			$order = " ORDER BY `base_yandex_rating` DESC LIMIT $fromPage,$baseOfPage";
			
		} else if ( $_SESSION[ 'sortSelect' ] == 'fromMinRatingSort' ) {
			// Подключаемся к таблице баз c сортировкой по рейтингу (от большего)
			//$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating` LIMIT $fromPage,$baseOfPage" );
			$order = " ORDER BY `base_yandex_rating` LIMIT $fromPage,$baseOfPage";
			
		} else if ( $_SESSION[ 'sortSelect' ] == 'defaultSort' ) {
			$_SESSION[ 'sortSelect' ] = 'defaultSort';
			// Подключаемся к таблице баз c сортировкой по умолчанию (по id)
			//$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_id` DESC LIMIT $fromPage,$baseOfPage");
			$order = " ORDER BY `base_id` DESC LIMIT $fromPage,$baseOfPage";
			
		}
	} else {
		// Если сортировка не выбрана
		if ( !isset( $_SESSION[ 'sortSelect' ] ) ) {
			$_SESSION[ 'sortSelect' ] = 'defaultSort';
			// Подключаемся к таблице баз c сортировкой по умолчанию (по id)
			//$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_id` DESC LIMIT $fromPage,$baseOfPage" );
			$order = " ORDER BY `base_id` DESC LIMIT $fromPage,$baseOfPage";
			
		} else {
			if ( $_SESSION[ 'sortSelect' ] == 'fromMinPriceSort' ) {
				// Подключаемся к таблице баз c сортировкой по цене (от меньшей)
				//$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price` LIMIT $fromPage,$baseOfPage");
				$order = " ORDER BY `base_price` LIMIT $fromPage,$baseOfPage";
			
			} else if ( $_SESSION[ 'sortSelect' ] == 'fromMaxPriceSort' ) {
				// Подключаемся к таблице баз c сортировкой по цене (от большей)
				//$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price` DESC LIMIT $fromPage,$baseOfPage");
				$order = " ORDER BY `base_price` DESC LIMIT $fromPage,$baseOfPage";
				
			} else if ( $_SESSION[ 'sortSelect' ] == 'fromMaxRatingSort' ) {
				// Подключаемся к таблице баз c сортировкой по рейтингу (от меньшего)
				//$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating` DESC LIMIT $fromPage,$baseOfPage" );
				$order = " ORDER BY `base_yandex_rating` DESC LIMIT $fromPage,$baseOfPage";
				
			} else if ( $_SESSION[ 'sortSelect' ] == 'fromMinRatingSort' ) {
				// Подключаемся к таблице баз c сортировкой по рейтингу (от большего)
				//$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating` LIMIT $fromPage,$baseOfPage" );
				$order = " ORDER BY `base_yandex_rating` LIMIT $fromPage,$baseOfPage";
			
			// Если выбрана сортировка по умолчанию
			} else if ( $_SESSION[ 'sortSelect' ] == 'defaultSort' ) {
				$_SESSION[ 'sortSelect' ] = 'defaultSort';
				// Cортировка по умолчанию (по id)
				$order = " ORDER BY `base_id` DESC LIMIT $fromPage,$baseOfPage";
			}
		}
	}
	
	
	// Собираем запрос к БД
	if ( isset( $_SESSION[ 'filter1' ] ) OR isset( $_SESSION[ 'filter2' ] ) OR isset( $_SESSION[ 'filter3' ] ) OR isset( $_SESSION[ 'filter4' ] ) ) {
		$filters = ' WHERE ';
	}
	if ( isset( $_SESSION[ 'filter1' ] ) ) {
		$filters .= $_SESSION[ 'filter1' ];
	}
	if ( isset( $_SESSION[ 'filter2' ] ) ) {
		if ( isset( $_SESSION[ 'filter1' ] ) ) {
			$filters .= ' OR ' . $_SESSION[ 'filter2' ];
		} else {
			$filters .= $_SESSION[ 'filter2' ];
		}
	}
	if ( isset( $_SESSION[ 'filter3' ] ) ) {
		if ( isset( $_SESSION[ 'filter1' ] ) OR isset( $_SESSION[ 'filter2' ] ) ) {
			$filters .= ' OR ' . $_SESSION[ 'filter3' ];
		} else {
			$filters .= $_SESSION[ 'filter3' ];
		}
	}
	if ( isset( $_SESSION[ 'filter4' ] ) ) {
		if ( isset( $_SESSION[ 'filter1' ] ) OR isset( $_SESSION[ 'filter2' ] ) OR isset( $_SESSION[ 'filter3' ] ) ) {
			$filters .= ' OR ' . $_SESSION[ 'filter4' ];
		} else {
			$filters .= $_SESSION[ 'filter4' ];
		}
	}
	
	
	$question = "SELECT * FROM `base`"; // Начало запроса
	if ( isset( $filters ) ) { $question .= $filters; } // Фильтр
	$question .= $order; // Сортировка
	// Собираем все части запроса
	//echo $question;
	$result = mysqli_query( $connection, $question );
	
?>

<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Мы собрали для Вас недорогие рыболовные базы в Астраханской области, на раскатах реки Волги, с описанием, фотографиями, отзывами и ценами на 2025 год." />
		<meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2025, году" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="Рыболовные базы в Астраханской области цены в 2025 году" />
		<meta property="og:title" content="Рыболовные базы в Астраханской области цены в 2025 году" />
		<meta property="og:description" content="Мы собрали для Вас недорогие рыболовные базы в Астраханской области, на раскатах реки Волги, с описанием, фотографиями, отзывами и ценами на 2025 год." />
		<!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
		<!-- Yandex.Webmaster -->
		<meta name="yandex-verification" content="70fe58b7e11a9545" />
		<title>Рыболовные базы в Астраханской области цены в 2025 году</title>
		
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
							<a href="/" class="nav-link active" aria-current="page">Рыболовные базы</a>
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
						<h1 class="home-title">Рыболовные базы в Астраханской области</h1>
						<h2 class="home-subtitle">Цены на рыбалку, охоту и отдых в дельте реки Волги в 2025 году</h2>
						<h3 class="home-description mb-0 fw-light fs-4">Мы собрали для Вас рыболовные базы в Астраханской области, на раскатах реки Волги, с описанием, фотографиями, отзывами и ценами на 2025 год, от самых недорогих и экономных до баз премиум сегмента.<h3>
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
							<div class="col"></div>
						</div>
						<hr class="m-0 mt-5">
					</div>
				</section>
			<?php } else if ( $rand == 1 ) { ?>
				<section>
					<div class="container pt-5">
						<div class="row mb-5">
							<div class="col"></div>
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
				<div class="row justify-content-center">
					<div class="col-md-4 col-lg-3 order-md-3">
						<a href="map.php" type="button" class="btn btn-corporate-color-1 w-100 mb-3 mb-md-0">Показать на карте</a>
					</div>
					<div class="col-md-4 col-lg-3 order-md-1">
						<button class="btn btn-corporate-color-1 w-100 mb-3 mb-md-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							Фильтр
						</button>
					</div>
					<div class="col-md-10 order-md-4">
						<div class="collapse" id="collapseExample">
							<div class="card card-body mt-0 mt-md-3 mb-3 mb-md-0">
								<form method="post" action="">
									<div class="row">
										<div class="col">
											<p><strong>По цене:</strong></p>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="base-stay-cost-checkbox[1]" type="checkbox" id="inlineCheckbox1" value="option1" <?php if ( isset( $_SESSION[ 'filter1' ] ) ) { echo 'checked'; } ?>>
												<label class="form-check-label" for="inlineCheckbox1">0 - 1 000 руб</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="base-stay-cost-checkbox[2]" type="checkbox" id="inlineCheckbox2" value="option2" <?php if ( isset( $_SESSION[ 'filter2' ] ) ) { echo 'checked'; } ?>>
												<label class="form-check-label" for="inlineCheckbox2">1 000 - 2 500 руб</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="base-stay-cost-checkbox[3]" type="checkbox" id="inlineCheckbox3" value="option3" <?php if ( isset( $_SESSION[ 'filter3' ] ) ) { echo 'checked'; } ?>>
												<label class="form-check-label" for="inlineCheckbox3">2 500 - 5 000 руб</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="base-stay-cost-checkbox[4]" type="checkbox" id="inlineCheckbox4" value="option4" <?php if ( isset( $_SESSION[ 'filter4' ] ) ) { echo 'checked'; } ?>>
												<label class="form-check-label" for="inlineCheckbox4">от 5 000 руб</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col pt-3">
											<button type="submit" class="btn btn-corporate-color-1" name="filter">
												Применить
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-lg-4 order-md-2">
						<form method="post" id="sortForm">
							<select id="sortSelect" name="sortSelect" class="form-select text-center" aria-label="Default select example" onChange="document.getElementById( 'sortForm' ).submit();">
								<option class="option" value="defaultSort" <?php if ( $_SESSION[ 'sortSelect' ] == 'defaultSort' ) { echo ' selected'; } ?>>Сортировать по умолчанию</option>
								<option class="option" value="fromMinPriceSort" <?php if ( $_SESSION[ 'sortSelect' ] == 'fromMinPriceSort' ) { echo ' selected'; } ?>>Сортировать по цене: от меньшей</option>
								<option class="option" value="fromMaxPriceSort" <?php if ( $_SESSION[ 'sortSelect' ] == 'fromMaxPriceSort' ) { echo ' selected'; } ?>>Сортировать по цене: от большей</option>
								<option class="option" value="fromMaxRatingSort" <?php if ( $_SESSION[ 'sortSelect' ] == 'fromMaxRatingSort' ) { echo ' selected'; } ?>>Сортировать по рейтингу: от большего</option>
								<option class="option" value="fromMinRatingSort" <?php if ( $_SESSION[ 'sortSelect' ] == 'fromMinRatingSort' ) { echo ' selected'; } ?>>Сортировать по рейтингу: от меньшего</option>
							</select>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		
		<!--section>
			<div class="container pt-5">
				<hr class="m-0 mb-5">
				<div class="row mb-2">
					<div class="col"></div>
				</div>
			</div>
		</section-->
		
		<?php
			/* Получаем количество страниц */
			// Получаем количество записей
			if ( isset( $filters ) ) { // Если фильтры существуют, то считаем количество записей с учетом фильтров
				$result_count = mysqli_query( $connection, "SELECT COUNT(*) as count FROM `base`".$filters );
			} else { // Иначе считаем все записи
				$result_count = mysqli_query( $connection, "SELECT COUNT(*) as count FROM `base`" );
			}
			$record_count = mysqli_fetch_assoc( $result_count )[ 'count' ];
			$page_count = ceil( $record_count/$baseOfPage );
		?>
		
		
		
<section>
	<div class="container">
		<?php
			$pic1 = false;
			$count = 0;
			while ( $record = mysqli_fetch_assoc( $result ) ) { $count = $count + 1; ?>
				<hr class="m-0 mb-5 mt-5">
				<div class="row pt-2">
					<div class="col-md-8">
						<h2 class="d-md-none"><?php echo $record[ 'base_name' ]; ?></h2>
						<p class="d-md-none mb-3"><!--strong>Адрес:</strong> --><?php echo $record[ 'base_location' ]; ?></p>
						<div id="carousel-<?php echo $record[ 'base_id' ]; ?>" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="9999999999">
							<div class="carousel-inner mb-3 mb-md-0">
								<?php
									$img_dir = $record[ 'base_image' ];
									if( file_exists($img_dir) ) {
										$img_count = array();
										$d = opendir($img_dir);
										while ($file_name = readdir($d)) {
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
							<li class="d-none d-md-block mb-3"><strong>Адрес:</strong> <?php echo $record[ 'base_location' ]; ?></li>
							<?php if ( $record[ 'base_price' ] != 0 ) { ?>
								<li class="mb-3"><strong>Цена:</strong> от <?php echo $record[ 'base_price' ]; ?> руб/чел/сутки</li>
							<?php }
							if ( $record[ 'base_yandex_id' ] != 0 ) { ?>
									<li class="mb-3"><strong>Рейтинг в Яндексе:</strong> <?php echo $record[ 'base_yandex_rating' ]; ?></li>
									<li class="mb-3"><strong>Количество отзывов:</strong> <span id="review-<?php echo $record[ 'base_id' ]; ?>"></span> <a href="<?php echo 'https://yandex.ru/profile/'.$record[ 'base_yandex_id' ]; ?>" target="blank">Читать</a></li>
									
								<?php } ?>
							
							<?php // if ( $record[ 'base_gps' ] != '' ) { ?>
								<!--li class="mb-3"><strong>GPS-координаты:</strong> <?php echo $record[ 'base_gps' ]; ?></li-->
							<?php // } ?>
							<?php /* if ( $record[ 'base_site' ] != '' ) { ?>
								<li class="mb-3"><strong>Сайт:</strong> <a href="http://<?php echo $record[ 'base_site' ]; ?>" target="blank"><?php echo $record[ 'base_site' ]; ?></a></li>
							<?php } */ ?>
							<li class="mb-3"><strong>Телефон:</strong> <?php echo $record[ 'base_phone' ]; ?></li>
							
							<!-- Email -->
							<?php // if ( $record[ 'base_email' ] != '' ) { ?>
							<!--li class="mb-3"><strong>Email:</strong> <?php // echo $record[ 'base_email' ]; ?></li-->
							<?php // } ?><!-- /Email -->
							
							<?php /*
								if ( $record[ 'base_gps' ] != 0 ) { ?>
									<li class="mb-3"><a a href="/map.php?base_id=<?php echo $record[ 'base_id' ]; ?>">Показать на карте</a></li>
								<?php }
							?>
							<li><a href="https://астраханские-базы.рф/single-base.php?base_id=<?php echo $record[ 'base_id' ]; ?>">Узнать подробнее</a></li> <?php */ ?>
						</ul>
						<div class="row">
							<div class="col">
								<?php
									if ( $record[ 'base_gps' ] != 0 ) { ?>
										<p><a a href="/map.php?base_id=<?php echo $record[ 'base_id' ]; ?>">Показать на карте</a></p>
									<?php }
								?>
							</div>
							<div class="col">
								<p><a href="https://астраханские-базы.рф/single-base.php?base_id=<?php echo $record[ 'base_id' ]; ?>">Узнать подробнее</a></p>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col">
								<?php
									if ( $record[ 'base_description' ] != '' ) { ?>
										<p class="mb-0"><strong>Описание:</strong>
										<?php // echo $record[ 'base_description' ]; ?>
										<?php echo mb_substr( trim( strip_tags( $record[ 'base_description' ] ) ), 0, 250).'...
										<a href="https://астраханские-базы.рф/single-base.php?base_id='.$record[ 'base_id' ].'">Читать далее</a>'; ?></p>
									<?php }
								?>
								<!--a href="https://астраханские-базы.рф/single-base.php?base_id=<?php echo $record[ 'base_id' ]; ?>">На страницу базы...</a-->
								
							</div>
						</div>
					</div>
				</div>
				<!--div class="row mb-4">
					<div class="col">
						<?php
							if ( $record[ 'base_description' ] != '' ) { ?>
								<p class="mb-2"><strong>Описание:</strong></p>
								<?php // echo $record[ 'base_description' ]; ?>
								<?php echo '<p class="mb-0">'.mb_substr( trim( strip_tags( $record[ 'base_description' ] ) ), 0, 500).'...
								<a href="https://астраханские-базы.рф/single-base.php?base_id='.$record[ 'base_id' ].'">Читать далее</a></p>'; ?>
							<?php }
						?>
						<!--a href="https://астраханские-базы.рф/single-base.php?base_id=<?php echo $record[ 'base_id' ]; ?>">На страницу базы...</a--
					</div>
				</div-->
				<?php
					//if ( $count % 10 == 0 ) { 
					if ( $count == 10 ) {
						
						// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
						//$rand = rand(0, 1);
						$rand = 1;
						
						if ( $rand == 0 ) { ?>
							<section>
								<div class="container pt-5">
									<hr class="m-0 mb-5">
									<div class="row mb-2">
										<div class="col">
											<!-- Yandex.RTB R-A-3743039-2
											<div id="yandex_rtb_R-A-3743039-2-<?php echo $count; ?>"></div>
											<script>
												window.yaContextCb.push(()=>{
													Ya.Context.AdvManager.render({
														"blockId": "R-A-3743039-2-<?php echo $count; ?>",
														"renderTo": "yandex_rtb_R-A-3743039-2-<?php echo $count; ?>"
													})
												});
											</script> -->
										</div>
									</div>
								</div>
							</section>
						<?php } else if ( $rand == 1 ) { ?>
							<section>
								<div class="container pt-5">
									<hr class="m-0 mb-5">
									<div class="row mb-2">
										<div class="col">
											<!-- Yandex.RTB R-A-3743039-2
											<div id="yandex_rtb_R-A-3743039-2-<?php echo $count; ?>"></div>
											<script>
												window.yaContextCb.push(()=>{
													Ya.Context.AdvManager.render({
														"blockId": "R-A-3743039-2",
														"renderTo": "yandex_rtb_R-A-3743039-2-<?php echo $count; ?>",
														"pageNumber": "<?php echo $count; ?>"
													})
												})
											</script> -->
											<!-- Yandex.RTB R-A-10263123-1 -->
											<div id="yandex_rtb_R-A-10263123-1-1"></div>
											<script>
												window.yaContextCb.push(() => {
													Ya.Context.AdvManager.render({
														"blockId": "R-A-10263123-1",
														"renderTo": "yandex_rtb_R-A-10263123-1-1"
													})
												})
											</script>
										</div>
									</div>
								</div>
							</section>
						<?php } else if ( $rand == 2 ) { ?>
									<hr class="m-0 mt-5">
									<div class="row pt-5">
										<div class="col">
											<img src="img/reklama/banner.webp" class="d-none d-md-inline-block img-fluid">
											<img src="img/reklama/banner-mobail.webp" class="d-md-none img-fluid">
										</div>
									</div>
								
						<?php }
					}
				?>
			<?php }
		?>
	</div>
</section>
		
		
<section class="text-center pt-3">
	<div class="container">
		<div class="row">
			<div class="col">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center mb-0">
						<?php if ( $page != 1 ) {
							$prev = $page - 1;
							echo "
								<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$prev\" aria-label=\"Previous\"><span class=\"d-none d-md-inline\">Предыдущие</span><span class=\"d-md-none\" aria-hidden=\"true\">&larr;</span></a></li>
							";
						} else {
							echo '
								<li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span class="d-none d-md-inline">Предыдущие</span><span class="d-md-none" aria-hidden="true">&larr;</span></a></li>
							';
						} ?>
						<!--li class="page-item"><a class="page-link <?php ?>" href="/">1</a></li-->
						<?php
							for ( $i=1; $i <= $page_count; $i++ ) {
								if ( $page == $i ) {
									echo "<li class=\"page-item\"><a class=\"page-link active\" href=\"?page=$i\">$i</a></li>";
								} else {
									echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
								}
							}
						?>
						
						<?php if ( $page < $page_count ) {
							$next = $page + 1;
							echo "
								<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$next\" aria-label=\"Next\"><span class=\"d-none d-md-inline\">Следующие</span><span class=\"d-md-none\" aria-hidden=\"true\">&rarr;</span></a></li>
							";
						} else {
							echo '
								<li class="page-item disabled"><a class="page-link" href="#" aria-label="Next"><span class="d-none d-md-inline">Следующие</span><span class="d-md-none" aria-hidden="true">&rarr;</span></a></li>
							';
						} ?>
					</ul>
				</nav>
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
						<div id="yandex_rtb_R-A-10263123-1-2"></div>
						<script>
							window.yaContextCb.push(() => {
								Ya.Context.AdvManager.render({
									"blockId": "R-A-10263123-1",
									"renderTo": "yandex_rtb_R-A-10263123-1-2"
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
					<div class="col"></div>
				</div>
			</div>
		</section>
	<?php }
?>


<!-- Yandex.RTB R-A-10263123-2 -->
<script>
window.yaContextCb.push(() => {
    Ya.Context.AdvManager.render({
        "blockId": "R-A-10263123-2",
	"type": "fullscreen",
	"platform": "touch"
    })
})
</script>
		
		
<?php include 'footer.php'; ?>