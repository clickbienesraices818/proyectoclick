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

         <div class="areaBasedatos">
            <p class="tituloBasedatos">Seleccione la BD</p>
            <input type="radio" id="bdhosting" name="basedatos" value="BDHosting" class="radioOpcion">
            <label for="bdhosting">BD Hosting</label>

            <input type="radio" id="bdlocal" name="basedatos" value="BDLocal" class="radioOpcion">
            <label for="bdlocal">BD Local</label><br>
         </div>

         <div class="areaTablas">
            <p class="tituloAreabotones">Tablas Base Datos</p>
            <div class="areaBotonesopciones">
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Predios')">Predios</button>
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Caracteristicas')">Caracteristicas</button>
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Imagenes')">Imagenes</button>
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Categorias')">Categorias</button>
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Noticias')">Noticias</button>
               <button type="button" class="botonOpcion" onclick="actualizarTablaPHP('Municipios')">Municipios</button>
            </div>
         </div>

         <div id="areaMensaje" class="areaMensaje">
            <p id="textoMensaje" class="textoMensaje">
               Seleccione la Tabla para Actualizar
            </p>
         </div>

      </section>

   </main>

   <script>
      // SELECCION TABLA A ACTUALIZAR

      varbaselocal = document.getElementById("bdlocal");
      varbaselocal.addEventListener("input", function() {
         varbasedatos = varbaselocal.value;
      })

      varbasehosting = document.getElementById("bdhosting");
      varbasehosting.addEventListener("input", function() {
         varbasedatos = varbasehosting.value;
      })

      const wait = (ms) => new Promise(resolve => setTimeout(resolve, ms));

      async function actualizarTablaPHP(vartabla) {
         try {

            alert(`Procesando -->   ${varbasedatos}`);
            if (varbasedatos === null)
               return;

            vartablamay = vartabla.toUpperCase();
            var vartextoMensaje = document.getElementById("areaMensaje").style.backgroundColor = "red";
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = `Actualizando la Tabla ${vartablamay}`;

            // Reemplaza 'funciones.php' por la ruta real de tu archivo
            const respuesta = await fetch(`procesardatossheetppal.php?funcion=actualizar${vartabla}&basedatos=${varbasedatos}`);
            const texto = await respuesta.text();

            // Muestra lo que devuelve el archivo PHP

            var vartextoMensaje = document.getElementById("areaMensaje").style.backgroundColor = "yellow";
            var vartextoMensaje = document.getElementById("textoMensaje").innerText = texto;

            alert(`Proceso terminó Exitosamente -->   ${varbasedatos}`);

         } catch (error) {
            console.error('Error al conectar con PHP:', error);
         }

         await wait(8000);

         location.reload();
      }
   </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
   </script>
</body>

</html>