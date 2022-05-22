$(document).ready(function () { 
    //Funcion del Boton de Ingresar en el Log In... por algún motivo
    //no envía por post las variables de correoPost y contrasenaPost
    //OJO: en el BL de Nueva Sesión estan las id de los inputs directamente
    //desde el HTML para hacer uso del LogIn
//    $("#logIn").click(function (){
//        var correoUsuario = $("#usuario").val();
//        var contrasenaUsuario = $("#password").val();
//        
//        $.post("../../BL/LogIn/NuevaSesion.php", {
//            correoPost : correoUsuario,
//            contrasenaPost : contrasenaUsuario
//        },
//        function (respuesta) { $("#errorLogin").html(respuesta); });
//    });
    
    //Falta la Confirmación del Correo Electrónico
    $("#nuevaContrasena").click(function () {
        var correoUsuario = $("#PENDIENTE").val();
        var nuevaContrasena1 = $("#newPassword1").val();
        var nuevaContrasena2 = $("#newPassword2").val();
        $.post("../../BL/LogIn/NuevaContrasena.php", { 
            correo : correoUsuario,
            contrasena1 : nuevaContrasena1, 
            contrasena2 : nuevaContrasena2 
        },
        function (resultado) { $("#etiqueta").html(resultado); });
    });
});