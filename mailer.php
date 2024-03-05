<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_REQUEST['to']))
{
    $to=$_REQUEST['to'];
    $subject=$_REQUEST['subject'];
    $content=$_REQUEST['content'];
    sendEmail($to,$subject,$content);
}

function sendEmail($to,$subject,$content)
{
require 'vendor/autoload.php';

 
$mail = new PHPMailer(true);

try {
                           
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                      
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'vinayakpawar202020@gmail.com';                     
    $mail->Password   = 'mrdgfouamsxkucis';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('vinayakpawar202020@gmail.com', 'vins');
    // $mail->addAddress($to, 'Joe User');     
     
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    // $otp=rand(11111,99999);
    $mail->Body    = $content;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}