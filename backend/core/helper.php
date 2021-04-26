<?php
    function json_dump(array $data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
        exit;
    }

    function error_die($message)
    {
        json_dump(['error' => $message]);
    }

    function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    function view($view, array $data = null)
    {
        if ($data !== null) {
            extract($data);
        }
        include __DIR__ . '/env.php';
        require __DIR__ . '/../views/' . $view . '.php';
        exit;
    }
    function send_mail_smtp(array $mails, $subject, $message)
    {
        include __DIR__ . '/env.php';
        $mail = new PHPMailer(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->CharSet = "utf-8";
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Host = $env['MAIL_SMTP_HOST'];
        $mail->Port = $env['MAIL_SMTP_PORT'];
        $mail->Username = $env['MAIL_SMTP_USERNAME'];
        $mail->Password = $env['MAIL_SMTP_PASSWORD'];
        $mail->SetFrom($env['MAIL_FROM'], $env['APP_NAME']);
        $mail->AddReplyTo($env['MAIL_FROM'], $env['APP_NAME']);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        foreach ($mails as $mailto) {
            $mail->AddAddress($mailto);
        }

        return $mail->Send();
    }
