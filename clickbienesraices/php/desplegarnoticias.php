<?php

    $IDNOTICIA = $_GET['idnoticia'];

    // LLAMADO AL PHP QUE TRAE LOS DATOS DE LOS PRDIOS DE LA BASE DE DATOS
    include 'traerdatosnoticias.php';

?>

<!------------HTML PARA DIBUJAR LA PAGINA DE UN PREDIO-------------------------------->

<!DOCTYPE html>
<html lang="es">

<head>
    <!---------- CASAS ------------------->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagenes_site/logo pestana.png" type="image/png">

    <!---------- ARCHIVOS CSS------------------->

    <link rel="stylesheet" href="../css/stylenoticiasconsolidado.css">

    <!---------- SCRIPTS ------------------->

    <script defer src="../js/visualizarnoticias.js"></script>

    <script>
        document.title = "Noticias";
    </script>

    <title> </title>
</head>

<body>

    <header>
        <!---------- BARRA MENU ------------------->
         <?php 
            $TIPOOFERTA = "Todas";
            include 'traercategorias.php';
            include 'barramenu2nivel.php'; 
         ?>
    </header>

    <main>
        <!---------- TITULO ------------------->
        <div id="areatitulos">
            <h1 id="textotitulos">
                Temas y Noticias de Interés
            </h1>
            <a href="../index.php">
                <img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
            </a>
        </div>

        <!---------- BANNER ------------------->
        <section id="seccionbanner">
            <div>
                <img id="imagenbanner" src="../imagenes_site/banner Interes.webp">
            </div>
        </section>
        <hr class="separador">
        <!---------- NOTICIAS ------------------->

        
    </main>

    <!---------- PIE DE PAGINA ------------------->
    <hr class="separador">
   <footer>
         <?php
            include 'footer2Nivel.php'
         ?>
   </footer>

    <script>
        // PASAR LOS DATOS DE LOS PREDIOS A ARREGLO DE JAVASCRIPT
        var listatempnoticias = '<?php echo json_encode($arraynoticias, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>';
        var listaNoticias = JSON.parse(listatempnoticias);
    </script>

    <script defer src="../js/cargardatosnoticias.js"> </script>
</body>

</html>
