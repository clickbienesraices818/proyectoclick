<?php




?>

<!-- ------------------------------------------ -->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Action</title>

   <link rel="stylesheet" href="styleactualizarbasedatos.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
   <section class="seccionPrincipal">

      <div class="areaFormulario">

         <form action="procesardatossheetaction.php" method="POST">ACTUALIZACION BASES DE DATOS -ACTION
            <div>
               <button type="submit" class="botonOpcion" name="actualizarPredios">Actualizar Predios</button>
               <button type="submit" class="botonOpcion" name="actualizarCaracteristicas">Actualizar Caracteristicas</button>
               <button type="submit" class="botonOpcion" name="actualizarImagenes">Actualizar Imagenes</button>
               <button type="submit" class="botonOpcion" name="actualizarCategorias">Actualizar Categorias</button>
            </div>
         </form>
      </div>

      <div>
         <p id="mensaje"></p>
      </div>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
   </script>
</body>

</html>