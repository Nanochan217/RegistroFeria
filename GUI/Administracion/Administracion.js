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

function BuscarTodosUsuario()
{
    var solicitudUsuario = new XMLHttpRequest();

    xmlhttp.onload = function() 
    {
        var usuario = JSON.parse(this.responseText);
        var value = "";

        for (var i in usuario) {
            //value += "<td>" + usuario[i].'nombre del campo de la fila' + "</td>";
        }
        document.getElementById("ID-ETIQUETA").innerHTML = value;
    }

    solicitudUsuario.open("POST", "../../BL/Usuario/BuscarTodosUsuario.php");
    solicitudUsuario.send();
}
