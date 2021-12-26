<?php

$fio = '';
$phone = '';
$email = '';
$question = '';

$json = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $json['error']['name'] = "Заповніть ім'я";
    } else {
        $fio = test_input($_POST["name"]);

        if (!preg_match("/^[a-яA-Я ]*$/", $fio)) $json['error']['name'] = 'Дозволені тільки літери';
    }

    if (empty($_POST["email"])){
        $json['error']['email'] = "Поле e-mail обов'язкове";
    } else {
        $email = test_input($_POST["email"], true);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $json['error']['email'] = 'Невірний формат e-mail';
    }

    if (empty($_POST["phone"])){
//        $json['error']['phone'] = 'Поле телефон обезательно';
        $json['error']['phone'] = 'Поле телефон обов\'язкове';
    } else {
        $phone = test_input($_POST["phone"]);

        if(!preg_match("/^[0-9]+$/",$phone)){
            $json['error']['phone'] = "Невірний формат";
        }
    }

    if (empty($_POST["question"])) {
        $json['error']['question'] = "Поле повідомлення обов'язкове";
    } else {
        $question = test_input($_POST["question"]);
    }

    if (!$json){
        $dt=date("d.m.Y, H:i:s"); // дата и время
        $mail="elena.makarova@ie.net.ua"; // e-mail куда уйдет письмо
//        $mail="alexsander11115@gmail.com"; // e-mail куда уйдет письмо
        $title="Форма NexGard"; // заголовок(тема) письма

        $question=str_replace("\r\n","<br>",$question); // обрабатываем

        $mess="<html><head></head><body><b>ФИО:</b> $fio<br>";
        $mess.="<b>Сообщение:</b> $question<br>";
        // ссылка на e-mail
        $mess.="<b>E-Mail:</b> <a href='mailto:$mail'>$email</a><br>";
        $mess.="<b>Телефон:</b> $phone<br>";
        $mess.="<b>Дата и Время:</b> $dt</body></html>";

        $headers="MIME-Version: 1.0\r\n";
        $headers.="Content-Type: text/html; charset=UTF-8\r\n";
        $headers.="From: nexgard.triplex.com.ua@gmail.com\r\n"; // откуда письмо
        mail($mail, $title, $mess, $headers); // отправляем
        $json['success'] = 'Дякуємо! Ми отримали ваш запит та дамо вам відповідь найближчим часом!';
    }

    echo json_encode($json);
    exit();
}

function test_input($data, $trim = false) {
    if ($trim)  $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
