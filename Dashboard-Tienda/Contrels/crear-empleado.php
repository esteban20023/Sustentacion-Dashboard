<?php
$mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre = $_POST["Nombre"];
    $Apellidos = $_POST["Apellido"];
    $Edad = $_POST["Edad"];
    $FechaNacimiento = $_POST["Fecha_Nacimiento"];
    $Direccion = $_POST["Direccion"];
    $Tipo_Documento = $_POST["Tipo_Documento"];
    $Numero_Documento = $_POST["Numero_Documento"];
    $Telefono = $_POST["Telefono"];
    $Tipo_Contrato = $_POST["Tipo_Contrato"];
    $Sueldo = $_POST["Sueldo"];
    $Cargo = $_POST["Cargo"];

    $sql = "SELECT * FROM empleados WHERE NumeroDocumento='$Numero_Documento'";

    $query = "INSERT INTO empleados (Nombre, Apellidos, Edad, Fecha_Nacimiento, Direccion, Tipo_Documento, Numero_Documento, Telefono, Tipo_Contrato, Sueldo, Cargo,) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssisssssssss", $Nombre, $Apellidos, $Edad, $Fecha_Nacimiento, $Direccion, $Tipo_Documento, $Numero_Documento, $Telefono, $Tipo_Contrato, $Sueldo, $Cargo);
    
    if ($stmt->execute()) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error al crear el registro: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!-- Formulario para crear un nuevo registro
<form method="POST" action="">
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="apellidos" placeholder="Apellidos">
    Otros campos aquí
    <input type="submit" value="Crear Registro">
</form> -->
