<?php

   if (isset($_POST['codigosPredios']))
      $varcodpredio = $_POST['codigosPredios'];

   //echo __DIR__; 
   //echo __FILE__; 

   // Pasamos el parámetro 'nombre' a través de la URL
   $url = "desplegarpiezaurbano.php?codpredio=$varcodpredio";

   echo $url;

   // Ejecutamos el archivo y obtenemos la respuesta
   $contenido = file_get_contents($url);
   //echo $contenido;

?>
