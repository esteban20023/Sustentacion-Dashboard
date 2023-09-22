<?php
include_once'../Models/conexion.php';
$username = $_POST['Identificacion'];
$password = $_POST['Password'];
$rol = $_POST['Rol'];

$sql = "SELECT * FROM usuarios WHERE usuDocumento = '$username' AND Contrasena = '$password' ";
 $result = $mysqli->query($sql);

 if($result->num_rows == 0){
    $mensaje = 'Consulta no valida:'. mysqli_error($mysqli). "\n";
    header("Location: ../index.php");
 }

 while ( $row = mysqli_fetch_assoc($result)){
    if($rol == 1){
        header('location: ../Views/Cliente/index.php');
    }else if($rol == 2 ){
       header("Location: ../Views/Administrador/index.php");
    }else{
        header ("Location: ../index.php");
    }
    echo "Exito";
}
?>
