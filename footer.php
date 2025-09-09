		<footer class="bg-dark">
			<div class="container">
				<div class="row">
					<div class="col text-center text-light">
						<p class="pt-3 footer-text">Мы регулярно ищем и добавляем на сайт полезную информацию о рыбалке в Астрахани. Посещайте наш сайт регулярно, если Вас интересует тема отдыха и рыбалки в Астраханской области. Добавьте сайт в закладки, чтобы не потерять его и всегда иметь возможность быстро перейти к интересующей Вас информации (нажмите одновременно <strong>Ctrl+D</strong>).</p>
						<a class="ico-button pe-2" href="https://vk.com/public219332964" target="_blank"><img src="https://астраханские-базы.рф/img/ico/vk-ico.svg"></a>
						<hr>
						<p class="mb-0">
							<span class="nav-link d-inline footer-text-link" style="cursor: pointer; text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#addBaseModal">Добавить базу</span> | 
							<a href="https://астраханские-базы.рф/offer.php" class="footer-text-link nav-link d-inline" style="cursor: pointer; text-decoration: underline;">Реклама на сайте</a> | 
							<span class="footer-text-link nav-link d-inline" style="cursor: pointer; text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#messageModal">Написать нам</span>
						</p>
						<p class="mb-0 pb-3"><a href="https://астраханские-базы.рф" class="text-light">астраханские-базы.рф</a> <br>©<?php echo date( 'Y' ); ?>г.</p>
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
					<form method="post" action="mls/message_mls.php">
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
		
		
		<!-- API Yandex Map -->
		<script src="https://api-maps.yandex.ru/2.1/?apikey=7a322092-0e89-4de6-8bff-0a1795b5548e&lang=ru_RU" type="text/javascript"></script>
		<!--script src="https://api-maps.yandex.ru/2.1/?apikey=c3ca6a87-a04e-40f7-bc1e-0ac24b061447&lang=ru_RU" type="text/javascript"></script-->
		<script type="text/javascript">
			ymaps.ready(init);
			function init() {	
				
				<!-- Принимаем данные из API Yandex Map и записываем в БД -->
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
				
				
				<!-- API Yandex Map -->
				/* Создание карты. */
				var myMap = new ymaps.Map("map", {
					// Координаты центра карты.
					// Порядок по умолчанию: «широта, долгота».
					// Чтобы не определять координаты центра карты вручную,
					// воспользуйтесь инструментом Определение координат.
					//center: [46.00019944028397,48.10419827900901],
					<?php
						if ( isset( $_GET[ 'base_id' ] ) ) {
							$base_id = $_GET[ 'base_id' ];
							$result4 = mysqli_query($connection, "SELECT * FROM `base` WHERE `base_id` = '$base_id'");
							$record4 = mysqli_fetch_assoc( $result4 );
							$base_gps = $record4[ 'base_gps' ];
							echo 'center: ['.$base_gps.'],';
						} else {
							echo 'center: [46.00019944028397,48.10419827900901],';
						}
					?>
					// Уровень масштабирования. Допустимые значения:
					// от 0 (весь мир) до 19.
					zoom: 9
				});
				
				/**/
				myMap.geoObjects
				<?php
					if ( isset( $_GET[ 'base_id' ] ) ) {
						$base_id = $_GET[ 'base_id' ];
					} else {
						$base_id = '';
					}
					$result3 = mysqli_query($connection, "SELECT * FROM `base`");
					while ( $record3 = mysqli_fetch_assoc( $result3 ) ) {
						if ( $record3[ 'base_gps' ] != 0 ) { ?>
							.add(new ymaps.Placemark( [<?php echo $record3[ 'base_gps' ]; ?>], {  iconContent: '<?php if ( $base_id == $record3[ 'base_id' ] ) { echo 'Я здесь '; } echo $record3[ 'base_price' ]; ?>',
								balloonContentHeader: '<div style="max-width: 250px;"><?php echo $record3[ 'base_name' ]; ?></div>',
								balloonContentBody:	'<div id="carousel-<?php echo $record3[ 'base_id' ]; ?>" class="carousel slide mb-2" data-bs-ride="carousel" data-bs-interval="9999999999" style="max-width: 250px;">'+
									'<div class="carousel-inner mb-3 mb-md-0">'+
										<?php
											$img_dir = $record3[ 'base_image' ];
											if( file_exists($img_dir) ) {
												$img_count = array();
												$d = opendir($img_dir);
												while ($file_name = readdir($d)) {
													if ($file_name == '.' or $file_name == '..' or is_dir($img_dir.'/'.$file_name)) continue;
													$img_count[] = $img_dir.'/'.$file_name;
												} closedir($d);
											}
										
											if (!empty($img_count)) {
												$pic = false;
												foreach($img_count as $pic1) {
													if ( $pic == false ) { ?>
														'<div class="carousel-item active">'+
															'<img src="https://астраханские-базы.рф/<?php echo $pic1; ?>" class="d-block w-100 rounded" alt="<?php echo isset( $record3['title'] ); ?>">'+
														'</div>'+
													<?php $pic = true; } else { ?>
														'<div class="carousel-item">'+
															'<img src="https://астраханские-базы.рф/<?php echo $pic1; ?>" class="d-block w-100 rounded" alt="<?php echo isset( $record3['title'] ); ?>">'+
														'</div>'+
													<?php }
												}
												$pic = false;
											} 
										?>
									'</div>'+
									'<button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $record3[ 'base_id' ]; ?>" data-bs-slide="prev">'+
										'<span class="carousel-control-prev-icon" aria-hidden="true"></span>'+
										'<span class="visually-hidden">Previous</span>'+
									'</button>'+
									'<button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $record3[ 'base_id' ]; ?>" data-bs-slide="next">'+
										'<span class="carousel-control-next-icon" aria-hidden="true"></span>'+
										'<span class="visually-hidden">Next</span>'+
									'</button>'+
								'</div>'+
								'Цена: от <?php echo $record3[ 'base_price' ]; ?> руб/чел/сутки<br>'+
								'Сайт: <a href="<?php echo $record3[ 'base_site' ]; ?>"><?php echo $record3[ 'base_site' ]; ?></a><br>'+
								'Телефон: <?php echo $record3[ 'base_phone' ]; ?><br>'+
								'Рейтинг в Яндексе: <?php echo $record3[ 'base_yandex_rating' ]; ?> '+
								'<a href="<?php echo 'https://yandex.ru/profile/'.$record3[ 'base_yandex_id' ]; ?>" target="blank">Читать отзывы</a><br>'+
								'<a href="https://астраханские-базы.рф/single-base.php?base_id=<?php echo $record3[ 'base_id' ]; ?>">На страницу базы</a>',
								hintContent: '<?php echo $record3[ 'base_name' ]; ?>'

								/*
								balloonContent: '<?php echo $record3[ 'base_name' ]; ?><br>Цена: от <?php echo $record3[ 'base_price' ]; ?> руб/чел/сутки<br>Рейтинг в Яндексе: <?php echo $record3[ 'base_yandex_rating' ]; ?>'
								*/
								
							} <?php if ( $base_id == $record3[ 'base_id' ] ) { echo ',{ preset: \'islands#redStretchyIcon\', zIndex: 999 }'; } else { echo ", { preset: 'islands#blueStretchyIcon' }"; } ?> ))
						<?php }
					};
				?>	
			} // End function init()
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
		
		
		<!-- Yandex.RTB R-A-3743039-1 -->
		<!-- Полноэкранный баннер
		<script>
			window.yaContextCb.push(()=>{
				Ya.Context.AdvManager.render({
					"blockId": "R-A-3743039-1",
					"type": "fullscreen",
					"platform": "touch"
				})
			})
		</script> -->
		
		
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