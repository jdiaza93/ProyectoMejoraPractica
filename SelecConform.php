<?php
session_start();
if(!isset($_SESSION["ID_Usu"])){
    header('location:index.php');
}
include("ConecServ.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccione verificación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleSelecCon.css">
</head>
<body>
    <br><br>
    <h1>Seleccione su método de verificación de identidad.</h1><br><br>
    <a href="MandaSMS.php">
        <div class='Opciones'>
            <div><img src='icon\sms-icon.png' alt='Foto telefono'></div>
            <div><p>Enviar código de verificación por mensaje de texto.</p></div>
        </div>
    </a><br>
    <a href="MandaMail.php">
        <div class='Opciones'>
            <div><img src='icon\correo.png' alt='Foto correo'></div>
            <div><p>Enviar código de verificación por correo electrónico.</p></div>
        </div>
    </a><br>
    <a href="MandaWhatsapp.php">
        <div class='Opciones'>
            <div><img src='icon/whatsapp-logo.png' alt='Foto correo'></div>
            <div><p>Enviar código de verificación por WhatsApp.</p></div>
        </div>
    </a>
</body>
</html>