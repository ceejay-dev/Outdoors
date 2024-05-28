<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
include_once '../vendor/phpmailer/phpmailer/src/SMTP.php';
include_once '../vendor/phpmailer/phpmailer/src/Exception.php';

class EmailService {

    private $password = "uzkwqwwzlshvbvmj";
    private $port = 587;

    public function sendEmail($email, $title, $message) {

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $email;
        $mail->Username = 'candidojoao12@gmail.com';
        $mail->SMTPAuth = true;
        $mail->Password = $this->password; // Insira sua senha do Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = $this->port;

        // Configurações do e-mail
        $mail->setFrom('candidojoao12@gmail.com', 'Cândido Ucuahamba'); // E-mail do remetente
        $mail->addAddress($email, '');

        $mail->Subject = $title;
        $mail->Body = $message;
        $mail->send();
    }

}
