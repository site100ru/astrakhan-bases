<?php
session_start();

// Если данные были отправлены через POST
if ($_POST) {

    // Функция проверки капчи через Google API
    function getCaptcha($SecretKey)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret'   => '6LdV1IcUAAAAABnQ0mXIp5Yh7tLEcAXzdqG6rx9Y',
            'response' => $SecretKey
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $Response = curl_exec($ch);
        curl_close($ch);
        return json_decode($Response);
    }

    $Return = getCaptcha($_POST['g-recaptcha-response']);

    // Проверяем: успешна ли капча и не робот ли это (score >= 0.5)
    if ($Return->success == true && $Return->score >= 0.5) {

        // Принимаем данные из формы
        $email = $_POST['email'] ?? 'Не указан';
        $site  = $_POST['site']  ?? 'Не указан';

        // --- НАСТРОЙКИ ПИСЬМА ---
        $to = "sidorov-vv3@mail.ru, vasilyev-r@mail.ru";
        $subject = "Заявка на добавления базы!";

        // Имя отправителя
        $fromName = "Астраханские базы";

        // Ваш домен астраханские-базы.рф в формате Punycode
        $fromEmail = "info@xn-----6kcbac9be0aj9bd0at7f.xn--p1ai";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <$fromEmail>\r\n";
        $headers .= "Reply-To: $fromEmail\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Текст письма
        $message = "Поступила новая заявка:\n\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Сайт: " . $site;

        // Отправка почты
        mail($to, $subject, $message, $headers);

        // Сообщение об успехе
        $_SESSION['win'] = 1;
        $_SESSION['recaptcha'] = '<p class="text-light">Спасибо, что Вы обратились именно к нам. Мы свяжемся с Вами в ближайшее время.</p>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Если проверка на робота не пройдена
        $_SESSION['win'] = 1;
        $_SESSION['recaptcha'] = '<p class="text-light"><strong>Извините!</strong><br>Ваши действия похожи на робота. Пожалуйста, повторите попытку!</p>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
