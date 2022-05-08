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
    console.log( id );

    // Update the modal's content.
    $( "#modalBody" ).html( `<h6>Cedula: ${registros[ id ].cedula}</h6>
                                <h6>Nombre: ${registros[ id ].nombre + " " + registros[ id ].apellido1 + " " + registros[ id ].apellido2}</h6>
                                <h6>Correo: ${registros[ id ].correo}</h6>
                                <h6>Perfil: ${registros[ id ].perfil}</h6>` );

} );