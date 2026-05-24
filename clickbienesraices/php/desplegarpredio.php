<?php

    $CODCATEGORIA = $_GET['codigocategoria'];
    $CODIGOPREDIO = $_GET['codigopredio'];

    // LLAMADO AL PHP QUE TRAE LOS DATOS DE LOS PRDIOS DE LA BASE DE DATOS
    include 'traerdatospredios.php';

?>

<!------------ PHP PARA DIBUJAR LA PAGINA DE UN PREDIO-------------------------------->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagenes_site/logo pestana.png" type="image/png">

    <!---------- ARCHIVOS CSS------------------->

    <link rel="stylesheet" href="../css/styleprediosconsolidado.css">

    <!---------- SCRIPTS ------------------->
    <script>
        const CODCATEGORIA = <?php echo json_encode($CODCATEGORIA); ?>;
        const TIPOCATEGORIA = CODCATEGORIA[0];
        const CATEGORIA = <?php echo json_encode($CATEGORIA); ?>;
    </script>

    <script defer src="../js/visualizarpredios.js"></script>

    <script>
        document.title = CATEGORIA;
    </script>
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

    </main>

    <div class="containerMensaje">    
        <p id="textoMensajepredio"> </p>
    </div>

    <!---------- PIE DE PAGINA ------------------->
    <hr class="separador">
   <footer>
         <?php
            include 'footer2Nivel.php'
         ?>
   </footer>

    <script>
        // PASAR LOS DATOS DE LOS PREDIOS A ARREGLO DE JAVASCRIPT
        var listatemppredios = '<?php echo json_encode($arraypredios, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>'
        var listaPredios = JSON.parse(listatemppredios);

        // PASAR LAS CARACTERISTICAS DE LOS PREDIOS A ARREGLO DE JAVASCRIPT
        var listatempcaracter = '<?php echo json_encode($arraycaracteristicas, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>';
        var listaCaracteristicas = JSON.parse(listatempcaracter);

        // PASAR LAS IMAGENES DE LOS PREDIOS A ARREGLO DE JAVASCRIPT
        var listatempimagenes = '<?php echo json_encode($arrayimagenes); ?>';
        var listaImagenes = JSON.parse(listatempimagenes);
    </script>

    <script defer src="../js/cargardatospredios.js"> </script>
</body>

</html>

