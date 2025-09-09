<?php
	session_start();
	$win = "true";
	// Если существует переменная POST, то
	
	/* */
	if ( $_POST ) {
		// Отправляем данные в Google
		function getCaptcha( $SecretKey ) {
			$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdV1IcUAAAAABnQ0mXIp5Yh7tLEcAXzdqG6rx9Y&response={$SecretKey}");
			$Return = json_decode($Response);
			return $Return;
		}
		
		/* Принимаем данные обратно */
		$Return = getCaptcha($_POST['g-recaptcha-response']);
		// Если вероятность робота более 0.5, то считаем отправителя человеком и выполняем отправку почты
		if( $Return->success == true && $Return->score > 1 ) {
			
			$name = $_POST[ 'name' ];
			$email = $_POST[ 'email' ];
			$mes = $_POST[ 'mes' ];
			mail( "", "Сообщение с сайта астраханские-базы.рф!", "
				Имя: " . $name ."\n
				Email: " . $email ."\n
				Сообщение: " . $mes
			); 	
			$_SESSION['win'] = 1;
			$_SESSION['recaptcha'] = '<p class="text-light">Спасибо, что Вы обратились именно к нам. Мы свяжемся с Вами в ближайшее время.</p>';
			header("Location: ".$_SERVER['HTTP_REFERER']);
		
		} else {
			// Иначе считаем отправителя роботом и выводим сообщение с просьбой повторить попытку
			$_SESSION['win'] = 1;
			$_SESSION['recaptcha'] = '<p class="text-light"><strong>Извините!</strong><br>Ваши действия похожи на робота. Пожалуйста повторите попытку!</p>';
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}
?>