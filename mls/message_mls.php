<?php
session_start();

if ( $_POST ) {

    function getCaptcha( $SecretKey ) {
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

    if( $Return->success == true && $Return->score >= 0.5 ) {

        $name  = $_POST['name'];
        $email = $_POST['email'];
        $mes   = $_POST['mes'];

        mail(
            "sidorov-vv3@mail.ru, vasilyev-r@mail.ru",
            "Сообщение с сайта астраханские-базы.рф!",
            "Имя: " . $name . "\nEmail: " . $email . "\nСообщение: " . $mes
        );

        $_SESSION['win'] = 1;
        $_SESSION['recaptcha'] = '<p class="text-light">Спасибо, что Вы обратились именно к нам. Мы свяжемся с Вами в ближайшее время.</p>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    } else {

        $_SESSION['win'] = 1;
        $_SESSION['recaptcha'] = '<p class="text-light"><strong>Извините!</strong><br>Ваши действия похожи на робота. Пожалуйста повторите попытку!</p>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>