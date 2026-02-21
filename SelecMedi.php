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
    <title>Seleción de médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/styleSelecMedi.css">
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
            <a href="PagIni.php">Inicio</a> > <a href="AgendHoraMedi.php">Agenda horas médicas</a> > <a href="SelecMedi.php">Seleción de médico</a>
        </div>
        <?php
        if (isset($_POST['BuscaMed'])){
            $SelecPrevi=$_POST['Presta'];
            $SelecEspec=$_POST['Espec'];
        
            $sql= "SELECT Nombres, NomPrevic, NomEspec FROM datosdoctores LEFT JOIN previcionesdocs ON (datosdoctores.ID=ID_DocsP) LEFT JOIN previciones ON (previciones.ID=ID_Previc) LEFT JOIN especialidadedocs ON (datosdoctores.ID=ID_DocsE)LEFT JOIN especialidades ON (especialidades.ID=ID_Espec) WHERE previciones.ID=$SelecPrevi and especialidades.ID=$SelecEspec";
            $resul=mysqli_query($conn, $sql);
            if ($resul->num_rows>0){
                while ($row=mysqli_fetch_array($resul)){
                    echo "<div class='Botones'>
                            <form action='SelecFechaMedi.php' method='post'>
                                <button type='submit' name='Medic'>
                                    <div class='Container'>
                                        <input type='hidden' name='NomMedi' value='{$row["Nombres"]}'>
                                        <input type='hidden' name='NomEspec' value='{$row["NomEspec"]}'>
                                        <div><img src='icon\FotoMedicos {$row["Nombres"]}.jpg' alt='Foto médico'></div>
                                        <div><p>{$row["Nombres"]} <br> <br> {$row["NomEspec"]}</p></div>
                                    </div>
                                </button>
                            </form>
                            </div>";
                }
            } else{
                echo "<br><br><br><div class='MenSinMed'><p> Lo sentimos no hay médicos que atiendan por la previción selecionada, intente selecionando la opción particular. </p></div>";
            }
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