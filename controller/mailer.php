<?php
require_once 'PHPMailer-master/src/Exception.php';
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email_dest, $sujet, $msg){

    $mail = new PHPMailer(true);

    $gmail = 'eduquizplus@gmail.com';
    $mdp = 'dsrh dtwf pkdb smmc';
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $gmail;
        $mail->Password = $mdp;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        // désactivation de la vérification SSL
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    
        $mail->setFrom($gmail, 'EduQuiz'); //expediteur
        $mail->addAddress($email_dest); // destinataire
    
        $mail->isHTML(true);
        $mail->Subject = 'EduQuiz';
        $mail->Body = '<h1>'.$sujet.'</h1>'.$msg;
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Erreur : {$mail->ErrorInfo}";
    }
}
?>