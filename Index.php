<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/StyleLogIn.css">
</head>
<body>
  <br><br>
  <h1>Portal reservas y resultados Clínica Cuidad del Mar</h1>
  <br><br>
  <div class="FormuIngre" id="Creausu" style="display:none;">
    <h3>Crear usuario</h3><br>
    <form action="Index.php" method="post">
      <div class="FormContene">
        <label>Nombres:</label>
        <input type="text" placeholder="Nombre" id="Nom" name="Nom" pattern="[a-zA-ZÀ-ž\s]+" required oninvalid="this.setCustomValidity('Debe incluir nombres compuestos de solo letras.')" oninput="setCustomValidity('')">
      </div>
      <div class="FormContene">
        <label>Apellidos:</label>
        <input type="text" placeholder="Apellido" id="Apell" name="Apell" pattern="[a-zA-ZÀ-ž\s]+" required oninvalid="this.setCustomValidity('Debe incluir apellidos compuestos de solo letras.')" oninput="setCustomValidity('')">
      </div>
      <div class="FormContene">
        <label for="">Rut:</label>
        <input type="text" placeholder="10000000-0" id="Rut" name="Rut" pattern="[0-9]{7,}-[0-9Kk]{1}" required oninvalid="this.setCustomValidity('Debe incluir el rut sin puntos, con guion y dígito verificador.')" oninput="setCustomValidity('')">
      </div>
      <div class="FormContene">
        <label for="">Telefono:</label>
        <input type="tel" placeholder="912345678" id="Telef" name="Telef" pattern="[0-9]{9}" required oninvalid="this.setCustomValidity('Debe incluir un telefono compuesto de 9 números.')" oninput="setCustomValidity('')">
      </div>
      <div class="FormContene">
        <label for="">Email:</label>
        <input type="email" placeholder="ejemplo@ejemplo.com" id="Correo" name="Correo" required oninvalid="this.setCustomValidity('El correo debe seguir el formato de ejemplo@ejemplo.com.')" oninput="setCustomValidity('')">
      </div>
      <div class="FormContene">
        <label for="">Contraseña:</label>
        <input type="password" placeholder="Contraseña" id="Contra" name="Contra" required oninvalid="this.setCustomValidity('Debe crear una contraseña.')" oninput="setCustomValidity('')">
      </div><br>
      <input type="submit" value="Crear usuario" name="Creausu" class="btn btn-primary">
    </form>
    <div class="Espacio">
      ---------------
    </div>
    <div class="OtraOpcion">
      <p>¿Ya tiene una cuenta?</p>
      <button id="IniciarOpcion">Iniciar sesión</button>
    </div>  
  </div>

    <div class="FormuIngre" id="IniSes">
      <h3>Iniciar sesión</h3><br>
      <form action="Index.php" method="post">
        <div class="FormContene">
          <label>Rut:</label>
          <input type="text" placeholder="Ingrese Rut" id="Rut" name="Rut" pattern="[0-9]{7,}-[0-9Kk]{1}" required oninvalid="this.setCustomValidity('Ingrese su Rut sin puntos, con guion y dígito verificador.')" oninput="setCustomValidity('')">
        </div>
        <div class="FormContene">
          <label>Contraseña:</label>
          <input type="password" placeholder="Ingrese contraseña" id="Contra" name="Contra" required oninvalid="this.setCustomValidity('Ingrese su contraseña.')" oninput="setCustomValidity('')">
        </div><br>
        <input type="submit" value="Ingresar" name="IniSes" class="btn btn-primary" >
      </form>
    <div class="Espacio">
      ---------------
    </div>
    <div class="OtraOpcion">
      <p>¿No tiene una cuenta?</p>
      <button id="CrearOpcion">Crear cuenta</button>
    </div>
  </div>
  <script src="JScriptLogin.js"></script>
</body>
</html>

<?php
include "ConecServ.php";

if(isset($_POST['Creausu'])){
    $nomIng=$_POST['Nom'];
    $apellIng=$_POST['Apell'];
    $rutIng=$_POST['Rut'];
    $teleIng=$_POST['Telef'];
    $correoIng=$_POST['Correo'];
    $contraIng=$_POST['Contra'];
    $contraIng=md5($contraIng);

    $confirmUsu="SELECT * FROM usuarios WHERE Rut='$rutIng'";
    $result=$conn->query($confirmUsu);
    if($result->num_rows>0){
      echo "<br><br><br><br><br><br><div class='MensError'>Rut ingresado ya tiene usuario creado. Intente iniciar sesión.</div>";
    } else{
      $inserDatos="INSET INTO `usuarios`(`ID`, `Nombres`, `Apellidos`, `Rut`, `Contraseña`, `Telefono`, `Correo`) VALUES ('NULL','$nomIng','$apellIng','$rutIng','$contraIng','$teleIng','$correoIng')";
      if($conn->query($inserDatos)==TRUE){
        echo "<br><br><br><br><br><br><div class='MensCreaUsu'>Se ha creado su usuario. Intente iniciar sesión.</div>";
      }
    }
}

if(isset($_POST['IniSes'])){
    $rutIng=$_POST['Rut'];
    $contraIng=$_POST['Contra'];
    $contraIng=md5($contraIng);

    $buscUsu="SELECT * FROM usuarios WHERE Rut='$rutIng' AND Contraseña='$contraIng'";
    $result=$conn->query($buscUsu);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['Rut']=$row['Rut'];
        $_SESSION['ID_Usu']=$row['ID'];
        header("Location:SelecConform.php");
        exit();
    } else{
      echo "<br><br><br><br><br><br><div class='MensError'>Rut y/o contraseña incorrecta. Intente denuevo.</div>";
    }
}
?>