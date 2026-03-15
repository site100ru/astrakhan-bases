<?php
include 'config.php';

// Подключение к БД
$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Делаем правильную кодировку
mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($connection, "SET CHARACTER SET 'utf8'");

/* Получаем id базы */
$base_id = isset($_GET['base_id']);

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
if (isset($_POST['baseYandexId'])) {
    $base_yandex_id = $_POST['baseYandexId'];
    $base_yandex_rating = $_POST['baseYandexRating'];
    $base_yandex_gps_x = $_POST['baseYandexGpsX'];
    $base_yandex_gps_y = $_POST['baseYandexGpsY'];
    $base_yandex_gps = $base_yandex_gps_x . ',' . $base_yandex_gps_y;
    $result = mysqli_query($connection, "UPDATE `base` SET `base_yandex_rating` = '$base_yandex_rating', `base_gps` = '$base_yandex_gps' WHERE `base_yandex_id` = '$base_yandex_id'");
}

//Формируем title
//$result = mysqli_query($connection, "SELECT * FROM `base` WHERE `base_id` = $base_id");
//$record = mysqli_fetch_assoc( $result );
//$title = strip_tags( $record[ 'base_name' ] );

// Определяем какой рекламный блок будем показывать, для теста проведения теста, какой рекламный блок выгоднее
$rand = rand(0, 1);

