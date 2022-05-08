// // $(document).ready(function() {
// //     $("#nuevoUsuario").click(NuevoUsuario);
// // });

// // function NuevoUsuario()
// // {
// //     var cedula =  $("#cedula").val();
// //     var nombre =  $("#nombre").val();
// //     var apellido1 =  $("#apellido1").val();
// //     var apellido2 =  $("#apellido2").val();
// //     var correo = $("#correo").val();
// //     var contrasena = $("#password").val();
// //     var perfil = $("#perfil").val();

// //     $.post("../../BL/Usuario/NuevoUsuario.php",
// //     {
// //         cedulaUsuario : cedula,
// //         nombreUsuario : nombre,
// //         apellido1Usuario : apellido1,
// //         apellido2Usuario : apellido2,
// //         correoUsuario : correo,
// //         contrasenaUsuario : contrasena,
// //         perfilUsuario: perfil
// //     });
// // }
    

//     //JSON PARA IMPRIMIR LOS DATOS
//     //TE DEJO EL LINK DE DONDE SAQUE EL CODIGO
//     //https://www.w3schools.com/js/js_json_php.asp

//     var solicitudUsuario = new XMLHttpRequest();

//     //Da igual que esten antes o despues del bloque anterior...
//     //Abre el PHP de los Arrays con los Usuarios en BL
//     solicitudUsuario.open("POST", "../../BL/Usuario/BuscarTodosUsuario.php");
//     //Busque para que sirve pero no sale nada concreto xd
//     solicitudUsuario.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     solicitudUsuario.send();//Envía la solicitud

//     //Cuando se carga la pagina... hace la función
//     solicitudUsuario.onload = function()
//     {
//         //Guarda el JSON del PHP tras la solicitud y lo convierte en un Objeto de JS
//         var usuario = JSON.parse(this.responseText);

//         //Ni idea si es por el FOR, ya lo hice de la manera antigua como i = 0; i < X; i++
//         //pero nada, es lo mismo
//         for (var i in usuario)
//         {
//             //Crea las filas automaticamente
//             document.getElementById("usuarios").insertRow(-1).innerHTML =
//             '<th id="id" scope="row">'+usuario[i].id+'</th>'//La ID del Usuario
//             +'<td>'+usuario[i].cedula+'</td>'//La Cedula
//             +'<td>'+usuario[i].nombre+'</td>'//El nombre
//             +'<td>'+usuario[i].apellido1+'</td>'//El apellido 1
//             +'<td>'+usuario[i].apellido2+'</td>'//El apellido 1
//             +'<td>'+usuario[i].idCredenciales+'</td>'//LA ID de la Credencial
//             +'<td>'+usuario[i].idPerfil+'</td>'//La ID del Perfil
//             +'<td>'+//Los botones de modificar y eliminar
//                 '<div class="d-flex flex-wrap gap-2 justify-content-center">'+
//                     '<a href="./ModificarUsuario.php" class="btn btn-warning btn-sm">'+
//                         '<i class="bi bi-pencil" style="font-size: 20px;"></i>'+
//                     '</a>'+
//                     '<button class="btn btn-danger btn-sm"><i class="bi bi-trash" style="font-size: 20px;"></i></button>'+
//                 '</div>'+
//             '</td>'
//         }
//     }

    
// var data = <? php echo json_encode( $todosUsuarios, JSON_FORCE_OBJECT ); ?>;
// console.log( data );

// $


