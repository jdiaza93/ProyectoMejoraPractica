<?php
session_start();
if(!isset($_SESSION["ID_Usu"])){
    header('location:index.php');
}
include("ConecServ.php");

$RutUsu=$_SESSION['Rut'];
$query=mysqli_query($conn, "SELECT * FROM usuarios WHERE Rut='$RutUsu'");
while($row=mysqli_fetch_array($query)){
    $NomUsu=$row['Nombres'];
    $ApellUsu=$row['Apellidos'];
    $MailUsu=$row['Correo'];
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\Exception.php';
require 'PHPMailer-master\PHPMailer.php';
require 'PHPMailer-master\SMTP.php';

if(isset($_POST["MandaResultsImg"])){
    $LinkImg=$_POST["MandaImg"];
    $LinkInfor=$_POST["MandaInfo"];
    $CorreoAEnviar=$_POST["CorreoImg"];
    $MensajOpcional=$_POST["MensaImg"];


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jdiaza93@gmail.com';                     //SMTP username
        $mail->Password   = 'tgkzzvlkhstwyykb';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('remitente@gmail.com', 'Clínica Ciudad del Mar');
        $mail->addAddress($CorreoAEnviar);     //Add a recipient

        $mail->addAttachment($LinkImg, 'Imagenes'); 
        $mail->addAttachment($LinkInfor, 'Informe');  


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resultados imagenologia '.$NomUsu.' '.$ApellUsu;
        $mail->Body    = ' '.$MensajOpcional;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<script type='text/javascript'>window.location.href = 'HistoImg.php'; </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST["MandaResultsLab"])){
    $LinkLab=$_POST["MandaResLab"];
    $CorreoAEnviar=$_POST["CorreoLab"];
    $MensajOpcional=$_POST["MensaLab"];


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jdiaza93@gmail.com';                     //SMTP username
        $mail->Password   = 'tgkzzvlkhstwyykb';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('remitente@gmail.com', 'Clínica Ciudad del Mar');
        $mail->addAddress($CorreoAEnviar);     //Add a recipient

        $mail->addAttachment($LinkLab, 'Resultados'); 


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resultados imagenologia '.$NomUsu.' '.$ApellUsu;
        $mail->Body    = ' '.$MensajOpcional;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<script type='text/javascript'>window.location.href = 'HistoLab.php'; </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>