?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Предложение рекламодателям по размещению информации на сайте астраханские-базы.рф" />
    <meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2026, году" />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Рыболовные базы в Астраханской области цены в 2026 году" />
    <meta property="og:title" content="Рыболовные базы в Астраханской области цены в 2026 году - <?php echo $title; ?>" />
    <meta property="og:description" content="Предложение рекламодателям по размещению информации на сайте астраханские-базы.рф" />
    <!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
    <!-- Yandex.Webmaster -->
    <meta name="yandex-verification" content="70fe58b7e11a9545" />


    <title>Рыболовные базы в Астраханской области цены в 2026 году - Предложение рекламодателям</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="css/theme.css" rel="stylesheet">
    <link rel="icon" href="https://xn----7sbaabf0atet6a7amek4c2g.xn--p1ai/favicon.ico" type="image/x-icon">

    <!-- Yandex.RTB -->
    <script>
        window.yaContextCb = window.yaContextCb || []
    </script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        // Удаляем сообщение об обновлении данных формы после отправки
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
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
                        <a href="/archive-articles.php" class="nav-link active">Рыбалка в астрахани</a>
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

    <!-- Home -->
    <div id="home-sp" class="scroll-point"></div>
    <header class="home-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="home-title">Рыбалка в астрахани</h1>
                    <h2 class="home-subtitle me-md-5">Куда поехать, лучшие места для рыбалки, стоимость проживания в 2026 году</h2>
                    <h3 class="home-description">Мы собрали для Вас полезную информацию о рыбалке и отдыхе в Астраханской области</h3>
                </div>
            </div>
        </div>
    </header>
    <!-- /Home -->


    <section>
        <div class="container">
            <div class="row">
                <div class="col py-5">
                    <h2>Предложение рекламодателям</h2>
                    <h3>Размещение рекламного баннера на сайте:</h3>
                    <ul>
                        <li>На первом месте, на главной странице + на странице с картой баз + на странице конкретной базы — 2500 руб/мес.</li>
                        <li>На втором месте, на главной странице + на странице с картой баз + на странице конкретной базы — 1000 руб/мес.</li>
                        <li>На третьем месте, на главной странице — 500 руб/мес.</li>
                    </ul>

                    <p>Размеры баннера — ширина не боле 1410 пикселей, высота не более 300 пикселей.</p>

                    <p>Разработка баннера в одном из форматов (горизонтальный — для ПК, и вертикальный — для мобильного) — 500 руб.</p>

                    <div class="row">
                        <div class="col">
                            <div id="carouselExampleCaptions" class="carousel carousel-dark slide mb-3">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>

                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>

                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-1-1.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-1-2.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-1-3.jpg" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Third slide label</h5>
                                            <p>Some representative placeholder content for the third slide.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-2-1.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-2-2.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-3-1.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://астраханские-базы.рф/img/reklama/reklama-3-2.jpg" class="d-block w-100" alt="...">
                                        <!--div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div-->
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <h3>Рассмотрим и другие варианты сотрудничества по Вашему предложению.</h3>

                    <h3>Другие услуги:</h3>
                    <ul>
                        <li>Максимально полное наполнение информацией страницы базы на сайте астраханские-базы.рф — от 500 руб.</li>
                        <li>Разработка сайта базы — от 15 000 руб.</li>
                        <li>Настройка контекстной рекламы для сайта базы — от 15 000 руб.</li>
                        <li>СЕО-продвижение сайта базы — от 5 000 руб.</li>
                        <li>Поддержка сайта базы — от 1 000 руб.</li>
                    </ul>

                    <p>При заинтересованности обращайтесь на адрес электронной почты: <a href="mailto:vasilyev-r@mail.ru">vasilyev-r@mail.ru</a></p>

                    <h3>Статистика сайта:</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-1">Посещаемость сайта</h5>
                            <a href="https://астраханские-базы.рф/kolichestvo-posetiteley.pdf" target="blank">
                                <p class="mb-4">Cредняя посещаемость сайта 125 человек в сутки.</p>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">География посетителей</h5>
                            <a href="https://астраханские-базы.рф/geografiya-posetiteley.pdf" target="blank">
                                <p class="mb-4">32% посетителей из Москвы.</p>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">Возраст посетителей</h5>
                            <a href="https://астраханские-базы.рф/vozrast-posetiteley.pdf" target="blank">
                                <p class="mb-4">60% посетителей в возрасте от 35 до 55 лет.</p>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">Поисковые запросы</h5>
                            <a href="https://астраханские-базы.рф/poiskovye-frazy.pdf" target="blank">
                                <p class="mb-4">По каким запросам нас находят.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
                                                <a href="/" class="nav-link" aria-current="page">Рыболовные базы</a>
                                            </li>
                                            <li class="nav-item d-none d-xl-inline">
                                                <span class="nav-link px-2">
                                                    <img src="/img/ico/menu-point.svg">
                                                </span>
                                            </li>
                                            <li class="menu-item nav-item">
                                                <a href="/map.php" class="nav-link">Базы на карте</a>
                                            </li>
                                            <li class="nav-item d-none d-xl-inline">
                                                <span class="nav-link px-2">
                                                    <img src="/img/ico/menu-point.svg">
                                                </span>
                                            </li>
                                            <li class="menu-item nav-item">
                                                <a href="/archive-articles.php" class="nav-link active">Рыбалка в Астрахани</a>
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
                                <p class="footer-text">Мы регулярно ищем и добавляем на сайт полезную информацию о рыбалке в Астрахани. Посещайте наш сайт регулярно, если Вас интересует тема отдыха и рыбалки в Астраханской области. Добавьте сайт в закладки, чтобы не потерять его и всегда иметь возможность быстро перейти к интересующей Вас информации (нажмите одновременно Ctrl+D).</p>
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
                                <a href="/offer.php" class="contact-link ps-0" aria-current="page">Реклама на сайте</a>
                            </div>
                            <div class="col-12 mb-1 ">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal" class="contact-link ps-0" aria-current="page">Написать нам</a>
                            </div>
                            <div class="col-12 mb-2 ">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addBaseModal" class="contact-link ps-0" aria-current="page">Добавить базу</a>
                            </div>
                            <div class="col">
                                <a href="/adm" class="btn btn-outline-success mobile-btn" type="button">Войти</a>
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
                    <a class="footer-text-link link-offset-1" href="/offer.php">Реклама на сайте</a>
                    <span class="footer-text-divider">|</span>
                    <a class="footer-text-link link-offset-1" data-bs-toggle="modal" data-bs-target="#messageModal" href="#"> Написать нам</a>
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
                        <div class="footer-text">©<?php echo date('Y'); ?>г. | <a href="https://астраханские-базы.рф" class="footer-text-link link-offset-3 text-decoration-none">астраханские-базы.рф</a></div>
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
							<button type="submit" class="btn btn-primary">Добавить</button>
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
		
		
		<!-- Bootstrap -->
		<script src="/js/bootstrap.bundle.min.js"></script>
				
		
		<!-- Загрузка изображений с приоритетом -->
		<script>
			if ('loading' in HTMLImageElement.prototype) {
				const images = document.querySelectorAll('img[loading="lazy"]');
				images.forEach(img => {
					img.src = img.dataset.src;
				});
			} else {
				// Dynamically import the LazySizes library
				const script = document.createElement('script');
				script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.8/lazysizes.min.js';
				document.body.appendChild(script);
			}
		</script>

		
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