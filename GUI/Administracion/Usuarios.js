function llenarSelect( nombreSelect, perfiles )
{
    var select = document.getElementById( nombreSelect );

    for ( value in perfiles )
    {
        var option = document.createElement( "option" );
        option.value = perfiles[ value ].id;
        option.text = perfiles[ value ].nombrePerfil;
        select.add( option );
    }

}

var exampleModal = document.getElementById( 'modalConfirmacion' );
exampleModal.addEventListener( 'show.bs.modal', function ( event )
{
    // Extract info from data-bs-* attributes
    var id = event.relatedTarget.getAttribute( 'data-bs-whatever' );

    // Update the modal's content.
    $( "#idUsuarioContenedor" ).html( `<input input type="number" class="form-control " id="idUsuario" name="idUsuario" value="${registros[ id ].id}" hidden>` );
} );

function eliminarUsuario()
{
    var idUsuario = $( "#idUsuario" ).val();
    alert( idUsuario );
    $.post( "../../BL/Usuario/DesactivarUsuario.php", { id: idUsuario }, function ( data )
    {

        $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                                        <div id="notificacion" class="toast align-items-center text-white ${data == 1 ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                            <div class="d-flex">
                                                                <div class="toast-body">
                                                                    ${data == 1 ? "<b>Usuario</b> eliminado correctamente" : "Ocurrió un error al intentar eliminar al usuario"}
                                                                </div>
                                                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                    </div>`);
        mostrarNotificacion();

    } );
}

function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}