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
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StylePerfil.css">
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
        <?php
        $query=mysqli_query($conn, "SELECT * FROM usuarios WHERE Rut='$RutUsu'");
        while($row=mysqli_fetch_array($query)){
            $NomUsu=$row['Nombres'];
            $ApellUsu=$row['Apellidos'];
            $TelefUsu=$row['Telefono'];
            $CorreoUsu=$row['Correo'];
        }
        ?>
        <div class="cuadrDatos">
            <form action="PerfilUsu.php" method="POST" name="ActualiUsu">
                <div class="FormContene">
                    <label>Nombres:</label>
                    <input type="text" value="<?php echo $NomUsu;?>" id="Nom" name="Nom" pattern="[a-zA-ZÀ-ž\s]+" required oninvalid="this.setCustomValidity('Debe incluir nombres compuestos de solo letras.')" oninput="setCustomValidity('')">
                </div>
                <div class="FormContene">
                    <label>Apellidos:</label>
                    <input type="text" value="<?php echo $ApellUsu;?>" id="Apell" name="Apell" pattern="[a-zA-ZÀ-ž\s]+" required oninvalid="this.setCustomValidity('Debe incluir apellidos compuestos de solo letras.')" oninput="setCustomValidity('')">
                </div>
                <div class="FormContene">
                    <label for="">Telefono:</label>
                    <input type="tel" value="<?php echo $TelefUsu;?>" id="Telef" name="Telef" pattern="[0-9]{9}" required oninvalid="this.setCustomValidity('Debe incluir un telefono compuesto de 9 números.')" oninput="setCustomValidity('')">
                </div>
                <div class="FormContene">
                    <label for="">Email:</label>
                    <input type="email" value="<?php echo $CorreoUsu;?>" id="Correo" name="Correo" required oninvalid="this.setCustomValidity('El correo debe seguir el formato de ejemplo@ejemplo.com.')" oninput="setCustomValidity('')">
                </div><br>
                <input type="submit" class="btn btn-primary" value="Actualizar datos" name="ActualiUsu"> 
            </form>
        </div>
        <div class="cerrSes"><a class="btn btn-danger" href="LogOut.php" role="button">Cerrar sesión</a></div>
    </main>
    <footer>
        <a href="https://www.ccdm.cl/" >WWW.CCDM.CL</a> <a href=""> 32 245 1000</a>
        <div class="FootDere">
            <a href="https://www.facebook.com/ciudaddelmar/?locale=es_LA"> <img class="LogosExter" src="footer-facebook.png" alt="Logo de Facebook"></a> <a href="https://www.instagram.com/clinicaciudaddelmar/?hl=es"><img class="LogosExter" src="footer-instagram.png" alt="Logo de Instagram"></a>
        </div>
    </footer>
  </body>
</html>

<?php
if(isset($_POST["ActualiUsu"])){
    $nomIng=$_POST['Nom'];
    $apellIng=$_POST['Apell'];
    $teleIng=$_POST['Telef'];
    $correoIng=$_POST['Correo'];
    $IDUsu=$_SESSION['ID_Usu'];

    $actualiDatos="UPDATE usuarios SET Nombres='$nomIng', Apellidos='$apellIng', Telefono='$teleIng', Correo='$correoIng' WHERE ID=$IDUsu";
    if($conn->query($actualiDatos)===TRUE){
        echo "<br><br><div class='MensActua'>Se han actualizado los datos.</div>";
    }
}
?>