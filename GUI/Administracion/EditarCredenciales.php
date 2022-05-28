<?php
session_start();
if (!isset($_SESSION))
    header("Location: ../PantallasDestino/AccesoDenegado.php");

$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$headerA = file_get_contents('../Default/HeaderA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Usuario/BuscarUsuario.php';

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

    <title>Editar datos de acceso</title>
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
    
    if ($_SESSION["Perfil"]==1) {
        echo $headerSA;
        $retornar = "../Administracion/Index.php";
    }
    else if($_SESSION["Perfil"] == 2){
        echo $headerA;
        $retornar = "../Index/Index.php";
    }
    else{
        echo $header;
        $retornar = "../Index/Index.php";
    }    

    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Editar datos de acceso</h1>
                </div>

                <!-- Formulario START-->
                <form action="../../BL/Usuario/ActualizarCredencial.php" method="POST" class="row gap-3">

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">

                        <!-- Imputs -->
                        <div class="row">

                            <!-- ID -->
                            <div class="col-md-6 pb-3" hidden="true">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control " id="idUsuario" name="idUsuario" value="" onchange="VerificarCorreo()">
                            </div>

                            <!-- Correo -->
                            <div class="col-md-6 pb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control " id="email" name="email" required>
                            </div>

                            <!-- Contrasena -->
                            <div class="col-md-6 pb-3">
                                <label for="contrasena" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena">
                            </div>

                        </div>
                    </div>
                    <!-- END Sección de datos del solicitante -->

                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="<?php echo $retornar?>" class="btn btn-danger">Descartar</a>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Formulario END -->

            </div>
        </div>
    </div>

    <div class="toast-container" id="contenedorNotificaciones"></div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>

    <script>
        var credencial = <?php echo BuscarIDCredencial(json_decode(BuscarIDUsuario($_SESSION['idUsuario']))->idCredenciales) ?>;

        $(document).ready(function() {
            $("#email").val(function() {
                return credencial.correo;
            });
            $("#idUsuario").val(function() {
                return credencial.id;
            });
        });
    </script>
    <script src="./editarCredenciales.js"></script>
    <!-- END Scripts  -->
</body>

</html>