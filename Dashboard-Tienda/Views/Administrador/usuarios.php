<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_administrador/usuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Crear empleado</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="../Administrador/index.php">
                                <i class="fas fa-home"></i>
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/usuarios.php">
                                <i class="fas fa-users"></i>
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/empleado.php">
                                <i class="fas fa-user-tie"></i>
                                Empleados
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/inventario.php">
                                <i class="fas fa-box"></i>
                                Inventario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/productos.php">
                                <i class="fas fa-cube"></i>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/servicios.php">
                                <i class="fas fa-wrench"></i>
                                Servicios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/orden-compra.php">
                                <i class="fas fa-file-alt"></i>
                                Orden de Compra
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/pedidos.php">
                                <i class="fas fa-shopping-cart"></i>
                                Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Administrador/envios.php">
                                <i class="fas fa-shipping-fast"></i>
                                Envíos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 p-2 content">
                <h1>Usuarios registrados</h1>
                <?php
                $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
                $mysqli->set_charset("utf8");

                if ($mysqli->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }

                // Manejar el filtro si se ha enviado
                if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
                    $filtro = $_GET['filtro'];
                    $query = "SELECT * FROM ordencompra WHERE usuNombre LIKE '%$filtro%'";
                } else {
                    $query = "SELECT * FROM Usuarios";
                }

                $result = $mysqli->query($query);

                //filtro para buscar algun usuario a editar, eliminar, actualizar 

                echo '<form method="GET" action="">
                    <input type="text" name="filtro" placeholder="Buscar por Nombre">
                    <i class="fas fa-search btn btn-outline-dark"></i>
                </form> <br>';

                // Mostrar los registros que se han hecho en la tabla usuarios
                echo "<table class='table table-bordered'border='1'>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Tipo de Documento</th>
                    <th>Número de Documento</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Dirección</th>
                    <th>Género</th>
                    <th>Contraseña</th>
                    <th>Editar/Eliminar</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row['idUsuario'] . "</td>
                    <td>" . $row['usuNombre'] . "</td>
                    <td>" . $row['usuApellido'] . "</td>
                    <td>" . $row['usuTipoDocumento'] . "</td>
                    <td>" . $row['usuDocumento'] . "</td>
                    <td>" . $row['usuTelefono'] . "</td>
                    <td>" . $row['usuCorreo'] . "</td>
                    <td>" . $row['usuDireccion'] . "</td>
                    <td>" . $row['usuGenero'] . "</td>
                    <td>" . $row['idCiudad'] . "</td>
                    <td><a class='btn btn-warning' href='editar.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i></a> | <a class=' btn btn-danger' href='eliminar.php?id=" . $row['id'] . "'><i class='fas fa-trash-alt'></i></a></td>
                </tr>";
                }

                echo "</table>";

                $result->free();
                $mysqli->close();
                ?>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js">
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        sidebar.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                content.innerHTML = `<h1>${e.target.innerText}</h1>`;
            }
        });
    </script>
</body>

</html>