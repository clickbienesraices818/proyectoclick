<?php

   // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   //******************************************* */


   $arraypredios = [];
   $arraycaracteristicas = [];
   $arrayimagenes = [];

   //-------------------------------------
   // EJECUTA LA CONSULTA PARA TRAER LA CATEGORIA DEL CODIGO

   $sqlcategoria = "SELECT Categoria
         FROM pr_categorias
         WHERE Codigo_Categoria = '$CODCATEGORIA'";

   $categorias = $conexion->query($sqlcategoria);
   $varcategoria = mysqli_fetch_assoc($categorias);
   $CATEGORIA = $varcategoria["Categoria"];



   //-------------------------------------
   // EJECUTA LA CONSULTA PARA LOS PREDIOS

   if ($CODIGOPREDIO === "TODOS") {
      $sqlpredios = "SELECT *
         FROM pr_predios
         WHERE Estado <> 'Inactivo' AND  (Codigo_Categoria = '$CODCATEGORIA' OR Codigo_Categoria_B = '$CODCATEGORIA' )
         ORDER BY Valor_Numero";
   } else {
      $sqlpredios = "SELECT *
         FROM pr_predios
         WHERE Estado<>'Inactivo' AND Codigo_Predio = '$CODIGOPREDIO'
         ORDER BY 1";
   };

   $prediosTotal = $conexion->query($sqlpredios);

   // Procesar y mostrar los resultados

   if ($prediosTotal->num_rows > 0)
      while ($predioActual = $prediosTotal->fetch_assoc()) {
         array_push($arraypredios, $predioActual);
      }

   //--------------------------------------------
   // EJECUTA LA CONSULTA PARA LAS CARACTERISTICAS
   if ($CODIGOPREDIO === "TODOS") {
         $sqlcaracteristicas = "SELECT *
         FROM pr_caracteristicas
         WHERE Codigo_Predio IN (
            SELECT Codigo_Predio
            FROM pr_predios
            WHERE Estado <> 'Inactivo' AND (Codigo_Categoria = '$CODCATEGORIA' OR Codigo_Categoria_B = '$CODCATEGORIA')
            GROUP BY 1)
         ORDER BY 1,4";
      } else {
      $sqlcaracteristicas = "SELECT *
         FROM pr_caracteristicas
         WHERE Codigo_Predio = '$CODIGOPREDIO'
         ORDER BY 1,4";
   };

   $caracteristicasTotal = $conexion->query($sqlcaracteristicas);

   // Procesar y mostrar los resultados
   if ($caracteristicasTotal->num_rows > 0)
      while ($caracteristicaActual = $caracteristicasTotal->fetch_assoc()) {
         array_push($arraycaracteristicas, $caracteristicaActual);
      }

   //----------------------------------------------------
   // EJECUTA LA CONSULTA PARA LAS IMAGENES
   if ($CODIGOPREDIO === "TODOS") {
         $sqlimagenes = "SELECT *
         FROM pr_imagenes
         WHERE Codigo_Predio IN (
            SELECT Codigo_Predio
            FROM pr_predios
            WHERE Estado <> 'Inactivo' AND (Codigo_Categoria = '$CODCATEGORIA' OR Codigo_Categoria_B = '$CODCATEGORIA')
            GROUP BY 1)
         ORDER BY Codigo_Predio, Orden";
      } else {
      $sqlimagenes = "SELECT *
         FROM pr_imagenes
         WHERE Codigo_Predio = '$CODIGOPREDIO'
         ORDER BY Codigo_Predio, Orden";
   };

   $imagenesTotal = $conexion->query($sqlimagenes);

   // 3. Procesar y mostrar los resultados
   if ($imagenesTotal->num_rows > 0)
      while ($imagenActual = $imagenesTotal->fetch_assoc()) {
         array_push($arrayimagenes, $imagenActual);
      }

   // CERRAR LA CONEXION
   mysqli_close($conexion);
