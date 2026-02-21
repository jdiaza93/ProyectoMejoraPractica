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
    <title>Historial horas médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleHisto.css">
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
            <a href="PagIni.php">Inicio</a> > <a href="HistoMedi.php">Historial de horas</a> 
        </div>
        <h1>Historial horas médicas</h1> <br> <br>
        <?php
        $UsuID=$_SESSION['ID_Usu'];
        $sql=mysqli_query($conn, "SELECT horas_medicos.ID, Nombres, NomEspec, Fecha, Hora, Estado FROM horas_medicos LEFT JOIN datosdoctores ON (horas_medicos.ID_Doctor=datosdoctores.ID) LEFT JOIN especialidades ON (horas_medicos.ID_Especialidad=especialidades.ID) WHERE ID_Usuario=$UsuID AND Estado='Sin atender' OR Estado='Atendido' ORDER BY Fecha DESC");
        if($sql->num_rows>0){
            while($row=mysqli_fetch_array($sql)){
                $Hora= date('H:i', strtotime($row["Hora"]));
                $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                echo "<div id='CuadHoras'>
                        <div class='Conten'>
                            <div>
                                <p><strong>Medico</strong>: {$row["Nombres"]}</p>
                                <p><strong>Especialidad</strong>: {$row["NomEspec"]}</p><br>
                            </div>
                            <div>
                                <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                            </div>
                            <div>
                                <p><strong>Estado</strong>: {$row["Estado"]}</p> 
                            </div>
                        </div>
                    </div> <br>";
            } 
        } else {
            echo "<br><div id='MensSinHoras'>El historial de horas médicas está vacio. Si quiere consultar sus horas agendadas, seleccione 'Consultar Horas Agendadas' en el menú de Horas médicas.</div>";
        }
        ?>


    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
  </body>
</html>