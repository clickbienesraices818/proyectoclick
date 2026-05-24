<?php

   // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   //******************************************* */

   $arrayimagenes = [];

   //---------------------------------------------------------
   // TRAER LAS IMAGENES 

    $sqlimagenes = "SELECT Codigo_Predio
      FROM pr_imagenes
      WHERE Codigo_Predio IN (SELECT Codigo_Predio FROM pr_predios WHERE Estado = 'Activo' AND Tipo = '$TIPOOFERTA')";

   $imagenesTotal = $conexion->query($sqlimagenes);

   $varnumimagenes = intdiv($imagenesTotal->num_rows, 100);
   $varregistroinicio = random_int(0, $varnumimagenes)*100;
    
   $sqlimagenes = "SELECT a.Archivo_Imagen, a.Codigo_Predio, b.Categoria
      FROM pr_imagenes as a, pr_categorias as b
      WHERE Codigo_Predio IN (SELECT Codigo_Predio FROM pr_predios WHERE Estado = 'Activo' AND Tipo = '$TIPOOFERTA') AND
         a.Codigo_categoria = b.Codigo_Categoria
      ORDER BY 1 ASC
      LIMIT $varregistroinicio, 100";


   //EJECUTAR LA CONSULTA

   $imagenesTotal = $conexion->query($sqlimagenes);

   // Procesar y mostrar los resultados

   $varresultados = $imagenesTotal->num_rows;

   if ($imagenesTotal->num_rows > 0)
      while ($imagenActual = $imagenesTotal->fetch_assoc()) {
         array_push($arrayimagenes, $imagenActual);
      }
   // CERRAR LA CONEXION
   mysqli_close($conexion);

?>