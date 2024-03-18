<?php
$koneksi = mysqli_connect("localhost", "root", "", "phpmailer");

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$code =md5($email.date('y-m-d H:i:s'));

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fauziwibu@gmail.com';                     //SMTP username
    $mail->Password   = 'xwgz gaod mazn ogdy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('fauziwibu@gmail.com.com', 'Verifikasi');
    $mail->addAddress($email, $name);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi akun';
    $mail->Body    = 'Hi'.$name.'Terimakasih sudah mendaftar di web ini, <br>Mohon vertifikasi akun kamu! <a href="http://localhost/phpmailer/verif.php?code='.$code.'">Vertifikasi</a></b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if( $mail->send()){
    $koneksi->query("INSERT INTO data(email, name, password, code_ver)VALUES('$email','$name','$password','$code')");
    echo "<script>alert('Registrasi Berhasil, silahkan cek email untuk vertifikasi akun');window.location='login.php'</script>";
};
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
