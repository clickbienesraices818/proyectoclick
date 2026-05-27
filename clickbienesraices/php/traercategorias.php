<?php

   // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   //******************************************* */

   $arraycategoriasurbanas = [];
   $arraycategoriasrurales = [];
   $arraycategoriassuburbanas = [];

   //------------------------------------------------------------
         // TRAER LAS CATEGORIAS URBANAS

   if ($TIPOOFERTA === "Urbano" || $TIPOOFERTA === "Todas") {

      $sqlcategorias = "SELECT a.Categoria, a.Codigo_Categoria, b.Imagen
         FROM pr_predios as a, pr_categorias as b
         WHERE SUBSTRING(a.Codigo_Categoria,1,1) = 'U' AND a.Codigo_Categoria = b.Codigo_Categoria
         GROUP BY 1";

      //EJECUTAR LA CONSULTA

      $categoriasTotal = $conexion->query($sqlcategorias);

      // Procesar y mostrar los resultados


      if ($categoriasTotal->num_rows > 0)
         while ($categoriaActual = $categoriasTotal->fetch_assoc()) {
            array_push($arraycategoriasurbanas, $categoriaActual);
         }
   };

   //---------------------------------------------------------
   // TRAER LAS CATEGORIAS RURALES

   if ($TIPOOFERTA === "Rural" || $TIPOOFERTA === "Todas") {

      $sqlcategorias = "SELECT a.Categoria, a.Codigo_Categoria, b.Imagen
      FROM pr_predios as a, pr_categorias as b
      WHERE SUBSTRING(a.Codigo_Categoria,1,1) = 'R' AND a.Codigo_Categoria = b.Codigo_Categoria
      GROUP BY 1";

      //EJECUTAR LA CONSULTA

      $categoriasTotal = $conexion->query($sqlcategorias);

      // Procesar y mostrar los resultados

      if ($categoriasTotal->num_rows > 0)
         while ($categoriaActual = $categoriasTotal->fetch_assoc()) {
            array_push($arraycategoriasrurales, $categoriaActual);
         }
   }

   //---------------------------------------------------------
   // TRAER LAS CATEGORIAS SUBURBANAS

   if ($TIPOOFERTA === "Suburbano" || $TIPOOFERTA === "Todas") {

      $sqlcategorias = "SELECT a.Categoria, a.Codigo_Categoria, b.Imagen
      FROM pr_predios as a, pr_categorias as b
      WHERE SUBSTRING(a.Codigo_Categoria,1,1) = 'S' AND a.Codigo_Categoria = b.Codigo_Categoria
      GROUP BY 1";

      //EJECUTAR LA CONSULTA

      $categoriasTotal = $conexion->query($sqlcategorias);

      // Procesar y mostrar los resultados

      if ($categoriasTotal->num_rows > 0)
         while ($categoriaActual = $categoriasTotal->fetch_assoc()) {
            array_push($arraycategoriassuburbanas, $categoriaActual);
         }
   }




// CERRAR LA CONEXION
mysqli_close($conexion);
