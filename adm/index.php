<?php
/*
	// Делаем запрос к БД
	$result = mysqli_query($connection, "SELECT * FROM `users`");
	$r1 = mysqli_fetch_assoc( $result );
	
	
	// Get base
	$user_id = $r1[ 'user_id' ];
	//echo 'User ID: '.$user_id;
	$resultBase = mysqli_query($connection, "SELECT * FROM `base` WHERE `user_id` = '$user_id'");
	//$recordBase = mysqli_fetch_assoc( $resultBase );
	//print_r($recordBase);
	
	/* Сортировка *
	if ( isset( $_POST[ 'minPrice' ] ) ) {
		// Подключаемся к таблице баз c сортировкой по цене (от меньшей)
		$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price`");
	} else if ( isset( $_POST[ 'maxPrice' ] ) ) {
		// Подключаемся к таблице баз c сортировкой по цене (от большей)
		$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_price` DESC");
	} else if ( isset( $_POST[ 'minRating' ] ) ) {
		// Подключаемся к таблице баз c сортировкой по рейтингу (от меньшего)
		$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating`" );
	} else if ( isset( $_POST[ 'maxRating' ] ) ) {
		// Подключаемся к таблице баз c сортировкой по рейтингу (от большего)
		$result = mysqli_query( $connection, "SELECT * FROM `base` ORDER BY `base_yandex_rating` DESC" );
	} else {
		// Подключаемся к таблице баз c сортировкой по умолчанию (по id)
		$result = mysqli_query($connection, "SELECT * FROM `base` ORDER BY `base_id` DESC");
	}
	
	

		
	// Сохраняем новый логин и пароль
	if (isset($_GET['save'])) {
		$new_login = $_GET['new-login'];
		$new_password = $_GET['new-password'];
		$result = mysqli_query($connection, "UPDATE `users` SET `login` = '$new_login'");
		$result = mysqli_query($connection, "UPDATE `users` SET `password` = '$new_password'");
		$_SESSION['login'] = $r1['login'];
		$_SESSION['password'] = $r1['password'];
	}
	
	/* Add portfolio
	if(isset($_POST['add-furniture'])) {
		$page2 = $_POST['page2'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$title_t = translit($title);
		// Проверяем, есть ли такое название
		$result = mysqli_query($connection, "SELECT COUNT(*) FROM `portfolio` WHERE `title` = '$title'");
		$record = mysqli_fetch_assoc($result);
		if ($record['COUNT(*)'] == 0) {
			// Если нет, то создаем новую папку
			//$dir = mkdir("../img/catalog/$category_t");
			$dir = mkdir("../img/portfolio/$title_t");
			
			foreach ($_FILES['files']['name'] as $key => $value) {
				move_uploaded_file($_FILES['files']['tmp_name'][$key], '../img/portfolio/'.$title_t.'/'.$value);
			}
			$dir1 = 'img/portfolio/'.$title_t;
			$result = mysqli_query($connection, "INSERT INTO `portfolio` (`title`, `description`) VALUES ('$title', '$description');");
			header("Location: index.php?page=$page2");
		} else {
			// Если такое название есть, то просто добавляем фотографии
			$page2 = 'portfolio';
			$title = $_POST['title'];
			foreach ($_FILES['files']['name'] as $key => $value) {
				move_uploaded_file($_FILES['files']['tmp_name'][$key], '../img/portfolio/'.translit($title).'/'.$value);
			}
			header("Location: index.php?page=$page2");
		}
    } *
	
	
	
	/* Удаляем портфолио
	if (isset($_POST['del-portfolio'])) {
		$id = $_POST['id'];
		$title_t = translit($_POST['title']);
		$page2 = $_POST['page2'];
		$result = mysqli_query($connection, "DELETE FROM `portfolio` WHERE id = '$id'");
		rmdir("../img/portfolio/$title_t");
		header("Location: index.php?page=$page2");
	} *
	
	// Добавляем картинки
	if(isset($_POST['add-images'])) {
		$page2 = $_POST['page2'];
		$title = $_POST['title'];
		foreach ($_FILES['files']['name'] as $key => $value) {
			move_uploaded_file($_FILES['files']['tmp_name'][$key], '../img/portfolio/'.translit($title).'/'.$value);
		}
		header("Location: index.php?page=$page2");
    }
	
	//Удаляем картинку
	if (isset($_POST['del-images'])) {
		$page2 = $_POST['page2'];
		$title = $_POST['title'];
		$images = $_POST['images'];
		// Удаляем файл
		unlink($images);
		header("Location: index.php?page=$page2");
	}
	
	// Добавляем статью
	if (isset($_POST['add-article'])) {
		$category = $_POST['category'];
		$title = $_POST['title'];
		$text = $_POST['text'];
		// Присваиваем переменной имя загружаемого файла
		$file = $_FILES['filename']['name'];
		// Загружаем файл на сервер
		move_uploaded_file($_FILES['filename']['tmp_name'], '../img/blog/'.$file);
		$result = mysqli_query($connection, "INSERT INTO  `articles` (`category`,  `title`, `text`, `image`) VALUES ('$category',  '$title',  '$text', '$file');");
		header("Location: index.php?page=blog");
	}
	
	// Редактируем статью
	if (isset($_POST['save-article'])) {
		$page2 = $_POST['page2'];
		$id = $_POST['article_id'];
		$text = $_POST['text'];
		$result = mysqli_query($connection, "UPDATE `articles` SET `text` = '$text' WHERE id='$id'");
		header("Location: index.php?page=$page2");
	}
	
	// Удаляем статью
	if (isset($_POST['del-article'])) {
		$page2 = $_POST['page2'];
		$id = $_POST['article_id'];
		$result = mysqli_query($connection, "DELETE FROM `articles` WHERE id='$id'");
		header("Location: index.php?page=$page2");
	}
	
	// Редактируем комментарий
	if (isset($_POST['save-comment'])) {
		$page2 = $_POST['page2'];
		$id = $_POST['comment_id'];
		$comment = $_POST['comment'];
		$result = mysqli_query($connection, "UPDATE `comments` SET `comment` = '$comment' WHERE id='$id'");
		header("Location: index.php?page=$page2");
	}
	
	// Удаляем комментарий
	if (isset($_POST['del-comment'])) {
		$page2 = $_POST['page2'];
		$id = $_POST['comment_id'];
		$result = mysqli_query($connection, "DELETE FROM `comments` WHERE id='$id'");
		header("Location: index.php?page=$page2");
	}
	
	/*
	if ( ( $_GET['login'] == $r1['login'] and $_GET['password'] == $r1['password'] ) or ( $_SESSION['login'] == $r1['login'] and $_SESSION['password'] == $r1['password'] ) ) { 
		$_SESSION['login'] = $r1['login'];
		$_SESSION['password'] = $r1['password'];
	*/

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
	
	/* Проверяем соединение с БД
	$input_login = 'admin0';
	$result_user_name = mysqli_query( $connection, "SELECT * FROM `users` WHERE `user_login` = '$input_login'" );
	$record_user_name = mysqli_fetch_assoc( $result_user_name );
	print_r( $record_user_name ); */
	
	// Редактируем базу
	if ( isset( $_POST[ 'saveBase' ] ) ) {
		$base_id = $_POST[ 'base_id' ];
		$base_description = $_POST[ 'base_description' ];
		$base_price = $_POST[ 'base_price' ];
		$base_site = $_POST[ 'base_site' ];
		$base_phone = $_POST[ 'base_phone' ];
		
		/*
		$id = $_POST['id'];
		$page2 = $_POST['page2'];
		$old_title = $_POST['old-title'];
		$old_title_t = translit($_POST['old-title']);
		$title = $_POST['title'];
		$title_t = translit($_POST['title']);*/
		
		$result = mysqli_query( $connection, "UPDATE `base` SET `base_description` = '$base_description', `base_price` = '$base_price', `base_site` = '$base_site', `base_phone` = '$base_phone' WHERE base_id = '$base_id'");
		/*
		rename("../img/portfolio/$old_title_t","../img/portfolio/$title_t");*/
		//header("Location: $_SERVER['REQUEST_URI']");
		
	}
	
	// Если нажата кнопка выход
	if ( isset( $_POST['exit'] ) ) {
		unset($_SESSION['login']);
		unset($_SESSION['password']);
	}
	
	
	 // Проверяем существует ли текущий пользователь
	if ( isset( $_SESSION[ 'login' ] ) ) { // Если текущий пользователь существует
		
		// Подгружаем данные текущего пользователя из БД
		$current_user_login = $_SESSION[ 'login' ];
		$result_user_name = mysqli_query( $connection, "SELECT * FROM `users` WHERE `user_login` = '$current_user_login'" );
		$record_user_name = mysqli_fetch_assoc( $result_user_name ); ?>
	
		<!doctype html>
		<html lang="ru">
			<head>
				<!-- Required meta tags -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

				<!-- Bootstrap CSS -->
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
				
				<!-- Summernote CSS/JS -->
				<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
				<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
				<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

				<title>Административная часть сайта</title>
			</head>
			<body>
				
				<section class="pb-5">
					<form method="post">
						<div class="container pt-5">
							<?php
								$user_id = $record_user_name[ 'user_id' ];
								$resultBase = mysqli_query( $connection, "SELECT * FROM `base` WHERE `user_id` = '$user_id'" );
								$pic1 = false;
								while ( $recordBase = mysqli_fetch_assoc( $resultBase ) ) { ?>
									<hr class="m-0 mb-5 mt-5">
									<div class="row pt-2">
										<div class="col-md-8">
											<h2 class="d-md-none mb-3"><?php echo $recordBase[ 'base_name' ]; ?></h2>
											<div id="carousel-<?php echo $recordBase[ 'base_id' ]; ?>" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="9999999999">
												<div class="carousel-inner mb-3 mb-md-0">
													<?php
														$img_dir = '../'.$recordBase[ 'base_image' ];
														if( file_exists($img_dir) ) {
															$img_count = array();
															$d = opendir($img_dir);
															while ($file_name = readdir($d)) {
																if ($file_name == '.' or $file_name == '..' or is_dir($img_dir.'/'.$file_name)) continue;
																$img_count[] = $img_dir.'/'.$file_name;
															} closedir($d);
														} else { echo '404 not found'; }
													
														if (!empty($img_count)) {
															foreach($img_count as $pic) {
																if ($pic1 == false) { echo '
																	<div class="carousel-item active">
																		<img data-src="'.$pic.'" class="d-block w-100 rounded" loading="lazy" alt="'.$recordBase['base_name'].'">
																	</div>
																'; $pic1 = true; } else {
																echo '
																	<div class="carousel-item">
																		<img data-src="'.$pic.'" class="d-block w-100 rounded" loading="lazy" alt="'.$recordBase['base_name'].'">
																	</div>
																'; }
															}
															$pic1 = false;
														}
													?>
												</div>
												<button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $recordBase[ 'base_id' ]; ?>" data-bs-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="visually-hidden">Previous</span>
												</button>
												<button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $recordBase[ 'base_id' ]; ?>" data-bs-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="visually-hidden">Next</span>
												</button>
											</div>
										</div>
										<div class="col-md-4">
											<h2 class="d-none d-md-block mb-3"><?php echo $recordBase[ 'base_name' ]; ?></h2>
											<ul class="" style="padding-left: 0; list-style: none;">
												<?php if ( $recordBase[ 'base_price' ] != 0 ) { ?>
													<li class="mb-3"><strong>Цена:</strong> от <input name="base_price" value="<?php echo $recordBase[ 'base_price' ]; ?>"> руб/чел/сутки</li>
												<?php } ?>
												<li class="mb-3"><strong>Адрес:</strong> <?php echo $recordBase[ 'base_location' ]; ?></li>
												<?php if ( $recordBase[ 'base_gps' ] != '' ) { ?>
													<li class="mb-3"><strong>GPS-координаты:</strong> <?php echo $recordBase[ 'base_gps' ]; ?></li>
												<?php } ?>
												<?php if ( $recordBase[ 'base_site' ] != '' ) { ?>
													<li class="mb-3"><strong>Сайт:</strong> <input name="base_site" value="<?php echo $recordBase[ 'base_site' ]; ?>"></li>
												<?php } ?>
												
												<li class="mb-3"><strong>Телефон:</strong> <input name="base_phone" value="<?php echo $recordBase[ 'base_phone' ]; ?>"></li>
												
												<?php
													if ( $recordBase[ 'base_yandex_id' ] != 0 ) { ?>
														<li class="mb-3"><strong>Рейтинг в Яндексе:</strong> <?php echo $recordBase[ 'base_yandex_rating' ]; ?></li>
														<li class="mb-3"><strong>Количество отзывов:</strong> <span id="review-<?php echo $recordBase[ 'base_id' ]; ?>"></span> <a href="<?php echo 'https://yandex.ru/profile/'.$recordBase[ 'base_yandex_id' ]; ?>" target="blank">Читать</a></li>
													<?php }
												?>
											</ul>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<?php
												//if ( $recordBase[ 'base_description' ] != '' ) { ?>
													<p class="mb-2"><strong>Описание:</strong></p>
													<textarea id="summernote" name="base_description">
														<?php echo $recordBase[ 'base_description' ]; ?>
													</textarea>
												<?php //}
											?>
											<script>
												$('#summernote').summernote({
													placeholder: 'Описание',
													tabsize: 2,
													height: 200,
													fontNames: ['HelveticaNeueCyr-Light'], // Делаем нужный шрифт
													fontNamesIgnoreCheck: ['HelveticaNeueCyr-Light'] // Делаем нужный шрифт
												});
											</script>
										</div>
									</div>
									<input type="hidden" name="base_id" value="<?php echo $recordBase[ 'base_id' ]; ?>">
									<button type="submit" name="saveBase" class="btn btn-success">Сохранить</button>
									<button type="submit" name="exit" class="btn btn-primary">Выйти</button>
								<?php }
							?>
						</div>
					</form>
				</section>
			</body>
		</html>
		
	<!-- Если текущего пользователя не существует -->
	<?php } else if ( isset( $_POST[ 'login' ] ) ) { // Проверяем есть ли пользователь с введенным логином
		$input_login = $_POST[ 'login' ];
		$result_user_name = mysqli_query( $connection, "SELECT * FROM `users` WHERE `user_login` = '$input_login'" );
		$record_user_name = mysqli_fetch_assoc( $result_user_name );	
		if ( isset( $record_user_name[ 'user_login' ] ) ) {
			//echo 'Пользователь с таким логином существует!<br>';
			
			// Проверяем пароль
			$input_password = $_POST[ 'password' ]; // Получаем пароль из формы и вносим в переменную
			$user_password = $record_user_name[ 'user_password' ]; // Получаем пароль из БД
			if ( $user_password === $input_password ) { // Сравниваем пароль из БД и переменной
				//echo 'Пароль из формы: '.$input_password.'<br>';
				//echo 'Пароль из БД: '.$user_password.'<br>';
				//echo 'Пароль правильный!<br>'; // Если пароли совпадают
				//echo 'Выводим базы принадлежащие этому пользователю.<br>';
				// Записываем login и password пользователя в сессию
				$_SESSION[ 'login' ] = $input_login;
				$_SESSION[ 'password' ] = $input_password;
				//echo 'Логин из сессии: '.$_SESSION[ 'login' ].'<br>';
				//echo 'Пароль из сессии: '.$_SESSION[ 'password' ].'<br>'; ?>
				<!doctype html>
				<html lang="ru">
					<head>
						<!-- Required meta tags -->
						<meta charset="utf-8">
						<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

						<!-- Bootstrap CSS -->
						<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
						
						<!-- Summernote CSS/JS -->
						<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
						<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
						<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

						<title>Административная часть сайта</title>
					</head>
					<body>
						
						<section class="pb-5">
							<form method="post">
								<div class="container pt-5">
									<?php
										$user_id = $record_user_name[ 'user_id' ];
										$resultBase = mysqli_query( $connection, "SELECT * FROM `base` WHERE `user_id` = '$user_id'" );
										$pic1 = false;
										while ( $recordBase = mysqli_fetch_assoc( $resultBase ) ) { ?>
											<hr class="m-0 mb-5 mt-5">
											<div class="row pt-2">
												<div class="col-md-8">
													<h2 class="d-md-none mb-3"><?php echo $recordBase[ 'base_name' ]; ?></h2>
													<div id="carousel-<?php echo $recordBase[ 'base_id' ]; ?>" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="9999999999">
														<div class="carousel-inner mb-3 mb-md-0">
															<?php
																$img_dir = '../'.$recordBase[ 'base_image' ];
																if( file_exists($img_dir) ) {
																	$img_count = array();
																	$d = opendir($img_dir);
																	while ($file_name = readdir($d)) {
																		if ($file_name == '.' or $file_name == '..' or is_dir($img_dir.'/'.$file_name)) continue;
																		$img_count[] = $img_dir.'/'.$file_name;
																	} closedir($d);
																} else { echo '404 not found'; }
															
																if (!empty($img_count)) {
																	foreach($img_count as $pic) {
																		if ($pic1 == false) { echo '
																			<div class="carousel-item active">
																				<img data-src="'.$pic.'" class="d-block w-100 rounded" loading="lazy" alt="'.$recordBase['title'].'">
																			</div>
																		'; $pic1 = true; } else {
																		echo '
																			<div class="carousel-item">
																				<img data-src="'.$pic.'" class="d-block w-100 rounded" loading="lazy" alt="'.$recordBase['title'].'">
																			</div>
																		'; }
																	}
																	$pic1 = false;
																}
															?>
														</div>
														<button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $recordBase[ 'base_id' ]; ?>" data-bs-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="visually-hidden">Previous</span>
														</button>
														<button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $recordBase[ 'base_id' ]; ?>" data-bs-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="visually-hidden">Next</span>
														</button>
													</div>
												</div>
												<div class="col-md-4">
													<h2 class="d-none d-md-block mb-3"><?php echo $recordBase[ 'base_name' ]; ?></h2>
													<ul class="" style="padding-left: 0; list-style: none;">
														<?php if ( $recordBase[ 'base_price' ] != 0 ) { ?>
															<li class="mb-3"><strong>Цена:</strong> от <input name="base_price" value="<?php echo $recordBase[ 'base_price' ]; ?>"> руб/чел/сутки</li>
														<?php } ?>
														<li class="mb-3"><strong>Адрес:</strong> <?php echo $recordBase[ 'base_location' ]; ?></li>
														<?php if ( $recordBase[ 'base_gps' ] != '' ) { ?>
															<li class="mb-3"><strong>GPS-координаты:</strong> <?php echo $recordBase[ 'base_gps' ]; ?></li>
														<?php } ?>
														<?php if ( $recordBase[ 'base_site' ] != '' ) { ?>
															<li class="mb-3"><strong>Сайт:</strong> <a href="http://<?php echo $recordBase[ 'base_site' ]; ?>" target="blank"><?php echo $recordBase[ 'base_site' ]; ?></a></li>
														<?php } ?>
														<li class="mb-3"><strong>Телефон:</strong> <?php echo $recordBase[ 'base_phone' ]; ?></li>
														<?php
															if ( $recordBase[ 'base_yandex_id' ] != 0 ) { ?>
																<li class="mb-3"><strong>Рейтинг в Яндексе:</strong> <?php echo $recordBase[ 'base_yandex_rating' ]; ?></li>
																<li class="mb-3"><strong>Количество отзывов:</strong> <span id="review-<?php echo $recordBase[ 'base_id' ]; ?>"></span> <a href="<?php echo 'https://yandex.ru/profile/'.$recordBase[ 'base_yandex_id' ]; ?>" target="blank">Читать</a></li>
															<?php }
														?>
													</ul>
												</div>
											</div>
											<div class="row mb-4">
												<div class="col">
													<?php
														//if ( $recordBase[ 'base_description' ] != '' ) { ?>
															<p class="mb-2"><strong>Описание:</strong></p>
															<textarea id="summernote" name="base_description">
																<?php echo $recordBase[ 'base_description' ]; ?>
															</textarea>
														<?php //}
													?>
													<script>
														$('#summernote').summernote({
															placeholder: 'Описание',
															tabsize: 2,
															height: 200
														});
													</script>
												</div>
											</div>
											<input type="hidden" name="base_id" value="<?php echo $recordBase[ 'base_id' ]; ?>">
											<button type="submit" name="saveBase" class="btn btn-success">Сохранить</button>
											<button type="submit" name="exit" class="btn btn-primary">Выйти</button>
										<?php }
									?>
								</div>
							</form>
						</section>
					</body>
				</html>
				
			<?php } else { ?>
				
				<!-- Пароль НЕ правильный! -->
				<!doctype html>
				<html lang="ru">
				<head>
					<!-- Required meta tags -->
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

					<!-- Bootstrap CSS -->
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

					<!-- My CSS -->
					<link rel="stylesheet" href="style.css">
					<title>Административная часть сайта</title>
				</head>
				<body
				<!-- Вход -->
				<div class="container">
					<div class="row align-items-center" style="height: 100vh;">
						<div class="col">
							<p class="text-center text-danger">Пароль НЕ правильный!</p>
							<form action="" method="post" style="border: 1px solid lightgrey; padding: 15px; border-radius: 5px; max-width: 250px; margin: auto;">
								<input type="text" class="form-control" name="login" placeholder="Введите логин" style="margin-bottom: 15px;">
								<input type="password" class="form-control" name="password" placeholder="Введите  пароль" style="margin-bottom: 15px;">
								<button type="submit" class="btn btn-danger" style="display: block; margin: auto;">Войти</button>
							</form>
						</div>
					</div>
				</div>
			<?php }
			
		} else { ?>
			
			<!-- Пользователя с таким логином НЕ существует! -->
			<!doctype html>
			<html lang="ru">
				<head>
					<!-- Required meta tags -->
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

					<!-- Bootstrap CSS -->
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

					<!-- My CSS -->
					<link rel="stylesheet" href="style.css">
					<title>Административная часть сайта</title>
				</head>
				<body
				<!-- Вход -->
				<div class="container">
					<div class="row align-items-center" style="height: 100vh;">
						<div class="col">
							<p class="text-center text-danger">Пользователя с таким логином НЕ существует!</p>
							<form action="" method="post" style="border: 1px solid lightgrey; padding: 15px; border-radius: 5px; max-width: 250px; margin: auto;">
								<input type="text" class="form-control" name="login" placeholder="Введите логин" style="margin-bottom: 15px;">
								<input type="password" class="form-control" name="password" placeholder="Введите  пароль" style="margin-bottom: 15px;">
								<button type="submit" class="btn btn-danger" style="display: block; margin: auto;">Войти</button>
							</form>
						</div>
					</div>
				</div>
		<?php }
	} else {
		/*
		echo 'Страница входа.';
		echo '<form method="post">';
		echo '<input name="login">';
		echo '<input name="password">';
		echo '<button type="submit">Вход</button>';
		echo '</form>'; */
	?>
		
		<!-- Страница входа -->
		<!doctype html>
			<html lang="ru">
			<head>
				<!-- Required meta tags -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

				<!-- Bootstrap CSS -->
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

				<!-- My CSS -->
				<link rel="stylesheet" href="style.css">
				<title>Административная часть сайта</title>
			</head>
			<body
			<!-- Вход -->
			<div class="container">
				<div class="row align-items-center" style="height: 100vh;">
					<div class="col">
						<p class="text-center text-danger"><!-- Страница входа. --></p>
						<form action="" method="post" style="border: 1px solid lightgrey; padding: 15px; border-radius: 5px; max-width: 250px; margin: auto;">
							<input type="text" class="form-control" name="login" placeholder="Введите логин" style="margin-bottom: 15px;">
							<input type="password" class="form-control" name="password" placeholder="Введите  пароль" style="margin-bottom: 15px;">
							<button type="submit" class="btn btn-danger" style="display: block; margin: auto;">Войти</button>
						</form>
					</div>
				</div>
			</div>
	<?php }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
		
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

</body>
</html>