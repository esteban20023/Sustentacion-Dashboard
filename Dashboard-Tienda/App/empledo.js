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