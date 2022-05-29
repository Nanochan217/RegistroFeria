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

include '../../BL/Usuario/BuscarUsuario.php';

if (isset($_POST['id']))
{
    $id = $_POST['id'];
}
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

    <title>Modificar Usuario</title>
    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>@media (max-width: 768px) {
            #textoEliminar {
                display: inline !important;
                margin-top: 10px;
            }
        }
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <?php
    echo $headerSA;
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Modificar Usuario</h1>
                </div>

                <!-- Formulario START-->
                <form action="../../BL/Usuario/ActualizarInformacion.php" method="POST" class="row gap-3">

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">
                        <h2 class="pb-4">Datos del usuario</h2>

                        <!-- Imputs 1 -->
                        <div class="row">

                            <!-- ID -->
                            <div class="col-md-3 pb-3" hidden="true">
                                <label for="idUsuario" class="form-label">ID</label>
                                <input type="number" class="form-control " id="idUsuario" name="idUsuario" value="">
                            </div>

                            <!-- Cedula -->
                            <div class="col-md-3 pb-3">
                                <label for="cedula" class="form-label">Cedula</label>
                                <input type="text" class="form-control " id="cedula" name="cedula" value="" required>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3 pb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control " id="nombre" name="nombre" required>
                            </div>

                            <!-- Apellido 1 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido1" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control " id="apellido1" name="apellido1" required>
                            </div>

                            <!-- Apellido 2 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido2" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control " id="apellido2" name="apellido2" required>
                            </div>
                        </div>

                        <!-- Imputs 2 -->
                        <div class="row">

                            <!-- Correo -->
                            <div class="col-md-4 pb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control " id="email" name="email" required>
                            </div>

                            <!-- Contrasena -->
                            <div class="col-md-4 pb-3">
                                <label for="contrasena" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena">
                            </div>

                            <!-- Tipo perfil -->
                            <div class="col-md-4 pb-3">
                                <label for="tipoPerfil" class="form-label">Tipo perfil</label>
                                <select id="tipoPerfil" name="tipoPerfil" class="form-select" required>
                                    <option value="none" selected disabled hidden>Seleccione un perfil</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END Sección de datos del solicitante -->

                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="./Usuarios.php" class="btn btn-danger">Descartar</a>
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Formulario END -->

            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <script>
        $("#navUsuarios").addClass("active");


        var usuario = <?php echo BuscarIDUsuario($id) ?>;
        var credencial = <?php echo BuscarIDCredencial(json_decode(BuscarIDUsuario($id))->idCredenciales) ?>;

        $(document).ready(function() {
            $("#idUsuario").val(usuario.id);
            $("#cedula").val(usuario.cedula);
            $("#nombre").val(usuario.nombre);
            $("#apellido1").val(usuario.apellido1);
            $("#apellido2").val(usuario.apellido2);
            $("#email").val(function() {
                if (credencial.id == usuario.idCredenciales) {
                    return credencial.correo;
                }
            });

            llenarSelect();
        });

        function llenarSelect() {
            var perfiles = <?php echo BuscarPerfiles() ?>;


            var select = document.getElementById("tipoPerfil");

            for (value in perfiles) {
                var option = document.createElement("option");
                option.value = perfiles[value].id
                option.text = perfiles[value].nombrePerfil;
                if (perfiles[value].id == usuario.idPerfil) {
                    option.selected = true;
                }
                select.add(option);
            }

            console.log(select.value)
        }
    </script>
    <!-- END Scripts  -->
</body>

</html>