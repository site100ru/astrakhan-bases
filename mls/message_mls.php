<?php
session_start();

if ($_POST) {

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/PHPMailer.php';
    require __DIR__ . '/SMTP.php';
    require __DIR__ . '/Exception.php';

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

    if ($Return->success == true && $Return->score >= 0.5) {

        $name    = $_POST['name']    ?? 'Не указано';
        $tel     = $_POST['tel']     ?? 'Не указан';
        $mes     = $_POST['mes']     ?? 'Нет сообщения';
        $product = $_POST['product'] ?? 'Не указан';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.beget.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@астраханские-базы.рф';
            $mail->Password   = 'ctGpxc14E%nF';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('info@астраханские-базы.рф', 'Astrahanskie Bazy');
            $mail->addAddress('sidorov-vv3@mail.ru');
            $mail->addAddress('vasilyev-r@mail.ru');
            $mail->addReplyTo('info@астраханские-базы.рф');

            $mail->Subject = 'Расчёт стоимости с сайта астраханские-базы.рф.';
            $mail->isHTML(true);
            $mail->Body = "Объект: $product<br>Потенциальный клиент: $name<br>Телефон: $tel<br>Сообщение: $mes";

            $mail->send();

        } catch (Exception $e) {
            // ошибка отправки — можно залогировать $mail->ErrorInfo
        }

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