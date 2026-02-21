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
    <title>Agenda horas laboratorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleAgendHoraLab.css">
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
        <div class="Histori">
            <a href="PagIni.php">Inicio</a> > <a href="AgendHoraLab.php">Agenda exámenes laboratorio</a> 
        </div>
        <h1>Exámenes de laboratorio</h1>
        <div class="Botones">
          <button type="button" class="collapsible">Toma de muestras</button> 
          <div class="ContCollap"> 
            <p>Los examenes son por orden de llegada y se realizan de lunes a sabados desde las 7:30hrs a las 11:45hrs.</p>
            <p><span style='color:red;'>Importante:</span> Acuérdese de llevar un documento de identificación y su orden médica para su examen.</p> <br>
            <p><strong>Examenes de sangre:</strong> Ayuno mínimo de 8 horas y máximo de 12 horas.</p>
            <p><strong>Urocultivo:</strong> Ayuno mínimo de 8 horas y máximo de 12 horas. Se le entregará un frasco y las indicaciones en la recepción. Se recomienda llevar una botella de agua.</p>
            <p><strong>Coprocultivo:</strong> Se le entregará un frasco y las indicaciones en la recepción.</p>
          </div>
          <button type="button" class="collapsible">Electrocardiograma </button> 
          <div class="ContCollap"> 
            <p>Los examenes son por orden de llegada y se realizan de lunes a sabados desde las 7:30hrs a las 19:00hrs.</p>
            <p><span style='color:red;'>Importante:</span> Acuérdese de llevar un documento de identificación y su orden médica para su examen.</p> <br>
            <p>Durante el examen no puede tener puesto nada metálico como aros, relojes, collares, llaves, etc.</p>
            <p>Antes del examen evite aplicarse cremas o lociones en el pecho.</p>
            <p>Antes del examen no puede consumir café, bebidas energéticas o chocolates.</p>
          </div>
          <a class="btn btn-primary" href="SelecFechaHolter.php" role="button">Holter de presión</a>
      </div>
      



    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
    <script src="JScriptPagIni.js"></script>
  </body>
</html>