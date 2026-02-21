<?php
session_start();
include("ConecServ.php");

if(isset($_POST["submit"])){
    $targetDir="uploads/";
    $targetFile=$targetDir.basename($_FILES["pdfFile"]["name"]);
    $fileType=strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)){
        $filename=$_FILES["pdfFile"]["name"];
        $folderPath=$targetDir;
        $sql="INSERT INTO `result_img`(`ID`, `ID_Examen`, `Imagenes`, `Informe`) VALUES ('NULL', 2, '$folderPath', '$filename')";

        if ($conn->query($sql)===TRUE){
            ECHO "se subio";
        } else {
            echo "error sql";
        }
    } else {
        echo "error subir";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="pdfFile">
        <button type="submit" name="submit">upload</button>
    </form>
</body>
</html>

<?php

$sql2="SELECT * FROM `result_img`";
$resul=mysqli_query($conn, $sql2);
while ($row=mysqli_fetch_array($resul)){
    echo "<a href='{$row["Imagenes"]}{$row["Informe"]}'> click</a><br>";
}
?>
