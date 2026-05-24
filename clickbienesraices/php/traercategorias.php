<?php

   // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   //******************************************* */

   $arraycategoriasurbanas = [];
   $arraycategoriasrurales = [];

   if ($TIPOOFERTA === "Urbano" || $TIPOOFERTA === "Todas") {

      // TRAER LAS CATEGORIAS URBANAS
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

   if ($TIPOOFERTA === "Rural" || $TIPOOFERTA === "Todas") {

      //---------------------------------------------------------
      // TRAER LAS CATEGORIAS RURALES
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

// CERRAR LA CONEXION
mysqli_close($conexion);
