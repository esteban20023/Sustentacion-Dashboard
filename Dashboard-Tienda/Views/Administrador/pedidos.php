<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_administrador/pedidos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Pedidos</title>
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

            <main role="main" class="col-md-9 p-4 content">
                <h1>Pedidos</h1>
                <?php
                $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
                $mysqli->set_charset("utf8");

                if ($mysqli->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }

                // Manejar el filtro 
                if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
                    $filtro = $_GET['filtro'];
                    $query = "SELECT * FROM ordencompra WHERE ordProducto LIKE '%$filtro%' OR ordServicio LIKE '%$filtro%'";
                } else {
                    $query = "SELECT * FROM ordencompra";
                }

                $result = $mysqli->query($query);

                // Mostrar el formulario de filtro
                echo '<form method="GET" action="">
                <input type="text" name="filtro" placeholder="Filtrar por Producto o Servicio">
                <input type="submit" value="Filtrar">
            </form>';

                // Mostrar los registros en una tabla HTML
                echo "<table class='table table-bordered' border='1'>
                <tr>
                    <th>ID Orden de Compra</th>
                    <th>Producto</th>
                    <th>Servicio</th>
                    <th>Fecha de Compra</th>
                    <th>ID Detalles de Compra</th>
                    <th>ID Envío</th>
                    <th>ID Usuario</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row['idOrdenCompra'] . "</td>
                    <td>" . $row['ordProducto'] . "</td>
                    <td>" . $row['ordServicio'] . "</td>
                    <td>" . $row['ordFechaCompra'] . "</td>
                    <td>" . $row['idDetallesCompra'] . "</td>
                    <td>" . $row['idEnvio'] . "</td>
                    <td>" . $row['idUsuario'] . "</td>
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