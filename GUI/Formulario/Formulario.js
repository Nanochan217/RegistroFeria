var acompanantes = [];
var maxAcompanantes = 3;

$( document ).ready( function ()
{
    // // Al marcar que si van a haber acompañantes;
    // $( "#acompananteSI" ).click( function ()
    // {
    //     mostrarAcompanantes();
    //     $( '#addAcompanante' ).attr( 'style', 'display:grid !important' ); //mostrar el botón de agregar acompañante
    //     mostrarMensaje(); //si se alcanzó el máximo de acompañantes se muestra el mensaje
    //     if ( acompanantes.length == 0 ) //si no hay acompañante se agrega uno por default
    //         addAcompanante();
    // } );

    // //Al marcar que no van a haber acompañantes
    // $( "#acompananteNo" ).click( function ()
    // {
    //     $( "#listaAcompanante" ).hide(); //se oculta la lista de acompañantes
    //     $( '#addAcompanante' ).attr( 'style', 'display:none !important' ); //se oculta el botón de agregar acompañante
    //     $( "#AcompananteMsj" ).show(); //se muestra el mensaje de que no asistirá con ningún acompañante 
    //     $( "#AcompananteMsj" ).removeClass( "alert-warning" ).addClass( "alert-secondary" ); //se cambia el color del mensaje a gris
    //     $( "#AcompananteMsj" ).html( "No asistirás con ningún acompañante" ); //se cambia el mensaje
    // } );

    //Al precionar el botón de agregar acompañante
    $( "#addAcompanante" ).click( function ()
    {
        addAcompanante(); //se agrega el acompañante a la lista
    } );

    //Al precionar el botón de eliminar al acompañante
    $( document ).on( 'click', '.borrarAcompanante', function ()
    {
        //$( `#acompanante${this.value}` ).remove(); //se elimina el elemento de la lista
        acompanantes.splice( this.values - 2, 1 );
        let values = $( `.borrarAcompanante` );
        mostrarAcompanantes();
        mostrarMensaje();
        $( '#addAcompanante' ).show(); //se muestra el botón de agregar acompañante
        //continuar con esto
    } );
} );



//función que muestra el mensaje
function mostrarMensaje()
{
    if ( acompanantes.length >= maxAcompanantes )
    { //si se alcanzó el numero máximo de acompañantes
        $( '#addAcompanante' ).attr( 'style', 'display:none !important' ); //
        $( "#AcompananteMsj" ).html( "Número máximo  de acompañantes alcanzado" ); //se cambia el mensaje
        $( "#AcompananteMsj" ).removeClass( "alert-secondary" ).addClass( "alert-warning" ); //se cambia el color del mensaje
        $( "#AcompananteMsj" ).show(); //se muestra el mensaje
    }
    else
    {
        $( "#AcompananteMsj" ).hide(); //se oculta el mensaje
    }
}

//función que agrega los acompañantes
function addAcompanante()
{
    if ( acompanantes.length < maxAcompanantes )
    { //si aún no se alcanza el máximo de acompañantes
        //se guarda el elemento en una variable
        let acompanante = `<!-- Acompanante ${acompanantes.length + 1} --> 
        <div id="acompanante${acompanantes.length + 1}" class="row mx-0 border rounded bg-light pt-2 px-1 mb-3">
            <!--Cedula Acompañante--> 
            <div class="col-md-5 pb-3"> 
                <label for="cedulaAcompanante${acompanantes.length + 1}" class="form-label">Cedula</label>
                <input type="number" class="form-control " id="cedulaAcompanante${acompanantes.length + 1}" name="cedulaAcompanante${acompanantes.length + 1}" min="0">
            </div>
            <!--Nombre Acompañante--> 
            <div class="col-md-5 pb-3"> 
                <label for="nombreAcompanante${acompanantes.length + 1}" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control " id="nombreAcompanante${acompanantes.length + 1}" name="nombreAcompanante${acompanantes.length + 1}">
            </div>
            <!--Parentesco Acompañante-->
            <div class="col-md-5 pb-3">
                <label for="parentescoAcompanante${acompanantes.length + 1}" class="form-label">Parentesco</label>
                <select id="parentescoAcompanante${acompanantes.length + 1}" name="parentescoAcompanante${acompanantes.length + 1}" class="form-select"> 
                    <option selected>Seleccione un parentesco</option> 
                    <option value="1">Encargado Legal</option>
                    <option value="2">Padre/Madre</option>
                    <option value="3">Amigo(a)</option>                    
                </select> 
            </div>
            <div class="col-md-2 pb-3 pt-5 position-relative">
                <button type = "button" class= "borrarAcompanante btn btn-danger position-absolute" style = "bottom: 17px;" value="${acompanantes.length + 1}">
                    <i class="bi bi-trash3"></i>
                    <span id="textoEliminar" style="display:none;">Eliminar</span>
                </button> 
            </div>
        </div>`;
        acompanantes.push( acompanante ); //se agrega el elemento en el array
        $( "#listaAcompanante" ).append( acompanante ); //se muestra el elemento creado en la lista
        $( "#cantidadAcompanantes" ).val( acompanantes.length );
    }
    else
    {
        $( '#addAcompanante' ).hide(); //se oculta el botón de agregar
        mostrarMensaje(); //se muestra el mensaje
    }
}

