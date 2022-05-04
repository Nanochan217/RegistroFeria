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

    <title>{Acción} Exitosa</title>

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
    include '../Default/Header.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center py-5">
                    <h1>{Acción} exitosamente</h1> <!-- titulo -->
                    <img src="../Assets/Images/realizadoCorrectamente.svg" style="height: 180px;" alt=""> <!-- ilustración -->
                    <a href="../Index/Index.php" class="btn btn-primary">Volver al inicio</a> <!-- botón nueva reserva -->
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