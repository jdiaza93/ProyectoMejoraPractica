<?php
include "ConecServ.php";
if(isset($_POST["ConfirmHoraMed"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_medicos SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}

if(isset($_POST["ConfirmHoraReso"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_resonancia SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}

if(isset($_POST["ConfirmHoraTac"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_scanner SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}

if(isset($_POST["ConfirmHoraEco"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_ecografia SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}

if(isset($_POST["ConfirmHoraDensi"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_densitometria SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}

if(isset($_POST["ConfirmHoraHol"])){
    $IdHora=$_POST["IdHora"];
    $cambioEstado="UPDATE horas_holter SET Estado='Confirmada' WHERE ID=$IdHora";
    if($conn->query($cambioEstado)===TRUE){
        ?>
        <script type="text/javascript">
        alert('Su cita ha sido confirmada.');
        window.location='PagIni.php'
        </script>
        <?PHP
    } else{
        ?>
        <script type="text/javascript">
        alert('Hubo un error al confirmar su cita.');
        window.location='PagIni.php'
        </script>
        <?PHP
    }
}
?>