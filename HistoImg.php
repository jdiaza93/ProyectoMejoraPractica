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
    <title>Resultados imagenología</title>
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
            <a href="PagIni.php">Inicio</a> > <a href="HistoImg.php">Resultados de imagenología</a> 
        </div>
        <h1>Resultados de imagenología</h1> <br> <br>
        <div id="container">
            <?php
            $UsuID=$_SESSION['ID_Usu'];
            $sqlReso=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Imagenes, Informes FROM horas_resonancia LEFT JOIN exam_img_reso ON (horas_resonancia.ID_Examen=exam_img_reso.ID) LEFT JOIN result_reso ON (result_reso.ID_Examen=horas_resonancia.ID) WHERE result_reso.ID_Usuario=$UsuID");
            $sqlTac=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Imagenes, Informes FROM horas_scanner LEFT JOIN exam_img_tac ON (horas_scanner.ID_Examen=exam_img_tac.ID) LEFT JOIN result_tac ON (result_tac.ID_Examen=horas_scanner.ID) WHERE result_tac.ID_Usuario=$UsuID");
            $sqlEco=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Imagenes, Informes FROM horas_ecografia LEFT JOIN exam_img_eco ON (horas_ecografia.ID_Examen=exam_img_eco.ID) LEFT JOIN result_eco ON (result_eco.ID_Examen=horas_ecografia.ID) WHERE result_eco.ID_Usuario=$UsuID");    
            $sqlDensi=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Imagenes, Informes FROM horas_densitometria LEFT JOIN result_densi ON (result_densi.ID_Examen=horas_densitometria.ID) WHERE result_densi.ID_Usuario=$UsuID");
            $sqlRx=mysqli_query($conn, "SELECT NomExamen, Fecha, Hora, Direccion, Imagenes, Informes FROM result_rx LEFT JOIN exam_img_rx ON (result_rx.ID_Examen=exam_img_rx.ID) WHERE result_rx.ID_Usuario=$UsuID");
            if(($sqlReso->num_rows>0) && ($sqlTac->num_rows>0) && ($sqlEco->num_rows>0)&&($sqlDensi->num_rows>0)&&($sqlRx->num_rows>0)){
                while($row=mysqli_fetch_array($sqlReso)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaImg'>
                                            <input type='hidden' name='MandImg' value='{$row["Direccion"]}{$row["Imagenes"]}'>
                                            <input type='hidden' name='MandInfor' value='{$row["Direccion"]}{$row["Informes"]}'>
                                            <input type='hidden' name='MandNom' value='{$row["NomExamen"]}'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaImg'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Imagenes"]}'>Descargar imágenes</a> <br>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Informes"]}'>Descargar informe</a> 
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlTac)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaImg'>
                                            <input type='hidden' name='MandImg' value='{$row["Direccion"]}{$row["Imagenes"]}'>
                                            <input type='hidden' name='MandInfor' value='{$row["Direccion"]}{$row["Informes"]}'>
                                            <input type='hidden' name='MandNom' value='{$row["NomExamen"]}'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaImg'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Imagenes"]}'>Descargar imágenes</a> <br>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Informes"]}'>Descargar informe</a> 
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlEco)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaImg'>
                                            <input type='hidden' name='MandImg' value='{$row["Direccion"]}{$row["Imagenes"]}'>
                                            <input type='hidden' name='MandInfor' value='{$row["Direccion"]}{$row["Informes"]}'>
                                            <input type='hidden' name='MandNom' value='{$row["NomExamen"]}'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaImg'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Imagenes"]}'>Descargar imágenes</a> <br>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Informes"]}'>Descargar informe</a> 
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlDensi)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaImg'>
                                            <input type='hidden' name='MandImg' value='{$row["Direccion"]}{$row["Imagenes"]}'>
                                            <input type='hidden' name='MandInfor' value='{$row["Direccion"]}{$row["Informes"]}'>
                                            <input type='hidden' name='MandNom' value='{$row["NomExamen"]}'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaImg'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Imagenes"]}'>Descargar imágenes</a> <br>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Informes"]}'>Descargar informe</a> 
                                    
                                </div>
                            </div>
                        </div>";
                } 
                while($row=mysqli_fetch_array($sqlRx)){
                    $Hora= date('H:i', strtotime($row["Hora"]));
                    $Fecha=date("d-m-Y", strtotime($row['Fecha']));
                    echo "<div class='CuadHoras' id='CuadHoras' data-date='{$row["Fecha"]}'>
                            <div class='Conten'>
                                <div>
                                    <p><strong>Examen</strong>: {$row["NomExamen"]}</p>
                                </div>
                                <div>
                                    <p><strong>Dia</strong>: $Fecha <strong>Hora</strong>: $Hora</p>
                                </div>
                                <div>
                                    <br><form action='MandaResulCorreo.php' method='POST' name='MandaImg'>
                                            <input type='hidden' name='MandImg' value='{$row["Direccion"]}{$row["Imagenes"]}'>
                                            <input type='hidden' name='MandInfor' value='{$row["Direccion"]}{$row["Informes"]}'>
                                            <input type='hidden' name='MandNom' value='{$row["NomExamen"]}'>
                                            <input type='hidden' name='MandFecha' value='$Fecha $Hora'>
                                            <button type='submit' class='btn btn-primary' name='MandaImg'>Compartir por correo</button>
                                        </form>
                                </div>
                                <div>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Imagenes"]}'>Descargar imágenes</a> <br>
                                    <a class='btn btn-primary' role='button' href='{$row["Direccion"]}{$row["Informes"]}'>Descargar informe</a> 
                                    
                                </div>
                            </div>
                        </div>";
                } 
            }else{
                echo "<br><div id='MensSinHoras' class='CuadHoras'>El historial de exámenes de imagenlogía está vacio. Si quiere consultar sus exámenes agendados, seleccione 'Consultar Exámenes Agendados' en el menú de Exámenes de imagenología.</div>";
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