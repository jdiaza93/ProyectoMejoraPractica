<?php
session_start();
if(!isset($_SESSION["ID_Usu"])){
    header('location:index.php');
}
include("ConecServ.php");

$RutUsu=$_SESSION['Rut'];
$query=mysqli_query($conn, "SELECT * FROM usuarios WHERE Rut='$RutUsu'");
while($row=mysqli_fetch_array($query)){
    $TelefUsu=$row['Telefono'];
}

$Codigo=rand(100000,999999);
$_SESSION['CodConf']=$Codigo;
$_SESSION['OpciVeri']=1;

// Required if your environment does not handle autoloading
require __DIR__ . '\twilio-php-main\src\Twilio\autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "AC68b8265358ce22a33c8c17e4e5733035";
$token = "20c8b4da3a94d48103b2bc23b6c34a13";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+56'.$TelefUsu,
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+17073768588',
        // The body of the text message you'd like to send
        'body' => "Tu código de verificación es ".$Codigo
    ]
);

header("Location:ConfirmCodigo.php");

?>

