<?php
    require __DIR__ . '/core/bootstrap.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        error_die('Method not allowed.');
    }

    if (empty($_POST)) {
        error_die('No data is provided.');
    }

    $input_filters = [
        'name'      => FILTER_SANITIZE_STRING,
        'surname'   => FILTER_SANITIZE_STRING,
        'tel'       => FILTER_SANITIZE_STRING,
        'email'     => FILTER_SANITIZE_EMAIL,
        // 'type'      => FILTER_SANITIZE_STRING,
        'ref'       => FILTER_SANITIZE_STRING,
        'medium'       => FILTER_SANITIZE_STRING,
        'campaign'       => FILTER_SANITIZE_STRING,
    ];

    $input_defaults = [
        'ref' => 'direct',
    ];

    $input = [];
    $required = null;

    foreach ($input_filters as $field => $filter) {
        if (isset($_POST[$field]) === false || $_POST[$field] === '') {
            if (array_key_exists($field, $input_defaults)) {
                $input[$field] = $input_defaults[$field];
                continue;
            }
            if ($required === null) {
                $required = $field;
            }
        }
        $input[$field] = filter_input(INPUT_POST, $field, $filter);
    }

//    var_dump($input);
//    die();
//
//    if ($required !== null) {
//        $input['required'] = $required;
//        $input['utm_source'] = $input['ref'];
//        $input['utm_medium'] = $input['medium'];
//        $input['utm_campaign'] = $input['campaign'];
//        unset($input['ref']);
//        redirect($env['APP_URL'] . '?' . http_build_query($input));
//    }

    try {
        $sql = "INSERT INTO {$env['DB_TABLE']} (name, surname, tel, email, ref, medium, campaign, created_at) VALUES(";
        $sql .= "'" . $input['name'] . "', ";
        $sql .= "'" . $input['surname'] . "', ";
        $sql .= "'" . $input['tel'] . "', ";
        $sql .= "'" . $input['email'] . "', ";
        $sql .= "'" . $input['ref'] . "', ";
        $sql .= "'" . $input['medium'] . "', ";
        $sql .= "'" . $input['campaign'] . "', ";
        $sql .= 'CURRENT_TIMESTAMP)';
//        var_dump($sql);
//        die();
        $query = $pdo->prepare($sql);
        $query->execute($input);
    } catch (\Exception $e) {
        error_die('Recording is failed.');
    }

    $emails = implode(',', $env['MAIL_TO']);
    $headers = "From:" . $env['APP_NAME'] . " <" . $env['MAIL_FROM'] . "> \r\n";
    $headers .= "Reply-To: ". $env['MAIL_FROM'] . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $message = "<html><body><b>ชื่อ - นามสกุล</b> : ".$input['name']." ".$input['surname']."<br>".
    "<b>เบอร์โทร</b> : ".$input['tel']."<br>".
    "<b>อีเมล</b> : ".$input['email']."<br>".
    "<b>แหล่งที่มา</b> : ".$input['ref']."<br>".
    "</body></html>";

    $message_client = "<html><body>".'<a href="' . $env['MAIL_CLIENT_URL_LINK'] . '"><img alt="" src="' . $env['MAIL_CLIENT_URL_PICTURE'] . '"></a><br>'."</body></html>";

    mail($emails, $env['MAIL_SUBJECT'], $message, $headers);
    mail($input['email'], $env['MAIL_CLIENT_SUBJECT'], $message_client, $headers);

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';



    redirect($env['URL_REDIRECT_AFTER_REGISTER']);
