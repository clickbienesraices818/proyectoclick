<?php

   // LLAMADO AL PHP PARA TRAER LOS DATOS DELAOFERTA URBANA
    $TIPOOFERTA = "Urbano";  
    include 'traerimagenesoferta.php';

?>

<!------- **************************   -------->
<!-------  HTML OFERTAS URBANAS  ---------------------->

<!DOCTYPE html>
<html lang="es">

<!---------OFERTAS URBANAS -------------------->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagenes_site/logo pestana.png" type="image/png">

    <!--------- STYLES -------------------->
    <link rel="stylesheet" href="../css/styleofertasconsolidado.css">

    <!--------- SCRIPTS -------------------->

    <title> Ofertas Urbanas</title>
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

        <!----------TITULO ------------------->
        <div id="areatitulos">
            <h1 id="textotitulos">
                Ofertas Urbanas
            </h1>
            <a href="../index.php">
                <img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
            </a>
        </div>
        <!---------- IMAGEN BANNER --------->
        <section id="seccionbanner">
            <div>
                <img id="imagenbanner" src="../imagenes_site/Banner Urbanos.webp">
            </div>
        </section>

        <!----------SECCION DE IMAGENES DE PREDIOS --------->
        <hr class="separador">
        <section class=carruselImagenes>
            <div class="areaImagenes">
                <div class=tarjetaImagenes>
                    <?php include 'desplegarimagenesoferta.php'; ?>
                </div>
            </div>
        </section>
        <!----------OPCIONES BOTONES ------------------->
        <hr class="separador">
        <section class="seccionbotones">
            <div class="divbotones">
                <?php 
                    $TIPOOFERTA = "Urbano";
                    include 'traercategorias.php';
                    foreach ($arraycategoriasurbanas as $categoria) {

                        $varcategoria = $categoria["Categoria"];
                        $varcodigocategoria = $categoria["Codigo_Categoria"];
                        $varimagentemp = $categoria["Imagen"];
                        $varlongitud = strlen($varimagentemp);
                        $varposinicio = strpos($varimagentemp, "/");
                        $varposfinal = strpos($varimagentemp, ".Imagen");
                        $varimagen =  substr($varimagentemp, $varposinicio+1, $varposfinal-$varposinicio-1);

                        $vararchivoimagen = strtolower("../imagenes_site/". $varimagen .".png");

                        echo "<a  href='desplegarpredio.php?codigocategoria=$varcodigocategoria&codigopredio=TODOS'>
                            <button type='button'>
                                <img class='imgboton' src='$vararchivoimagen'>
                                $varcategoria
                            </button> 
                            </a>";
                    };
                ?>
            </div>
        </section>
    </main>

    <!---------- PIE DE PAGINA ------------------->
    <hr class="separador">
   <footer>
         <?php
            include 'footer2Nivel.php'
         ?>
   </footer>

</body>

</html>