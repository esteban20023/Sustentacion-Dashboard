<?php
// Establecer la conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
$mysqli->set_charset("utf8");

// Verificar la conexión
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Manejar el envío del formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // Contraseña sin cifrar

    // Encriptar la contraseña utilizando password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL para insertar el registro en la tabla de usuarios
    $query = "INSERT INTO tu_tabla (usuNombre, usuApellido, usuCorreo, usuContrasena) VALUES (?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssss", $nombre, $apellidos, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error al crear el registro: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>

<!-- Formulario para registrar un nuevo usuario -->
<form method="POST" action="">
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="apellidos" placeholder="Apellidos">
    <input type="email" name="email" placeholder="Correo Electrónico">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="submit" value="Registrar">
</form>
