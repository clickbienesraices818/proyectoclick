<?php

      foreach ($arrayimagenes as $imagen) {

         $varimagentemp = $imagen["Archivo_Imagen"];
         $varcodigopredio = $imagen["Codigo_Predio"];
         $varcategoria = $imagen["Categoria"];
         $varlongitud = strlen($varimagentemp);

         $varimagen =  substr($varimagentemp, 0, $varlongitud - 3);
         $vararchivoimagen = "../imagenes_predios_webp/" . $varimagen . "webp";

         if (file_exists($vararchivoimagen))
            echo "<div class=areaFoto> <p class=textoCodigopredio> $varcategoria ($varcodigopredio) </p>
                  <img class=imagenPredio src=" . $vararchivoimagen . ">
               </div>";
      };

      foreach ($arrayimagenes as $imagen) {
         $varimagentemp = $imagen["Archivo_Imagen"];
         $varcodigopredio = $imagen["Codigo_Predio"];
         $varlongitud = strlen($varimagentemp);

         $varimagen =  substr($varimagentemp, 0, $varlongitud - 3);

         $vararchivoimagen = "../imagenes_predios_webp/" . $varimagen . "webp";

         if (file_exists($vararchivoimagen))
            echo "<div class=areaFoto> <p class=textoCodigopredio> $varcategoria ($varcodigopredio) </p>
                  <img class=imagenPredio src=" . $vararchivoimagen . " area-hidden='True' >
               </div>";
      };
?>