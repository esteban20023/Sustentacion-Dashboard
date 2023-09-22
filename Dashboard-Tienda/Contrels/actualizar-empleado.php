<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    // Actualiza los demás campos según sea necesario

    $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
    $mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $query = "UPDATE tu_tabla SET Nombre=?, Apellidos=?, ... WHERE id=?";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssi...", $nombre, $apellidos,$id);
    
    if ($stmt->execute()) {
        echo "Registro actualizado exitosamente.";
    } else {
        echo "Error al actualizar el registro: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!-- Formulario para editar un registro existente -->
<form method="POST" action="">
    <input type="hidden" name="id" value="ID_DEL_REGISTRO_A_EDITAR">
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="apellidos" placeholder="Apellidos">
    <!-- Otros campos aquí -->
    <input type="submit" value="Actualizar Registro">
</form>
