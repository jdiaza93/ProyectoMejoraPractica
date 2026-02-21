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
    <title>Horas agendadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleConfirHora.css">
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
            <a href="PagIni.php">Inicio</a> > <a href="ConfirHoraImg.php">Consultar horas agendadas</a> 
        </div>
        <h1>Confirmación de horas</h1>
        <div class='MensRecord'><span style='color:red;'>Importante:</span> Acuérdese de llevar su orden médica y un documento de identificación el día de su hora como cédula de identidad, pasaporte o certificado de nacimiento.</div><br>
        <div id="container">
            <?php
            $UsuID=$_SESSION['ID_Usu'];
            $sqlReso=mysqli_query($conn, "SELECT horas_resonancia.ID, NomExamen, Preparacion, Fecha, Hora, Estado FROM horas_resonancia LEFT JOIN exam_img_reso ON (horas_resonancia.ID_Examen=exam_img_reso.ID) WHERE ID_Usuario=$UsuID AND Estado='Sin confirmar' OR Estado='Confirmada'");
            $sqlTac=mysqli_query($conn, "SELECT horas_scanner.ID, NomExamen, Preparacion, Fecha, Hora, Estado FROM horas_scanner LEFT JOIN exam_img_tac ON (horas_scanner.ID_Examen=exam_img_tac.ID) WHERE ID_Usuario=$UsuID AND Estado='Sin confirmar' OR Estado='Confirmada'");
            $sqlEco=mysqli_query($conn, "SELECT horas_ecografia.ID, NomExamen, Preparacion, Fecha, Hora, Estado FROM horas_ecografia LEFT JOIN exam_img_eco ON (horas_ecografia.ID_Examen=exam_img_eco.ID) WHERE ID_Usuario=$UsuID AND Estado='Sin confirmar' OR Estado='Confirmada'");
            $sqlDensi=mysqli_query($conn, "SELECT ID, NomExamen, Fecha, Hora, Estado FROM horas_densitometria WHERE ID_Usuario=2 AND Estado='Sin confirmar' OR Estado='Confirmada'");
            if(($sqlReso->num_rows>0) && ($sqlTac->num_rows>0) && ($sqlEco->num_rows>0)&&($sqlDensi->num_rows>0)){
                while($row=mysqli_fetch_array($sqlReso)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo $row["Fecha"];
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                    <p><strong>Preparación</strong>: {$row["Preparacion"]}</p><br>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <p><strong>Estado</strong>: {$row["Estado"]}</p> 
                                </div>
                                <div>".($row["Estado"] == "Sin confirmar" ? 
                                    "<form action='ConfirmaHoras.php' method='POST' name='ConfirmHoraReso'>
                                        <input type='hidden' id='IdHora' name='IdHora' value='{$row["ID"]}'>
                                        <button type='submit' class='btn btn-primary btn-lg' name='ConfirmHoraReso'>Confirmar hora</button>
                                    </form>" : 
                                    "")

                                ."</div>
                            </div>
                        </div> ";
                }
                while($row=mysqli_fetch_array($sqlTac)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo $row["Fecha"];
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                    <p><strong>Preparación</strong>: {$row["Preparacion"]}</p><br>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <p><strong>Estado</strong>: {$row["Estado"]}</p> 
                                </div>
                                <div>".($row["Estado"] == "Sin confirmar" ? 
                                    "<form action='ConfirmaHoras.php' method='POST' name='ConfirmHoraTac'>
                                        <input type='hidden' id='IdHora' name='IdHora' value='{$row["ID"]}'>
                                        <button type='submit' class='btn btn-primary btn-lg' name='ConfirmHoraTac'>Confirmar hora</button>
                                    </form>" : 
                                    "")

                                ."</div>
                            </div>
                        </div> ";
                }
                while($row=mysqli_fetch_array($sqlEco)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo $row["Fecha"];
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                    <p><strong>Preparación</strong>: {$row["Preparacion"]}</p><br>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <p><strong>Estado</strong>: {$row["Estado"]}</p> 
                                </div>
                                <div>".($row["Estado"] == "Sin confirmar" ? 
                                    "<form action='ConfirmaHoras.php' method='POST' name='ConfirmHoraEco'>
                                        <input type='hidden' id='IdHora' name='IdHora' value='{$row["ID"]}'>
                                        <button type='submit' class='btn btn-primary btn-lg' name='ConfirmHoraEco'>Confirmar hora</button>
                                    </form>" : 
                                    "")

                                ."</div>
                            </div>
                        </div> ";
                }
                while($row=mysqli_fetch_array($sqlDensi)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo $row["Fecha"];
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                    <p><strong>Preparación</strong>: Suspender suplementos de calcio dos días antes del examen.</p><br>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <p><strong>Estado</strong>: {$row["Estado"]}</p> 
                                </div>
                                <div>".($row["Estado"] == "Sin confirmar" ? 
                                    "<form action='ConfirmaHoras.php' method='POST' name='ConfirmHoraDensi'>
                                        <input type='hidden' id='IdHora' name='IdHora' value='{$row["ID"]}'>
                                        <button type='submit' class='btn btn-primary btn-lg' name='ConfirmHoraDensi'>Confirmar hora</button>
                                    </form>" : 
                                    "")

                                ."</div>
                            </div>
                        </div> ";
                }
            }else{
                echo "<br><div id='MensSinHoras' class='CuadHoras'>No tiene horas agendadas. Si quiere  agendar, seleccione 'Agendar Exámenes de Imagenología' en el menú de Exámenes de imagenología.</div>";
            }
            ?>  
        </div>    

    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
    <script>
        const container = document.getElementById('container');
        const divs = Array.from(container.querySelectorAll('.CuadHoras'));

        divs.sort((a, b) => {
            const dateA = new Date(a.dataset.date);
            const dateB = new Date(b.dataset.date);
            return dateA.getTime() - dateB.getTime();
        });

        container.innerHTML = '';
        divs.forEach(div => container.appendChild(div));
    </script>
  </body>
</html>