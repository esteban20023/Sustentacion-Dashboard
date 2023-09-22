<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_administrador/empleado.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Empleados</title>
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
                            <a class="nav-link" href="../Administrador/pedidos.php">
                                <i class="fas fa-shipping-fast"></i>
                                Envíos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9  content">
                <!-- CREACION DEL FORMULARIO DEL REGISTRO DEL EMPLEADO -->
                <div class="container">
                    <h2>Registro empleados</h2>
                    <form action="/Contrels/crear-empleado.php" method="POST">
                        <div style="float: left; width: 33%;">
                            <label for="nombre">Nombre:</label><br>
                            <input type="text" name="Nombre" id="Nombre" required><br>

                            <label for="apellidos">Apellidos:</label><br>
                            <input type="text" name="Apellidos" id="Apellidos" required><br>

                            <label for="edad">Edad:</label><br>
                            <input type="number" name="Edad" id="Edad" required><br>

                            <label for="Fecha_Nacimiento">Fecha de Nacimiento:</label><br>
                            <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" required style="height: 2rem; width: 12rem;"><br>
                        </div>

                        <div style="float: left; width: 33%;">
                            <label for="direccion">Dirección:</label><br>
                            <input type="text" name="Direccion" id="Direccion" required><br>

                            <label for="Tipo_Documento">Tipo de Documento:</label><br>
                            <select name="Tipo_Documento" id="Tipo_Documento" style="height: 2rem; width: 12rem;">
                                <option value="1">Cedula</option>
                                <option value="2">Tarjeta de identidad</option>
                                <option value="3">Cedula extrangeria</option>
                            </select><br>

                            <label for="Numero_Documento">Número de Documento:</label>
                            <input type="text" name="Numero_Documento" id="Numero_Documento" required><br>

                            <label for="telefono">Teléfono:</label><br>
                            <input type="tel" name="telefono" required><br>
                        </div>

                        <div style="float: left; width: 33%;">
                            <label for="Tipo_Contrato">Tipo de Contrato:</label><br>
                            <input type="text" name="Tipo_Contrato" id="Tipo_Contrato" required><br>

                            <label for="Sueldo">Sueldo:</label><br>
                            <input type="number" name="Sueldo" id="Sueldo" required><br>

                            <label for="Cargo">Cargo:</label><br>
                            <input type="text" name="Cargo" id="Cargo" required><br><br>
                            <button onclick="Guardar()" class="btn btn-danger boton" type="button">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                            <button onclick="location.reload();" class="btn btn-success boton">
                                <i class="fas fa-sync"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
                <legend>__________________________________________________________________________________________</legend>

                <!-- TITULO DE EMPLEADOS REGISTRADOS -->
                <h2>Empleados registrados</h2>
                <!--CRUD PARA EL LLAMADO DE LOS DATOS DE LAS BASES DE DATOS   -->
                <?php
                $mysqli = new mysqli("localhost", "root", "Sena23", "gpamotors");
                $mysqli->set_charset("utf8");
                if ($mysqli->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
                    $filtro = $_GET['filtro'];
                    $query = "SELECT * FROM empleados WHERE Nombre LIKE '%$filtro%'";
                } else {
                    $query = "SELECT * FROM empleados";
                }

                $result = $mysqli->query($query);

                //filtro para buscar algun usuario a editar, eliminar, actualizar 

                echo '<form method="GET" action="">
                    <input type="text" name="filtro" placeholder="Buscar por Nombre">
                    <i class="fas fa-search btn btn-outline-dark"></i>
                </form> <br>';

                echo "<table class='table table-info table-striped-columns' border=''>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Dirección</th>
                    <th>Tipo de Documento</th>
                    <th>Número de Documento</th>
                    <th>Teléfono</th>
                    <th>Cargo</th>
                    <th>Editar/Eliminar</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['Nombre'] . "</td>
                    <td>" . $row['Apellidos'] . "</td>
                    <td>" . $row['Edad'] . "</td>
                    <td>" . $row['Direccion'] . "</td>
                    <td>" . $row['Tipo_Documento'] . "</td>
                    <td>" . $row['Numero_Documento'] . "</td>
                    <td>" . $row['Telefono'] . "</td>
                    <td>" . $row['Cargo'] . "</td>
                    <td><a class='btn btn-warning icon' href='editar.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i></a> | <a class=' btn btn-danger icon' href='eliminar.php?id=" . $row['id'] . "'><i class='fas fa-trash-alt'></i></a></td>
                 </tr>";
                }
                echo "</table>";
                $result->free_result();
                $mysqli->close();
                ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        sidebar.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                content.innerHTML = `<h1>${e.target.innerText}</h1>`;
            }
        });
    </script>
    <!-- <script>
        function reloadPage() {
            location.reload();
        }
    </script> -->
    <script>
    function Guardar (){
    let Nombres = $('#Nombre').val();
    let Apellidos = $('#Apellidos').val();
    let Edad = $('#Edad').val();
    let Fecha_Nacimiento = $('#Fecha_Nacimiento').val();
    let Direccion = $('#Direccion').val();
    let Tipo_Documento = $('#Tipo_Documento').val();
    let Numero_Documento =$('#Numero_Documento').val();
    let Telefono =$('#Telefono').val();
    let Tipo_Contrato = $('#Tipo_Contrato').val();
    let Sueldo = $('#Sueldo').val();
    let Cargo = $('#Cargo').val();

    // console.log('abuela');
    // console.log(nombre + tipoDocumento + email + direccion + password + apellido + documento + telefono + genero + confirmarContraseña);

    if (Nombres == null || Nombres == undefined || Nombres == ''){
        alert("Ingrese el Nombre");
        return false;
    }
    if (Apellidos == null || Apellidos == undefined || Apellidos == ''){
        alert("Ingrese Apellidos");
        return false;
    }
    if (Edad == null || Edad == undefined || Edad == ''){
        alert("Ingrese la edad");
        return false;
    }
    if (Fecha_Nacimiento == null || Fecha_Nacimiento == undefined || Fecha_Nacimiento == ''){
        alert("Ingrese fecha de nacimiento");
        return false;
    }
    if (Direccion == null || Direccion == undefined || Direccion == ''){
        alert("Ingrese la Dirección");
        return false;
    }
    if (Tipo_Documento == null || Tipo_Documento == undefined || Tipo_Documento == ''){
        alert("Ingrese  tipo de documento");
        return false;
    }
    if (Numero_Documento == null || Numero_Documento == undefined || Numero_Documento == ''){
        alert("Ingrese  numero de documento");
        return false;
    }
    if (Telefono == null || Telefono == undefined || Telefono == ''){
        alert("Ingrese Teléfono");
        return false;
    }
    if (Tipo_Contrato == null || Tipo_Contrato == undefined || Tipo_Contrato ==''){
        alert("Seleccione el tipo de contrato");
        return false;
    }
    if (Sueldo == null || Sueldo == undefined || Sueldo == ''){
        alert("Seleccione el Sueldo");
        return false;
    }
    if (Cargo == null || Cargo == undefined || Cargo == ''){
        alert("Ingrese el cargo");
        return false;
    }


    $.ajax({
        url: `../Contrels/crear-empleado.php?nombre=${Nombres}&Apellidos=${Apellidos}&Edad=${Edad}&Fecha_Nacimiento=${Fecha_Nacimiento}&Direccion=${Direccion}&Tipo_Documento=${Tipo_Documento}&Numero_Documento=${Numero_Documento}&Telefono=${Telefono}&Tipo_Contrato=${Tipo_Contrato}&Sueldo=${Sueldo}`,
        type :'get',
        dataType: 'json',
        success: function (json) {       
           console.log(json);
           if(json==0){
            alert('El usuario ya se encuentra registrado');
           }else{
            alert('Usuario registrado con exito');
            // location.href = '../vistas/login.html';
           }
        },
        error: function (xhr, status) {
            // console.log('Disculpe, existió un problema');
            // $('#titulo').html('Correo Registrado Correctamente');
            // location.href = '../vistas/login.html';
    
    
        },
        // código a ejecutar sin importar si la petición falló o no
        complete: function (xhr, status) {
            //console.log('Consulta hecha');
            }
        });
}
    </script>
</body>

</html>