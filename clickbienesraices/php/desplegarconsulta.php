<?php

   if (isset($_POST['codigosPredios'])) {
      $varcodigopredio = $_POST['codigosPredios'];
      if ($varcodigopredio === "Todos")
         $varcodigopredio = null;
   } else {
      // El elemento estaba deshabilitado o no se envió
      $varcodigopredio = null; // o un valor por defecto
   }

   // LLAMDA A CREAR LA CONEXION A LA BASE DE DATOS
   include 'conexionBDHosting.php';

   // CONSULTA PARA UN PREDIO ESPECIFICO
   if ($varcodigopredio != null) {
      $sqlpredios = "SELECT *
         FROM pr_predios
         WHERE Codigo_Predio = '$varcodigopredio'";
   } else {     
      $varcategoriatemp = $_POST['Categorias'];
      $varmunicipio = $_POST['Municipios'];
      $varvalordesde = $_POST['Valordesde'];
      $varvalorhasta = $_POST['Valorhasta'];

      switch ($varcategoriatemp) {
         case "UAE":
            $varcategoria = "Apartaestudios";
            break;
         case "UA":
            $varcategoria = "Apartamentos";
            break;
         case "UB":
            $varcategoria = "Bodegas";
            break;
         case "UC":
            $varcategoria = "Casas";
            break;
         case "RC":
            $varcategoria = "Casas Campestres Rurales";
            break;
         case "UCC":
            $varcategoria = "Casas Campestres Urbanas";
            break;
         case "UCE":
            $varcategoria = "Casas Comerciales-Edificios";
            break;
         case "UK":
            $varcategoria = "Casas Conjuntos Cerrados";
            break;
         case "RF":
            $varcategoria = "Fincas";
            break;
         case "RL":
            $varcategoria = "Lotes Rurales";
            break;
         case "UL":
            $varcategoria = "Lotes Urbanos";
            break;
         case "UOL":
            $varcategoria = "Oficinas - Locales - Cosnultorios";
            break;
         case "RP":
            $varcategoria = "Proyectos Rurales";
            break;
         case "UP":
            $varcategoria = "Proyectos Urbanos";
            break;
         case "RT":
            $varcategoria = "Temperaderos - Cabañas";
            break;
         default:
            $varcategoria =  "Todas";
      }

      // CONSULTAS DE CATEGORIAS O MUNICIPIOS PERO SIN RANGO DE VALORES

      if ($varcategoria === "Todas" && $varmunicipio === "Todos" && $varvalordesde == 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria === "Todas" && $varmunicipio !== "Todos" && $varvalordesde == 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE BINARY Municipio = '$varmunicipio' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria !== "Todas" && $varmunicipio === "Todos" && $varvalordesde == 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE BINARY Categoria = '$varcategoria' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria !== "Todas" && $varmunicipio != "Todos" && $varvalordesde == 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE Municipio = '$varmunicipio' AND  Categoria = '$varcategoria' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      // // CONSULTAS DE CATEGORIAS O MUNICIPIOS PERO CON RANGO DE VALORES

      if ($varcategoria === "Todas" && $varmunicipio === "Todos" && $varvalordesde > 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE Valor_Numero >= '$varvalordesde' AND Valor_Numero <= '$varvalorhasta' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria === "Todas" && $varmunicipio !== "Todos" && $varvalordesde > 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE Municipio = '$varmunicipio' AND Valor_Numero >= '$varvalordesde' AND Valor_Numero <= '$varvalorhasta' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria !== "Todas" && $varmunicipio === "Todos" && $varvalordesde > 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE BINARY Categoria = '$varcategoria' AND Valor_Numero >= '$varvalordesde' AND Valor_Numero <= '$varvalorhasta' AND Estado<>'Inactivo'  AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };

      if ($varcategoria !== "Todas" && $varmunicipio !== "Todos" && $varvalordesde > 0) {
         $sqlpredios = "SELECT *
            FROM pr_predios
            WHERE Municipio = '$varmunicipio' AND  Categoria = '$varcategoria' AND Valor_Numero >= '$varvalordesde' AND Valor_Numero <= '$varvalorhasta' AND Estado<>'Inactivo' AND Completo = 'TRUE'
            ORDER BY Categoria, Valor_Numero";
      };
   }

   //EJECUTAR LA CONSULTA

   $prediosTotal = $conexion->query($sqlpredios);

   // Procesar y mostrar los resultados

   $varresultadosconsulta = $prediosTotal->num_rows;

   $arraypredios = [];

   if ($prediosTotal->num_rows > 0)
      while ($predioActual = $prediosTotal->fetch_assoc()) {
         array_push($arraypredios, $predioActual);
      }
   // CERRAR LA CONEXION
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
   <link rel="stylesheet" href="../css/styledesplegarconsultaconsolidado.css">


   <!--------- SCRIPTS -------------------->
   <title> Resultado Consulta</title>


</head>

<body>
   <header>
      <!---------- BARRA MENU ------------------->
      <?php
         $TIPOOFERTA = "Todas";
         include 'traercategorias.php';
         include 'barramenu2nivel.php';
      ?>
   </header>

   <main>
      <!---------- TITULO ------------------->
      <div id="areatitulos">
         <h1 id="textotitulos">
            Resultado Consulta
         </h1>
         <a href="consultarpredios.php">
            <img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
         </a>
      </div>

      <!---------- MOSTRAR EL RESULTADO DE LA CONSULTA ------------------->
      <div id="datosConsulta">
         <p><span class="subtitulo"> Coincidencias =></span> <?php echo $varresultadosconsulta ?></p>
         <?php
            if ($varcodigopredio != null)
               echo "<p><span class='subtitulo'> Codigo Predio =></span>$varcodigopredio</p>";
            else {
               echo "
                  <p><span class='subtitulo'> Categoria =></span> $varcategoria</p>
                  <p><span class='subtitulo'> Municipio =></span> $varmunicipio</p>
                  <p><span class='subtitulo'> Valor Desde =></span> $varvalordesde</p>
                  <p><span class='subtitulo'> Valor Hasta =></span> $varvalorhasta</p>";
            }
         ?>
      </div>

      <div class="containerMensaje">
         <?php
            if (count($arraypredios) == 0)
               echo  "<p id='textoMensajeconsulta'> Lo sentimos, no hay predios disponibles para la consulta</p>";
         ?>
      </div>
      <div class=contenedorGrid>
         <?php
            foreach ($arraypredios as $predio) {
               $varenlace = $predio["Enlace_Site"];
               $varlongitud = strlen($predio["Enlace_Site"]);
               $varposicion = strpos($predio["Enlace_Site"], "php/");
               $varenlacesite =  substr($varenlace, $varposicion + 4, $varlongitud - $varposicion);

               echo "<div id='codigoPredio'>" . $predio["Codigo_Predio"] . "</div>";
               echo "<div id='categoria'>" . $predio["Categoria"] . "</div>";
               echo "<div id='municipio'>" . $predio["Municipio"] . "</div>";
               echo "<div id='valor'>" . $predio["Valor"] . "</div>";
               echo "<div id='enlace'> <a target='_blank' href='" . $varenlacesite . "'>
                  <img class=imgversite src='../imagenes_site/navegador.png'>Ver predio</a></div>";
         };
         ?>
      </div>
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