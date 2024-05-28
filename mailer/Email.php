<?php
// Importar a classe do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir o autoload do PHPMailer
require_once 'PHPMailer-lib/src/Exception.php';
require_once 'PHPMailer-lib/src/PHPMailer.php';
require_once 'PHPMailer-lib/src/SMTP.php';

// Instanciar o objeto do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP do Gmail
    //Server settings - linha vinda da documentação no github, linha não testada
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '20200054@isptec.co.ao'; // Insira seu google e-mail 
    $mail->Password = 'Angola1234'; // Insira sua senha do gmail aqui
    $mail->SMTPSecure = 'tls';
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 587;
    
    // Configurações do e-mail
    $mail->setFrom('20200054@isptec.co.ao', 'Outdoors Gest'); // Insira seu e-mail e nome aqui
    
    $mail->addAddress($emailDestinatario, $nomeDestinatario); // Insira o e-mail e nome do destinatário aqui
    
    $mail->Subject = $assunto;
    $mail->Subject = '=?UTF-8?B?' . base64_encode($mail->Subject) . '?='; // Define o assunto com a codificação UTF-8

    // Configurações do conteúdo do e-mail
    $mail->isHTML(true); // Define o formato do e-mail como HTML
    $mail->CharSet = 'UTF-8'; // Define a codificação do texto como UTF-8

    // Conteúdo do e-mail em HTML
    $mail->Body = $message . '<br><strong> &copy Cândido Ucuahamba - O BACKEND!<strong>';
    
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Enviar o e-mail
    $mail->send();
    echo '<script>console.log("E-mail enviado com sucesso!");</script>';
} catch (Exception $e) {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
