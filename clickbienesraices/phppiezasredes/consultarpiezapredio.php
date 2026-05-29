<?php

// LLAMDA A CREAR LA CONEXION A LA BASE DE DATOS
include '../php/conexionBDHosting.php';

$varseltipo = 1;

if ( $varseltipo === 1 ) {
   $vartipo = "Urbano";
   $vararchivophp = "desplegarpiezaurbanopiloto.php";
}
else {
   $vartipo = "Rural";
   $vararchivophp = "desplegarpiezaruralpiloto.php";
}


//-------------------------------------
// EJECUTA LA CONSULTA PARA CODIGO DE LOS PREDIOS
$arraycodpredios = [];

$sqlcodpredios = "SELECT Codigo_Predio, Categoria
         FROM pr_predios
         WHERE Estado != 'Inactivo' AND Completo = 'TRUE' AND Tipo = '$vartipo'
         ORDER BY 1";


$codprediosTotal = $conexion->query($sqlcodpredios);

// Procesar y mostrar los resultados

if ($codprediosTotal->num_rows > 0)
   while ($codpredioActual = $codprediosTotal->fetch_assoc()) {
      array_push($arraycodpredios, $codpredioActual);
   };


mysqli_close($conexion);

?>

<!-- **************************************************************** -->
<!-- HTML DEL FORMULARIO-->
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="../imagenes_site/logo pestana.png" type="image/png">

   <!--------- STYLES -------------------->
   <link rel="stylesheet" href="../css/styleconsultasconsolidado.css">


   <!--------- SCRIPTS -------------------->
   <title> Generar Pieza Predio</title>


</head>

<body>
   <header>
      <!---------- BARRA MENU ------------------->
      <?php
      $TIPOOFERTA = "Todas";
      include '../php/traercategorias.php';
      include '../php/barramenu2nivel.php';
      ?>
   </header>
   <main>
      <!---------- TITULO ------------------->
      <div id="areatitulos">
         <h1 id="textotitulos">
            GENERADOR DE PIEZAS PREDIO URBANO
         </h1>
         <a href="../index.php">
            <img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
         </a>
      </div>


      <!-- FORMULARIO CAPTURA DATOS CONSULTA -->
      <form class="formularioConsulta" action='<?php echo $vararchivophp ?>' method="POST">
         <!-- PREGUNTA CODIGO DEL PREDIO -->
         <div class="areaPregunta">
            <label for="codigosPredios" class="tituloOpcion">Codigo Predio</label>
            <select id="codigosPredios" class="listasOpciones" name="codigosPredios">
               <option value="" disabled selected hidden>Selecciona una opción</option>
               <?php
               foreach ($arraycodpredios as $codigopredio) {
                  $codpredio = $codigopredio["Codigo_Predio"];
                  echo "<option class='campoOpcion' value=" . $codpredio . ">" . $codpredio . "</option>";
               };
               ?>
            </select>
         </div>
         <div>
            <button class="botonConsultar" type="submit">Generar Pieza</button>
         </div>
      </form>
   </main>

   <!---------- PIE DE PAGINA ------------------->
   <hr class="separador">
   <footer>
      <?php
      include 'footer2Nivel.php'
      ?>
   </footer>

</body>

</html>