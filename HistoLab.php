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
    <title>Resultados laboratorio</title>
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
            <a href="PagIni.php">Inicio</a> > <a href="HistoLab.php">Resultados de laboratorio</a> 
        </div>
        <h1>Resultados de laboratorio</h1> <br> <br>
        <div id="container">
            <?php
            $UsuID=$_SESSION['ID_Usu'];
            $sqlTomaMues=mysqli_query($conn, "SELECT * FROM result_toma_muestras WHERE ID_Usuario=$UsuID");
            $sqlElec=mysqli_query($conn, "SELECT * FROM result_electro WHERE ID_Usuario=$UsuID");
            $sqlHol=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Resultados FROM result_holter LEFT JOIN horas_holter ON (result_holter.ID_Examen=horas_holter.ID) WHERE result_holter.ID_Usuario=$UsuID");
            if(($sqlTomaMues->num_rows>0) && ($sqlElec->num_rows>0) && ($sqlHol->num_rows>0)){
                while($row=mysqli_fetch_array($sqlTomaMues)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: Toma de muestras.</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaLab'>
                                            <input type='hidden' name='MandResLab' value='{$row["Direccion"]}{$row["Resultados"]}'>
                                            <input type='hidden' name='MandNom' value='Toma de Muestras'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaLab'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <br><a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Resultados"]}'>Descargar resultados</a>
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlElec)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: Electrocardiograma</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaLab'>
                                            <input type='hidden' name='MandResLab' value='{$row["Direccion"]}{$row["Resultados"]}'>
                                            <input type='hidden' name='MandNom' value='Electrocardiograma'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaLab'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <br><a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Resultados"]}'>Descargar resultados</a>
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlHol)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: Holter de presión</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaLab'>
                                            <input type='hidden' name='MandResLab' value='{$row["Direccion"]}{$row["Resultados"]}'>
                                            <input type='hidden' name='MandNom' value='Holter de presión'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaLab'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <br><a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Resultados"]}'>Descargar resultados</a>
                                    
                                </div>
                            </div>
                        </div>";
                } 
            }else{
                echo "<br><div id='MensSinHoras' class='CuadHoras'>El historial de exámenes de laboratorio está vacio. Si quiere consultar sus exámenes agendados, seleccione 'Consultar Exámenes Agendados' en el menú de Exámenes de laboratorio.</div>";
            }
            ?>
        </div>

    </main>
    <footer>
    <script>
        const container = document.getElementById('container');
        const divs = Array.from(container.querySelectorAll('.CuadHoras'));

        divs.sort((b, a) => {
            const dateA = new Date(a.dataset.date);
            const dateB = new Date(b.dataset.date);
            return dateA.getTime() - dateB.getTime();
        });

        container.innerHTML = '';
        divs.forEach(div => container.appendChild(div));
    </script>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
  </body>
</html>