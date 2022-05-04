$(document).ready(function() {
    $("#nuevoUsuario").click(NuevoUsuario);
});

function NuevoUsuario()
{
    var cedula =  $("#cedula").val();
    var nombre =  $("#nombre").val();
    var apellido1 =  $("#apellido1").val();
    var apellido2 =  $("#apellido2").val();
    var correo = $("#correo").val();
    var contrasena = $("#password").val();
    var perfil = $("#perfil").val();

    $.post("../../BL/Usuario/NuevoUsuario.php", 
    {
        cedulaUsuario : cedula,
        nombreUsuario : nombre,
        apellido1Usuario : apellido1,
        apellido2Usuario : apellido2,
        correoUsuario : correo,
        contrasenaUsuario : contrasena,
        perfilUsuario: perfil
    });
}