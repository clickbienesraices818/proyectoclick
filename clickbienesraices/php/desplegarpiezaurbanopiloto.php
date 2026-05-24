<?php

if (isset($_POST['codigosPredios']))
   $varcodigopredio = $_POST['codigosPredios'];

/*$varcodigopredio = $_GET['codpredio'];*/

// LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
include 'conexionBDHosting.php';

//******************************************* */


$arraypredios = [];
$arraycaracteristicas = [];
$arrayimagenes = [];


//-------------------------------------
// EJECUTA LA CONSULTA PARA LOS PREDIOS

$sqlpredios = "SELECT a.Codigo_Predio, a.Ubicacion, b.Categoria_Redes, a.Valor, 
                  a.Area_Total, a.Medida_AT, a.Municipio
               FROM pr_predios as a, pr_categorias as b
               WHERE a.Codigo_Predio = '$varcodigopredio' AND a.Categoria = b.Categoria";

$prediosTotal = $conexion->query($sqlpredios);

// Procesar y mostrar los resultados

if ($prediosTotal->num_rows > 0)
   while ($predioActual = $prediosTotal->fetch_assoc()) {
      array_push($arraypredios, $predioActual);
   }

foreach ($arraypredios as $predio) {
   $varcategoria = $predio['Categoria_Redes'];
   $varmunicipio = $predio['Municipio'];
   $varubicacion = $predio['Ubicacion'];
   $varvalorpredio = $predio['Valor'];
   $varareatotal = $predio['Area_Total'];
   $varmedidaat = $predio['Medida_AT'];
};

//--------------------------------------------
// EJECUTA LA CONSULTA PARA LAS CARACTERISTICAS
$sqlcaracteristicas = "SELECT Caracteristica, Valor
               FROM pr_caracteristicas
               WHERE Codigo_Predio = '$varcodigopredio' AND Caracteristica IN ('Habitaciones', 'Baños')";


$caracteristicasTotal = $conexion->query($sqlcaracteristicas);

// Procesar y mostrar los resultados
if ($caracteristicasTotal->num_rows > 0)
   while ($caracteristicaActual = $caracteristicasTotal->fetch_assoc()) {
      array_push($arraycaracteristicas, $caracteristicaActual);
   }

foreach ($arraycaracteristicas as $caracteristica) {
   if ($caracteristica["Caracteristica"] === 'Habitaciones')
      $varnumhabitaciones = $caracteristica['Valor'];
   elseif ($caracteristica["Caracteristica"] === 'Baños')
      $varnumbanos = $caracteristica['Valor'];
};

if (!isset($varnumhabitaciones))
   $varnumhabitaciones = 0;
if (!isset($varnumbanos))
   $varnumbanos = 0;

//----------------------------------------------------
// EJECUTA LA CONSULTA PARA LAS IMAGENES
$sqlimagenes = "SELECT Codigo_predio, Archivo_Imagen, Redes
               FROM pr_imagenes
               WHERE Codigo_Predio = '$varcodigopredio' AND  Redes > 0
               ORDER BY Redes";


$imagenesTotal = $conexion->query($sqlimagenes);

// 3. Procesar y mostrar los resultados
if ($imagenesTotal->num_rows > 0)
   while ($imagenActual = $imagenesTotal->fetch_assoc()) {
      array_push($arrayimagenes, $imagenActual);
   }

foreach ($arrayimagenes as $imagen) {
   $varnombrearchivo = $imagen["Archivo_Imagen"];
   $varlongitudnombre = strlen($varnombrearchivo);
   $varnombreimagen = substr($varnombrearchivo, 0, $varlongitudnombre - 4) . ".webp";
   echo ($varnombreimagen);
   if ($imagen["Redes"] == 1) {
      $varimagenppal = $varnombreimagen;
   } elseif ($imagen["Redes"] == 2)
      $varimagensup = $varnombreimagen;
   elseif ($imagen["Redes"] == 3)
      $varimageninf = $varnombreimagen;
};


// CERRAR LA CONEXION
mysqli_close($conexion);

?>

<!-- *********************************************************** -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- CSS PERSONALIZADOS -->
   <link rel="stylesheet" href="../css/stylepiezaredesurbano.css">
   <title>Pieza Predio</title>
</head>

<body>
   <div class="seccionPieza">
      <div class="areaPieza">
         <div class="areaCuerpo">
            <div class="areaIzquierda">
               <div class="areaCategoria">
                  <?php
                  echo "<p class='textoCategoria'> $varcategoria </p>"
                  ?>
               </div>
               <div class="imagenPrincipal">
                  <?php
                  echo "<img class='imgPrincipal' src='../imagenes_predios_webp/$varimagenppal'></img>
                  <p class='textoCodigo'> Código: $varcodigopredio</p>"
                  ?>
               </div>
            </div>
            
            <div class="areaDerecha">
               <div class="areaInformacion">
                  <div class="areaUbicacion">
                     <img class="iconoUbicacion" src="../iconos/ubicacion.ico"></img>
                     <?php
                     echo "<div class='areaDatosubicacion'> 
                           <p class='textoMunicipio'>$varmunicipio</p>
                           <p class='textoUbicacion'>$varubicacion</p>
                           </div>"
                     ?>
                  </div>

                  <div class="areaValor">
                     <?php
                     echo "<p class='textoValor'> $varvalorpredio</p> 
                           <p class='textoCop'>   COP</p>"
                     ?>
                  </div>

                  <div class="areaCaracteristicas">
                     <div class="caracteristica">
                        
                        <?php
                           if ($varnumhabitaciones > 0)
                              echo "<img class='iconoHabitaciones' src='../iconos/habitaciones.ico'></img>
                                    <p class='textoCaracteristica'> $varnumhabitaciones</p>";
                        ?>
                     </div>

                     <div class="caracteristica">
                        
                        <?php
                           if ($varnumbanos > 0)
                              echo "<img class='iconoBanos' src='../iconos/bano.ico'></img>
                                    <p class='textoCaracteristica'> $varnumbanos</p>";
                        ?>
                     </div>

                     <div class="caracteristica">
                        <img class="iconoArea" src="../iconos/area.ico"></img>
                        <?php
                        echo "<p class='textoCaracteristica'>$varareatotal</p>
                           <p class='textoMedida'> m2 </p>"
                        ?>
                     </div>
                  </div>
               </div>

               <div class="imagenSuperior">
                  <?php
                  echo "<img class='imgSuperior' src='../imagenes_predios_webp/$varimagensup'>";
                  ?>

               </div>

               <div class="imagenInferior">
                  <?php
                  echo "<img class='imgInferior' src='../imagenes_predios_webp/$varimageninf'>";
                  ?>
               </div>
            </div>
         </div>
      </div>
      <div class="areaPiepieza">
         <img class="logoPie" src="../imagenes_site/logo blanco.png">
         <p class="textoPie">
            www.clickbienesraices.com.co
         </p>
      </div>
   </div>
</body>

</html>