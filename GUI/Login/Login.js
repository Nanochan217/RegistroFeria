$(document).ready(function () {        
    $("#logIn").click(function (){
        var correoUsuario = $("#usuario").val();
        var contrasenaUsuario = $("#password").val();
        
        $.post("../../BL/LogIn/NuevaSesion.php", {
            correoLogIn : correoUsuario,
            contrasenaLogIn : contrasenaUsuario
        },
        function (respuesta) { $("#errorLogin").html(respuesta); });        
        return false;        
    });
    
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