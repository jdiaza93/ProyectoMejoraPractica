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
    <title>Agenda Horas Médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleAgendHoraMedi.css">
</head>
<body>
    <header>
        <a href="PagIni.php"><img class="LogoClini" src="LogoClini.jpg" alt=""></a>
        <div class="HeaderDere">
            <a href="PerfilUsu.php"><p class="NomUsu"><img class="UserIco" src="UserIco.png" alt="">
                          <?php
                          $RutUsu=$_SESSION['Rut'];
                          $query=mysqli_query($conn, "SELECT * FROM usuarios WHERE Rut='$RutUsu'");
                          while($row=mysqli_fetch_array($query)){
                            echo $row['Nombres'].' '.$row['Apellidos'];
                          }
                          ?>
                       </p></a>
        </div>
    </header>
    <main>
        <div class="Histo">
            <a href="PagIni.php">Inicio</a> > <a href="AgendHoraMedi.php">Agenda horas médicas</a>
        </div>
        <h1>Agenda horas médicas</h1>
        <div class="Buscador">
            <form action="SelecMedi.php" method="post">
                <label for="SelecPrevi">Previsión</label><br>
                <select name="Presta" id="SelecPrevi" class="form-select" aria-label="Default select example" required>
                    <option value="">Buscar prestación</option>
                    <option value="6">Particular</option>
                    <option value="1">Fonasa</option>
                    <option value="2">Consalud</option>
                    <option value="5">Banmedica</option>
                    <option value="3">Vida tres</option>
                    <option value="4">Cruz blanca</option>
                </select> <br> <br>
                <label for="SelecEspe">Especialidad</label><br>
                <select name="Espec" id="SelecEspe" class="form-select" aria-label="Default select example" required>
                    <option value="">Buscar especialidad</option>
                    <option value="2">Traumatología</option>
                    <option value="3">Geriatría</option>
                    <option value="1">Broncopulmonar</option>
                    <option value="4">Neurología</option>
                    <option value="5">Reumatología</option>
                </select><br>
                <input type="submit" value="Buscar especialidad" class="btn btn-primary btn-lg" name="BuscaMed">
            </form>
        </div>
    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
  </body>
</html>