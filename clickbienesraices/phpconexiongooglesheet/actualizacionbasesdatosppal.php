<?php

?>

<!-- ------------------------------------------ -->
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Actualizar BD SITE</title>

   <link rel="stylesheet" href="styleactualizarbasedatos.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>

   <main>


      <section class="seccionPrincipal">
         <div class="areaTitulo">
            <p class="textoTitulo">ACTUALIZACION TABLAS BASE DE DATOS SITE</p>
         </div>

         <div class="areaBotonesopciones">
            <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Predios')">Tabla Predios</button>
            <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Caracteristicas')">Tabla Caracteristicas</button>
            <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Imagenes')">Tabla Imagenes</button>
            <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Categorias')">Tabla Categorias</button>
            <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Noticias')">Tabla Noticias</button>
         </div>

         <div id="areaMensaje" class="areaMensaje">
            <p id="textoMensaje" class="textoMensaje">
               Seleccione la Tabla para Actualizar
            </p>
         </div>

      </section>


      <div class="areaBDHosting">
         <p>
            <?php
            $conexionHosting = file_get_contents('conexionBDHosting.php');
            echo nl2br(htmlspecialchars($conexionHosting));
            ?>
         </p>
      </div>
   </main>

   <script>
      async function actualizarTablaPHP(vartabla) {
         try {

            vartablamay = vartabla.toUpperCase();
            var vartextoMensaje = document.getElementById("areaMensaje").style.backgroundColor = "red";
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = `Actualizando la Tabla ${vartablamay}`;

            // Reemplaza 'funciones.php' por la ruta real de tu archivo
            const respuesta = await fetch(`procesardatossheetppal.php?funcion=actualizar${vartabla}`);
            const texto = await respuesta.text();

            // Muestra lo que devuelve el archivo PHP

            var vartextoMensaje = document.getElementById("areaMensaje").style.backgroundColor = "yellow";
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = texto;


         } catch (error) {
            console.error('Error al conectar con PHP:', error);
         }
      }
   </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
   </script>
</body>

</html>