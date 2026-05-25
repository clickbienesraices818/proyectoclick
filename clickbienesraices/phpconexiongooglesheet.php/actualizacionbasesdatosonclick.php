<?php

?>

<!-- ------------------------------------------ -->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Onclick</title>

   <link rel="stylesheet" href="styleactualizarbasesdatos.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
   <section class="seccionPrincipal">

      <div class="areaBotonesopciones">
         <p>ACTUALIZAR BASES DE DATOS - ONCLICK</p>

         <button type="button" class="botonOpcion" onclick=actualizarPrediosPHP()>Actualizar Predios</button>
         <button type="button" class="botonOpcion" onclick=actualizarCaracteristicasPHP()>Actualizar Caracteristicas</button>
         <button type="button" class="botonOpcion" onclick=actualizarImagenesPHP()>Actualizar Imagenes</button>
         <button type="button" class="botonOpcion" onclick=actualizarCategoriasPHP()>Actualizar Categorias</button>

      </div>

      <div>
         <p id="textoMensaje">
               hola
         </p>
      </div>


   </section>


   <script>
      async function actualizarPrediosPHP() {
         try {
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = "ACTUALIZANDO LA TABLA PREDIOS";

            // Reemplaza 'funciones.php' por la ruta real de tu archivo
            const respuesta = await fetch('procesardatossheetonclick.php?funcion=actualizarPredios');
            const texto = await respuesta.text();

            // Muestra lo que devuelve el archivo PHP
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = texto;
            
         } catch (error) {
            console.error('Error al conectar con PHP:', error);
         }
      }

      async function actualizarCaracteristicasPHP() {
         try {

            var vartextoMensaje = document.getElementById("textoMensaje").innerText = "ACTUALIZANDO LA TABLA CARACTERISTICAS";

            const respuesta = await fetch('procesardatossheetonclick.php?funcion=actualizarCaracteristicas');
            const texto = await respuesta.text();

            var vartextoMensaje = document.getElementById("textoMensaje").innerText = texto;

         } catch (error) {
            console.error('Error al conectar con PHP:', error);
         }
      }

      async function actualizarImagenesPHP() {
         try {

            var vartextoMensaje = document.getElementById("textoMensaje").innerText = "ACTUALIZANDO LA TABLA IMAGENES";

            const respuesta = await fetch('procesardatossheetonclick.php?funcion=actualizarImagenes');
            const texto = await respuesta.text();

            // Muestra lo que devuelve el archivo PHP
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = texto;

         } catch (error) {
            console.error('Error al conectar con PHP:', error);
         }
      }

      async function actualizarCategoriasPHP() {
         try {

            var vartextoMensaje = document.getElementById("textoMensaje").innerText = "ACTUALIZANDO LA TABLA CATEGORIAS";

            // Reemplaza funciones.php' por la ruta real de tu archivo
            const respuesta = await fetch('procesardatossheetonclick.php?funcion=actualizarCategorias');
            const texto = await respuesta.text();

            // Muestra lo que devuelve el archivo PHP

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