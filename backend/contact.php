<?php
    require __DIR__ . '/core/bootstrap.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        error_die('Method not allowed.');
    }

    if (empty($_POST)) {
        error_die('No data is provided.');
    }

    $input_filters = [
        'project'   => FILTER_SANITIZE_STRING,
        'name'      => FILTER_SANITIZE_STRING,
        'surname'   => FILTER_SANITIZE_STRING,
        'tel'       => FILTER_SANITIZE_STRING,
        'email'     => FILTER_SANITIZE_EMAIL,
    ];

    $input_defaults = [];

    $input = [];

    foreach ($input_filters as $field => $filter) {
        $input[$field] = filter_input(INPUT_POST, $field, $filter);
    }

    $email = $env['MAIL_CONTACT'];
    $headers = "From: " . $env['MAIL_FROM'] . "\r\n";
    $headers .= "Reply-To: ". $env['MAIL_FROM'] . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $message = "<html><body><b>โครงการ</b> : ".$input['project']."<br>".
    "<b>ชื่อ - นามสกุล</b> : ".$input['name']." ".$input['surname']."<br>".
    "<b>เบอร์โทร</b> : ".$input['tel']."<br>".
    "<b>อีเมล</b> : ".$input['email']."<br>".
    "</body></html>";

    mail($email, $env['MAIL_CONTACT_SUBJECT'], $message, $headers);

    redirect($env['APP_URL']);
