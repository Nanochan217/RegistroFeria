<?php
$header = file_get_contents('../Default/Header.html');
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    include '../Default/CSSImports.html';
    ?>

    <title>Cita elliminada</title>

    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <!-- IMPORT Header -->
    <?php
    echo $header;
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center py-5">
                    <h1>Cita eliminada correctamente</h1> <!-- titulo -->
                    <img src="../Assets/Images/CitaEliminada.svg" style="height: 180px;" alt=""> <!-- ilustración -->
                    <a href="../Formulario/Formulario.php" class="btn btn-primary">Reservar Nueva Cita</a> <!-- botón nueva reserva -->
                </div>
                <!-- END Encabezado de la pagina -->

                <!-- IMPORT Recursos extras -->
                <?php
                include '../Default/RecursosExtra.html';
                ?>
            </div>
        </div>
    </div>

    <!-- IMPORT Footer  -->
    <?php
    include '../Default/Footer.html';
    ?>

    <!-- START Scripts  -->
    <?php
    include '../Default/JSImports.html';
    ?>
    <!-- END Scripts  -->
</body>

</html>