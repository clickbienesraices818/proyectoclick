<?php

   // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   //******************************************* */

   $arraynoticias = [];

   //-------------------------------------
   // EJECUTA LA CONSULTA PARA LAS NOTICIAS
   if ($IDNOTICIA === "TODAS") {
      $sqlnoticias = "SELECT *
         FROM ne_noticias
         WHERE Activo = 'TRUE'
         ORDER BY 1 DESC";
   } else {
      $sqlnoticias = "SELECT *
         FROM ne_noticias
         WHERE Activo = 'TRUE' AND ID_Noticia = '$IDNOTICIA'
         ORDER BY 1 DESC";
   }

   $noticiasTotal = $conexion->query($sqlnoticias);

   // Procesar y mostrar los resultados
   if ($noticiasTotal->num_rows > 0)
      while ($noticiaActual = $noticiasTotal->fetch_assoc()) {
         array_push($arraynoticias, $noticiaActual);
      }

   // CERRAR LA CONEXION
   mysqli_close($conexion);
