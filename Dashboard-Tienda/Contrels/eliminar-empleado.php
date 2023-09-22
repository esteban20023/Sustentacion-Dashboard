<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
    $mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $query = "DELETE FROM tu_tabla WHERE id=?";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!-- Enlace para eliminar un registro -->
<a href="eliminar.php?id=ID_DEL_REGISTRO_A_ELIMINAR">Eliminar Registro</a>
