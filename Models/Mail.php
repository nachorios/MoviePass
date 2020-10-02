<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use Daos\BillboardDAO as BillboardDAO;
use Daos\BuyoutDAO as BuyoutDAO;
use Daos\CinemaDAO as CinemaDAO;
use Daos\MovieDAO as MovieDAO;
use Daos\UserDAO as UserDAO;

use Models\Billboard as Billboard;
use Models\Buyout as Buyout;
use Models\Cinema as Cinema;
use Models\Movie as Movie;
use Models\User as User;

require(ROOT . '/PHPMailer/src/Exception.php');
require(ROOT . '/PHPMailer/src/PHPMailer.php');
require(ROOT. '/PHPMailer/src/SMTP.php');

class Mail
{

   private $buyoutDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $billboardDAO;

        public function __construct(){
            $this->buyoutDAO = new BuyoutDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->billboardDAO = new BillboardDAO();
        }



    public function sendMail($email, Buyout $buy){
      


        $mail = new PHPMailer(true);

            try {
                //Server settings
           //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'moviepassmdq@hotmail.com';                     // SMTP username
                $mail->Password   = 'proyecto2019';                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
             //   $mail->Debugoutput = 'html';
                //Recipients
                $mail->setFrom('moviepassmdq@hotmail.com', 'Movie Pass');
                $mail->addAddress($email);            // Name is optional
              /*  $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');*/
            
                // Attachments
             //   $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // Optional name
                    $cant = $buy->getQuan();
                if($cant > 1){    
                    for($i = 0; $i < $cant; $i ++){
                        
                        $mail->addAttachment(ROOT . '\temp\qr'. $i .'.png');
                    }
                }else{
                    $mail->addAttachment(ROOT . '\temp\qr.png', 'Codigo qr entradas');
                }
                // Content
                $id = $this->buyoutDAO->GetId($buy->getDate());
                $cinema = $this->cinemaDAO->GetById($buy->getCinema());
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Confirmacion de compra de entradas';
                $mail->Body    = "Se adjunta la informacion de la compra con un codigo qr que debera presentar al momento de entrar a la funcion" .
                                "<br><br>Cantidad: " . $buy->getQuan() . "<br>Total: " . $buy->getTotal() .
                                "<br>Fecha de compra: " . $buy->getDate() . "<br>Id compra: " . $id . 
                                "<br>Cine: " . $cinema->getName(). "<br>Direccion: ". $cinema->getAdress();
                                
             //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
             //   echo 'Message has been sent';
            } catch (Exception $e) {
                
            }
        
    }
}