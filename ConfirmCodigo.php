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
    <title>Confirmar código</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleSelecCon.css">
</head>
<body>
    <div id="IngreCodResi">
        <div class="Container">
            <form method="post" action="ConfirmCodigo.php">
                <h3>Ingrese su código de verificación</h3><br>
                <input type="number" id="CodigoResi" name="CodigoResi"><br>
                <input type="submit" name="IngreCodResi" class="btn btn-primary">
            </form>
            <div class="Espacio">
                -----------------------------
            </div>
                <a class="btn btn-primary" href="<?php
                if ($_SESSION['OpciVeri']==1){
                    echo "MandaSMS.php";
                } elseif($_SESSION['OpciVeri']==2){
                    echo "MandaMail.php";
                } elseif($_SESSION['OpciVeri']==3){
                    echo "MandaWhatsapp.php";
                }
                ?>" role="button">Reenviar código</a>
                <a class="btn btn-secondary" href="SelecConform.php" role="button">Seleccionar nuevo metodo de verificación</a>
        </div>
    </div>    
</body>
</html>


<?php

$RutUsu=$_SESSION['Rut'];
$query=mysqli_query($conn, "SELECT * FROM usuarios WHERE Rut='$RutUsu'");
while($row=mysqli_fetch_array($query)){
    $TelefUsu=$row['Telefono'];
}

$Codigo=$_SESSION['CodConf'];

if(isset($_POST['IngreCodResi'])){
    $CodigoResi=$_POST['CodigoResi'];
    if($Codigo==$CodigoResi){
        header("Location:PagIni.php");
    }else{
        echo "<br><br><br><br><br><br><div class='MensError'>El código de verificación es incorrecto. Intente denuevo.</div>";
    }
}

?>