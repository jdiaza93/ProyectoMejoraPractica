<?php
session_start();
if(!isset($_SESSION["ID_Usu"])){
    header('location:index.php');
}
include("ConecServ.php");

if(isset($_POST["MandaImg"])){
    $NomExam=$_POST["MandNom"];
    $FechExam=$_POST["MandFecha"];
    $LinkImg=$_POST["MandImg"];
    $LinkInfor=$_POST["MandInfor"];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compartir por correo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="Style/StyleMandaResult.css">
    </head>

    <body>
        <br><br>
        <h1>Examen: <?php echo $NomExam;?> Fecha: <?php echo $FechExam;?></h1>
        <br><br>
        <form action="MandaResults.php" method="post" name="MandaResultsImg">
            <label>Correo a donde enviar resultados:</label><br>
            <input type="email" name="CorreoImg" placeholder="ejemplo@ejemplo.com" required oninvalid="this.setCustomValidity('El correo debe seguir el formato de ejemplo@ejemplo.com.')" oninput="setCustomValidity('')"><br>
            <label>Mensaje adicional:</label><br>
            <textarea rows="4" cols="50" name="MensaImg" placeholder="Opcional"></textarea><br>
            <input type="hidden" name="MandaImg" value="<?php echo $LinkImg?>">
            <input type="hidden" name="MandaInfo" value="<?php echo $LinkInfor?>">
            <input type="submit" value="Mandar correo" name="MandaResultsImg" class="btn btn-primary">
        </form>
    </body>
    </html>
    <?php
}

if(isset($_POST['MandaLab'])){
    $NomExam=$_POST["MandNom"];
    $FechExam=$_POST["MandFecha"];
    $LinkREsult=$_POST["MandResLab"];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compartir por correo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="Style/StyleMandaResult.css">
    </head>

    <body>
        <br><br>
        <h1>Examen: <?php echo $NomExam;?> Fecha: <?php echo $FechExam;?></h1>
        <br><br>
        <form action="MandaResults.php" method="post" name="MandaResultsLab">
            <label>Correo a donde enviar resultados:</label><br>
            <input type="email" name="CorreoLab" placeholder="ejemplo@ejemplo.com" required oninvalid="this.setCustomValidity('El correo debe seguir el formato de ejemplo@ejemplo.com.')" oninput="setCustomValidity('')"><br>
            <label>Mensaje adicional:</label><br>
            <textarea rows="4" cols="50" name="MensaLab" placeholder="Opcional"></textarea><br>
            <input type="hidden" name="MandaResLab" value="<?php echo $LinkREsult?>">
            <input type="submit" value="Mandar correo" name="MandaResultsLab" class="btn btn-primary">
        </form>
    </body>
    </html>
    <?php
}
?>
