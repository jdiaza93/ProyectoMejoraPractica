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
$_SESSION['OpciVeri']=3;

    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once 'twilio-php-main/src/Twilio/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "AC68b8265358ce22a33c8c17e4e5733035";
    $token  = "20c8b4da3a94d48103b2bc23b6c34a13";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:+56957302198", // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => "Tu código de verificación es ".$Codigo
        )
      );

print($message->sid);
header("Location:ConfirmCodigo.php");
?>