$( document ).ready( function ()
{
    $( "#logIn" ).click( function ()
    {
        var correoUsuario = $( "#usuario" ).val();
        var contrasenaUsuario = $( "#password" ).val();

        $.post( "../../BL/LogIn/NuevaSesion.php", {
            correoPost: correoUsuario,
            contrasenaPost: contrasenaUsuario
        },
            function ( respuesta )
            {
                if ( respuesta == "" )
                {
                    window.location = "../../GUI/Index/Index.php";
                }
                else
                {
                    $( "#errorLogin" ).html( respuesta );
                }
            } );
    } );

    //Falta la Confirmación del Correo Electrónico
    $( "#cambiarContrasena" ).click( function ()
    {
        var correoUsuario = $( "#PENDIENTE" ).val();
        var nuevaContrasena1 = $( "#newPassword1" ).val();
        var nuevaContrasena2 = $( "#newPassword2" ).val();
        $.post( "../../BL/LogIn/NuevaContrasena.php", {
            correo: correoUsuario,
            contrasena1: nuevaContrasena1,
            contrasena2: nuevaContrasena2
        },
            function ( data )
            {
                if ( data == 1 )
                {
                    $( "#mostrarModal" ).click();
                }
                else
                {
                    $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == 2 ? "bg-warning" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == 2 ? "Las contraseñas no coinciden" : "Ocurrió un error al intentar actualizar las contraseñas"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
                    mostrarNotificacion();
                }

            } );
    } );
} );

function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}