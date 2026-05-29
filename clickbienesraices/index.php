<!--  HTML INDEX -->
<!DOCTYPE html>
<html lang="es">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="imagenes_site/logo pestana.png" type="image/png">

   <!--------- STYLES -------------------->

   <!-- CSS PERSONALIZADOS -->
   <link rel="stylesheet" href="css/styleinicioconsolidado.css">


   <!--------- SCRIPTS -------------------->
   <title> Click Bienes prueba </title>

</head>

<body>
   <header>
      <?php
         $TIPOOFERTA = "Todas";
         include 'php/traercategorias.php';
         include 'php/barramenu1nivel.php';
      ?>
   </header>

   <main>
      <!---------- IMAGEN BANNER ------------------->
      <section id="seccionbanner">
         <div>
            <img id="imagenbanner" src="imagenes_site/banner inicio.webp">
         </div>
      </section>
      <hr class="separador">
      <!---------- PARRAFO BIENVENIDA ------------------->
      <section id="seccionbienvenida">
         <div id="divbienvenida">
            <div id="titulobienvenida">¡ Lo que nos mueve !
            </div>
            <div id="primerbloque">
               <div id="boximagen">
                  <img class="imgbienvenida" src="imagenes_site/familia en casa.webp">
               </div>
               <div class="parrafobienvenida">
                  <p>
                     En Click Bienes Raices estamos seguros que encontrar el lugar perfecto para vivir o invertir
                     debe ser un proceso sencillo que convierta esta experiencia en un momento emocionante lleno de
                     calidez. Por eso, estamos aquí para ser el puente confiable que conecta a las personas con sus
                     suenos. Nos apasiona acompanar a cada cliente en su camino, simplificando la venta y compra de
                     propiedades, ofreciendo una atención personalizada, cercana y de alta calidad.
                  </p>
               </div>
            </div>
            <div id="segundobloque">
               <div class="parrafobienvenida">
                  <p>
                     Nuestro compromiso va más allá de cerrar una transacción: trabajamos cada día para superar y
                     resolver cada expectativa con experiencia dedicación y compromiso. Estamos ubicados en
                     Manizales, ciudad que se destaca por su calidad de vida y su gente amable.
                     Has click con la propiedad que estás destinado a encontrar.
                  </p>
               </div>
               <div id="boximagen">
                  <img class="imgbienvenida" src="imagenes_site/imagen finca 2.webp">
               </div>
            </div>
         </div>
      </section>

      <!---------- BOTONES OPCIONES ------------------->
      <section class="seccionbotones">
         <hr class="separador">
         <!--   -->
         <div class="divbotones">
            <a href="php/ofertas-urbanas.php">
               <button type="button">
                  <img class="imgboton" src="imagenes_site/urbano.png">
                  Ofertas Urbanas
               </button>
            </a>

            <a href="php/ofertas-rurales.php">
               <button type="button">
                  <img class="imgboton" src="imagenes_site/rural.png">
                  Ofertas Rurales
               </button>
            </a> 
            <a href="php/ofertas-suburbanas.php">
               <button type="button">
                  <img class="imgboton" src="imagenes_site/suburbano.png">
                  Ofertas Suburbanas
               </button>
            </a>

            <a href="php/desplegarnoticias.php?idnoticia=TODAS">
               <button type="button">
                  <img class="imgboton" src="imagenes_site/noticias.png">
                  Temas y Noticias de Interés
               </button>
            </a>

            <a href="php/consultarpredios.php">
               <button type="button">
                  <img class="imgboton" src="imagenes_site/buscar predio.png">
                  Consultar Predios
               </button>
            </a>
         </div>
         <hr class="separador">
      </section>

   </main>

   <!---------- PIE DE PAGINA ------------------->
   <footer>
      <?php
         include 'php/footer1Nivel.php'
      ?>
   </footer>

</body>

</html>