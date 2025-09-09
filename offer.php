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
	$base_id = isset( $_GET[ 'base_id' ] );
	
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
		<meta name="keywords" content="Рыболовные, рыбалка, базы, отдыха, астрахань, астраханская, область, низовья, волги, дельта, каспийские, раскаты, цены, 2025, году" />
		<meta property="og:locale" content="ru_RU" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="Рыболовные базы в Астраханской области цены в 2025 году" />
		<meta property="og:title" content="Рыболовные базы в Астраханской области цены в 2025 году - <?php echo $title; ?>" />
		<meta property="og:description" content="Предложение рекламодателям по размещению информации на сайте астраханские-базы.рф" />
		<!--
		<meta property="og:image" content="https://site100.ru/img/review.jpg" />
		<meta property="og:url" content="https://site100.ru/index.php" />
		-->
		<!-- Yandex.Webmaster -->
		<meta name="yandex-verification" content="70fe58b7e11a9545" />
		
		
		<title>Рыболовные базы в Астраханской области цены в 2025 году - Предложение рекламодателям</title>
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
	
	
		<nav class="navbar navbar-expand-lg bg-white">
			<div class="container">
				<a class="navbar-brand" href="https://астраханские-базы.рф">
					<img src="img/ico/logo.png" style="max-width: 40px; margin-right: 8px;">
					астраханские-базы.рф
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse pb-3 pb-md-0" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="/">Список баз</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  href="map.php">Базы на карте</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  href="single-article.php">О рыбалке в Астрахани</a>
						</li>
					</ul>
					<ul class="navbar-nav mb-3 mb-md-0">
						<li class="nav-item">
							<span class="nav-link pb-0 pb-md-2 me-0 me-md-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addBaseModal">Добавить базу</span>
						</li>
					</ul>
					<a href="/adm" type="button" class="btn btn-danger">Войти</a>	
				</div>
			</div>
		</nav>

		
		<header style="background: url(img/header-bg.webp) center; padding-top: 50px; padding-bottom: 50px;">
			<div class="container">
				<div class="row">
					<div class="col text-light">
						<h1>Рыболовные базы в Астраханской области цены в 2025 году</h1>
						<h2>Рыбалка, охота и отдых в дельте реки Волги</h2>
						<h3 class="mb-0 fw-light fs-4">Предложение рекламодателям<h3>
					</div>
				</div>
			</div>
		</header>
		
		
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
						
						<p>Размеры баннера —  ширина не боле 1410 пикселей, высота не более 300 пикселей.</p>

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
								<a href="https://астраханские-базы.рф/kolichestvo-posetiteley.pdf" target="blank"><p class="mb-4">Cредняя посещаемость сайта 125 человек в сутки.</p></a>
							</div>
							<div class="col-md-6">
								<h5 class="mb-1">География посетителей</h5>
								<a href="https://астраханские-базы.рф/geografiya-posetiteley.pdf" target="blank"><p class="mb-4">32% посетителей из Москвы.</p></a>
							</div>
							<div class="col-md-6">
								<h5 class="mb-1">Возраст посетителей</h5>
								<a href="https://астраханские-базы.рф/vozrast-posetiteley.pdf" target="blank"><p class="mb-4">60% посетителей в возрасте от 35 до 55 лет.</p></a>
							</div>
							<div class="col-md-6">
								<h5 class="mb-1">Поисковые запросы</h5>
								<a href="https://астраханские-базы.рф/poiskovye-frazy.pdf" target="blank"><p class="mb-4">По каким запросам нас находят.</p></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
		<footer class="bg-dark">
			<div class="container">
				<div class="row">
					<div class="col text-center text-light">
						<p class="pt-3">Мы регулярно ищем и добавляем на сайт полезную информацию о рыбалке в Астрахани. Посещайте наш сайт регулярно, если Вас интересует тема отдыха и рыбалки в Астраханской области. Добавьте сайт в закладки, чтобы не потерять его и всегда иметь возможность быстро перейти к интересующей Вас информации (нажмите одновременно <strong>Ctrl+D</strong>).</p>
						<a class="ico-button pe-2" href="https://vk.com/public219332964" target="_blank"><img src="https://астраханские-базы.рф/img/ico/vk-ico.svg"></a>
						<hr>
						<p class="mb-0">
							<span class="nav-link d-inline" style="cursor: pointer; text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#addBaseModal">Добавить базу</span> | 
							<a href="https://астраханские-базы.рф/offer.php" class="nav-link d-inline" style="cursor: pointer; text-decoration: underline;">Реклама на сайте</a> | 
							<span class="nav-link d-inline" style="cursor: pointer; text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#messageModal">Написать нам</span>
						</p>
						<p class="mb-0 pb-3"><a href="https://астраханские-базы.рф" class="text-light">астраханские-базы.рф</a> <br>©2023г.</p>
					</div>
				</div>
			</div>
		</footer>
		

		<!-- Add Base Modal -->
		<div class="modal fade" id="addBaseModal" tabindex="-1" aria-labelledby="addBaseModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="mls/add_base_mls.php">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="addBaseModalLabel">Добавить базу</h1>
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
					<form method="post" action="mls/message_mls.php">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="messageModalLabel">Напишите Ваше сообщение</h1>
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
		<script src="js/bootstrap.bundle.min.js"></script>
		
		
		<!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
               m[i].l=1*new Date();
               for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
              k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
               (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        
           ym(90515560, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
              });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/90515560" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
		
		
		<!-- Принимаем данные из API Yandex Map и записываем в БД -->
		<!-- API Yandex Map -->
		<script src="https://api-maps.yandex.ru/2.1/?apikey=7a322092-0e89-4de6-8bff-0a1795b5548e&lang=ru_RU" type="text/javascript"></script>
		<script type="text/javascript">
			ymaps.ready(init);
			function init() {
				<?php
					$result2 = mysqli_query($connection, "SELECT * FROM `base`");
					while ( $record2 = mysqli_fetch_assoc( $result2 ) ) { ?>
						ymaps.findOrganization( '<?php echo $record2[ 'base_yandex_id' ]; ?>' ).then(
							function (orgGeoObject) {
								//console.log(yandex_id);
								console.log(orgGeoObject);
								
								// Получаем количество отзывов из API Yandex Map
								document.getElementById( 'review-<?php echo $record2[ 'base_id' ]; ?>' ).innerHTML = orgGeoObject.properties._data.rating.reviews;
								var reviews = orgGeoObject.properties._data.rating.reviews;
								
								// Записываем id и рейтинг организации в Yandex Map в переменные
								var baseYandexId = <?php echo $record2[ 'base_yandex_id' ]; ?>;
								var baseYandexRating = orgGeoObject.properties._data.rating.score;
								var baseYandexGpsX = orgGeoObject.properties._data.point[1];
								var baseYandexGpsY = orgGeoObject.properties._data.point[0];
								
								
								// Отправляем данные в обработчик
								$.ajax({
									type: 'POST',         // Задаем метод передачи
									url: 'index.php', // URL для передачи параметра
									data: { baseYandexId, baseYandexRating, baseYandexGpsX, baseYandexGpsY }
								});
							}
						)
					<?php }
				?>
			}
		</script>
		
		
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
