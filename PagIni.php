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
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StylePagIni.css">
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
        <div class="Botones">
          <button type="button" class="collapsible">Horas médicas</button> 
          <div class="ContCollap"> <ul>
            <li><a href="AgendHoraMedi.php">Agendar horas médicas</a></li>
            <li><a href="ConfirHoraMedi.php">Consultar horas agendadas</a></li>
            <li><a href="HistoMedi.php">Ver historial de horas</a></li>
          </ul></div>
          <button type="button" class="collapsible">Exámenes de imagenología </button> 
          <div class="ContCollap"> <ul>
            <li><a href="AgendHoraImg.php">Agendar exámenes de imagenología</a></li>
            <li><a href="ConfirHoraImg.php">Consultar exámenes agendados</a></li>
            <li><a href="HistoImg.php">Ver resultados de imagenología</a></li>
          </ul></div>
          <button type="button" class="collapsible">Exámenes de laboratorio </button> 
          <div class="ContCollap"><ul>
            <li><a href="AgendHoraLab.php">Agendar exámenes de laboratorio</a></li>
            <li><a href="ConfirHoraLab.php">Consultar exámenes agendados</a></li>
            <li><a href="HistoLab.php">Ver resultados de laboratorio</a></li>
          </ul></div>
      </div>
    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_L"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
    <script src="JScriptPagIni.js"></script>
  </body>
</html>