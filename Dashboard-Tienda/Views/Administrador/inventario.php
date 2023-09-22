<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_administrador/inventario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Inventario</title>
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
                <div class="container mt-4">
                    <h2>Formulario de Producto</h2>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombreProducto">Nombre del producto</label>
                                    <input type="text" class="form-control" id="nombreProducto" name="nombreProducto">
                                </div>
                                <div class="form-group">
                                    <label for="referencia">Referencia del producto</label>
                                    <input type="text" class="form-control" id="referencia" name="referencia">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                </div>
                                <div class="form-group">
                                    <label for="precioUnitario">Precio Unitario</label>
                                    <input type="number" class="form-control" id="precioUnitario" name="precioUnitario">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca">
                                </div>
                                <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" class="form-control" id="proveedor" name="proveedor">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="idCategoria">ID de Categoría</label><br>
                                    <select id="idCategoria" name="idCategoria" style="height: 2.3rem; width: 12rem; border-radius: 5px;">
                                        <option value="1">Indumentaria</option>
                                        <option value="2">Repuestos</option>
                                        <option value="3">Accesorios</option>
                                    </select>
                                </div><br>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-save"></i> Guardar
                                </button><br>
                                <!-- <button type="submit" onclick="location.reload();" class="btn btn-success">
                                    <i class="fas fa-sync"></i> Actualizar
                                </button> -->
                                
                            </div>
                        </div>
                    </form>
                </div>
                <legend>______________________________________________________________________________________________</legend>
                <h1>Inventario registrado</h1>
                <?php
                $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
                $mysqli->set_charset("utf8");
                if ($mysqli->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                // Manejar el filtro si se ha enviado
                if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
                    $filtro = $_GET['filtro'];
                    $query = "SELECT * FROM tu_tabla WHERE usuNombre LIKE '%$filtro%'";
                } else {
                    $query = "SELECT * FROM Usuarios";
                }

                $result = $mysqli->query($query);

                //filtro para buscar algun usuario a editar, eliminar, actualizar 

                echo '<form method="GET" action="">
                    <input type="text" name="filtro" placeholder="Buscar por Nombre">
                    <i class="fas fa-search btn btn-outline-dark"></i>
                </form> <br>';
                if ($result) {
                    echo "<table  class='table table-bordered' border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Referencia</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Marca</th>
                    <th>Proveedor</th>
                    <th>ID de la Categoría</th>
                    <th>Editar/Eliminar</th>
                </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row['idProducto'] . "</td>
                    <td>" . $row['proNombre'] . "</td>
                    <td>" . $row['proReferencia'] . "</td>
                    <td>" . $row['proCantidad'] . "</td>
                    <td>" . $row['proPrecioUnitario'] . "</td>
                    <td>" . $row['proMarca'] . "</td>
                    <td>" . $row['proProveedor'] . "</td>
                    <td>" . $row['idcategoria'] . "</td>
                    <td><a class='btn btn-warning' href='editar.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i></a> | <a class=' btn btn-danger' href='eliminar.php?id=" . $row['id'] . "'><i class='fas fa-trash-alt'></i></a></td>
                </tr>";
                    }

                    echo "</table>";
                    $result->free();
                }

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
    <script>
         function reloadPage() {
            location.reload();
        }
    </script>
</body>

</html>