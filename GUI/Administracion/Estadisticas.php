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

    <title>Estadisticas</title>
    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
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
    include '../Default/HeaderLogged.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Estadisticas</h1>
                </div>

            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    include '../Default/Footer.html';
    ?>

    <!-- START Scripts  -->
    <?php
    include '../Default/JSImports.html';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <Script>
        $("#navEstadisticas").addClass("active");
    </Script>
    <!-- END Scripts  -->
</body>

</html>