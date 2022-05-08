<?php
session_start();
if($_SESSION['Perfil'] != 1)
    header("Location: ../PantallasDestino/AccesoDenegado.php");

$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Usuario/BuscarTodosUsuario.php';
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    echo $cssLinks;
    ?>

    <title>Usuarios</title>

    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <!-- IMPORT Header -->
    <?php
    echo $headerSA;
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center pt-5 pb-4">
                    <h1>Usuarios</h1> <!-- titulo -->
                </div><!-- END Encabezado de la pagina -->

                <!-- START Contenedor -->
                <div class="border rounded bg-white shadow-sm p-5 mb-5">

                    <!-- START Fila de filtros -->
                    <div class="row gap-3 justify-content-between my-3">

                        <!-- START Filtro por perfil -->
                        <div class="col-auto">
                            <select id="filtrarPerfil" name="filtrarPerfil" class="form-select">
                                <option value="none" selected>Todos los perfiles</option>
                            </select>
                        </div><!-- END Filtro por perfil -->

                        <!-- START Busqueda -->
                        <div class="col-auto">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar...">
                                    </div>
                                </div>

                                <a href="./AgregarUsuario.php" class="btn btn-primary">Agregar usuario</a>

                            </div>
                        </div><!-- END Busqueda -->
                    </div><!-- END Fila de filtros -->

                    <!-- START Table -->
                    <div class="table-responsive ">
                        <table id="usuarios" class="table table-hover table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Primer apellido</th>
                                    <th scope="col">Segundo apellido</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Perfil</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contenido de la tabla -->
                            </tbody>
                        </table>
                    </div><!-- END Table -->
                </div><!-- END Contenedor -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Seguro que desea eliminar al usuario?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="eliminarUsuario">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- IMPORT Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <script src="./Usuarios.js"></script>
    <script>
        var registros = {};
        $(document).ready(function() {
            $("#navUsuarios").addClass("active"); //marcar link de la navbar
            var usuarios = <?php echo BuscarUsuarios() ?>;
            var credenciales = <?php echo BuscarCredenciales() ?>;
            var perfiles = <?php echo BuscarPerfiles() ?>;

            $.each(usuarios, function(i, usuario) {

                $.each(credenciales, function(i, credencial) {
                    if (credencial.id == usuario.idCredenciales) $correo = credencial.correo;
                });
                $.each(perfiles, function(i, perfil) {
                    if (perfil.id == usuario.idPerfil) $perfil = perfil.nombrePerfil;
                });

                var registro = {
                    "id": usuario.id,
                    "cedula": usuario.cedula,
                    "nombre": usuario.nombre,
                    "apellido1": usuario.apellido1,
                    "apellido2": usuario.apellido2,
                    "correo": $correo,
                    "perfil": $perfil
                };

                registros[`${i+1}`] = registro;
            });

            console.log(registros)

            llenarTabla("usuarios", registros)

            function llenarTabla(tabla, registros) {
                $.each(registros, function(i, registro) {
                    var $tr = $('<tr>').append(
                        $('<th>').text(registro.cedula),
                        $('<td>').text(registro.nombre),
                        $('<td>').text(registro.apellido1),
                        $('<td>').text(registro.apellido2),
                        $('<td>').text(registro.correo),
                        $('<td>').text(registro.perfil),
                        $('<td>').append(`<form action="./ModificarUsuario.php" method="post" class="d-flex flex-wrap gap-2 justify-content-center">
                                            <button name="id" type="submit" value="${registro.id}" class = "btn btn-warning btn-sm" >
                                                <i class = "bi bi-pencil" style = "font-size: 20px;" > </i>
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalConfirmacion" data-bs-whatever="${i}" class = "btn btn-danger btn-sm" >
                                                <i class = "bi bi-trash" style = "font-size: 20px;" > </i>
                                            </button >
                                        </form>`)
                    );
                    var $tbody = $(`#${tabla} tbody`).append($tr);
                })
            }

            llenarSelect("filtrarPerfil", perfiles);
        });
    </script>
    <!-- END Scripts  -->
</body>

</html>