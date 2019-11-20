<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require(ROOT . '/PHPMailer/src/Exception.php');
require(ROOT . '/PHPMailer/src/PHPMailer.php');
require(ROOT. '/PHPMailer/src/SMTP.php');

class Mail
{
    public function sendMail($email, Buyout $buy){
      

        $mail = new PHPMailer(true);

            try {
                //Server settings
           //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'moviepassmdq@gmail.com';                     // SMTP username
                $mail->Password   = 'proyecto2019';                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
             //   $mail->Debugoutput = 'html';
                //Recipients
                $mail->setFrom('moviepassmdq@gmail.com', 'Movie Pass');
                $mail->addAddress($email);            // Name is optional
              /*  $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');*/
            
                // Attachments
             //   $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment(dirname(__DIR__) . '\qrcode.pdf', 'Codigo qr entradas');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Confirmacion de compra de entradas';
                $mail->Body    = "Se adjunta la informacion de la compra con un codigo qr que debera presentar al momemnto de entrar a la funcion" .
                                "<br>Cantidad: " . $buy->getQuan() . "<br>Total: " . $buy->getTotal() .
                                "<br>Fecha: " . $buy->getDate();
             //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
             //   echo 'Message has been sent';
            } catch (Exception $e) {
                
            }
        
    }
}