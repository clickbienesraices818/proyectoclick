<?php

// LLAMDA A CREAR LA CONEXION A LA BASE DE DATOS
include 'conexionBDHosting.php';

//-------------------------------------
// EJECUTA LA CONSULTA PARA CODIGO DE LOS PREDIOS
$arraycodpredios = [];

$sqlcodpredios = "SELECT Codigo_Predio, Categoria
         FROM pr_predios
         WHERE Estado != 'Inactivo' AND Completo = 'TRUE'
         ORDER BY 1";


$codprediosTotal = $conexion->query($sqlcodpredios);

// Procesar y mostrar los resultados

if ($codprediosTotal->num_rows > 0)
   while ($codpredioActual = $codprediosTotal->fetch_assoc()) {
      array_push($arraycodpredios, $codpredioActual);
   };

//-------------------------------------
// EJECUTA LA CONSULTA PARA CARGAR CATEGORIAS
$arraycategorias = [];

$sqlcategorias = "SELECT Categoria, Codigo_Categoria
         FROM pr_categorias
         WHERE Categoria  IN 
            ( SELECT Categoria FROM pr_predios WHERE Estado != 'Inactivo' AND Completo = 'TRUE' GROUP BY Categoria)
         ORDER BY 1";


$categoriasTotal = $conexion->query($sqlcategorias);

// Procesar y mostrar los resultados

if ($categoriasTotal->num_rows > 0)
   while ($categoriaActual = $categoriasTotal->fetch_assoc()) {
      array_push($arraycategorias, $categoriaActual);
   };

//-------------------------------------
// EJECUTA LA CONSULTA PARA CARGAR MUNICIPIOS

$arraymunicipios = [];

$sqlmunicipios = "SELECT Municipio
         FROM pr_predios
         GROUP BY Municipio
         ORDER BY 1";

$municipiosTotal = $conexion->query($sqlmunicipios);
// Procesar y mostrar los resultados

if ($municipiosTotal->num_rows > 0)
   while ($municipioActual = $municipiosTotal->fetch_assoc()) {
      array_push($arraymunicipios, $municipioActual);
   };

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
   <link rel="stylesheet" href="../css/styleconsultasconsolidado.css">


   <!--------- SCRIPTS -------------------->
   <title> Consultar Predios</title>


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
            Consulta Predios
         </h1>
         <a href="../index.php">
            <img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
         </a>
      </div>

      <!-- FORMULARIO CAPTURA DATOS CONSULTA -->
      <form class="formularioConsulta" action="desplegarconsulta.php" method="POST">

         <!-- PREGUNTA CODIGO DEL PREDIO -->
         <div class="areaPregunta">
            <label for="codigosPredios" class="tituloOpcion" >Codigo Predio</label>
            <select id="codigosPredios" class="listaOpciones" name="codigosPredios">
               <option class='campoOpcion' value="Todos" selected>Todos</option>
               <?php
                  foreach ($arraycodpredios as $codigopredio) {
                     $codpredio = $codigopredio["Codigo_Predio"];
                     echo "<option class='campoOpcion' value=" . $codpredio . ">" . $codpredio . "</option>";
                  };
               ?>
            </select>
            <script>
               varcodigopredio = document.getElementById("codigosPredios");
               varcodigopredio.addEventListener("input", function() {
                  if (varcodigopredio.value != "Todos") {
                     document.getElementById('Categorias').disabled = true;
                     document.getElementById('Municipios').disabled = true;
                     document.getElementById('valorDesde').disabled = true;
                     document.getElementById('valorHasta').disabled = true;
                  } else {
                     document.getElementById('Categorias').disabled = false;
                     document.getElementById('Municipios').disabled = false;
                     document.getElementById('valorDesde').disabled = false;
                     document.getElementById('valorHasta').disabled = false;
                  }
               });
            </script>
         </div>

         <!-- PREGUNTA CATEGORIA -->
         <div class="areaPregunta">
            <label for="Categorias" class="tituloOpcion">Categorias</label>
            <select id="Categorias" class="listaOpciones" name="Categorias">
               <option class='campoOpcion' value="Todas" selected>Todas</option>
               <?php
                  foreach ($arraycategorias as $categoria) {
                     $codcategoria = $categoria["Codigo_Categoria"];
                     echo "<option class='campoOpcion' value=" . $codcategoria . ">" . $categoria["Categoria"] . "</option>";
                  };
               ?>
            </select>
            <script>
               varcategoria = document.getElementById("Categorias");
               varcategoria.addEventListener("input", function() {
                  if (varcategoria.value != "Todas") {
                     document.getElementById('codigosPredios').disabled = true;
                    alert($_POST['codigosPredios']);
                     
                  } else {
                     document.getElementById('codigosPredios').disabled = false;
                     alert($_POST['codigosPredios']);
                  }
               });
            </script>
         </div>

         <!-- PREGUNTA MUNICIPIO  -->
         <div class="areaPregunta">
            <label for="Municipios" class="tituloOpcion">Municipios</label>
            <select id="Municipios" class="listaOpciones" name="Municipios">
               <option class='campoOpcion' value="Todos" selected>Todos</option>
               <?php
                  foreach ($arraymunicipios as $municipio) {
                     echo "<option class='campoOpcion' value=" . $municipio["Municipio"] . ">" . $municipio["Municipio"] . "</option>";
                  };
               ?>
            </select>
            <script>
               varmunicipio = document.getElementById("Municipios");
               varmunicipio.addEventListener("input", function() {
                  if (varmunicipio.value != "Todos") {
                     document.getElementById('codigosPredios').disabled = true;
                  } else {
                     document.getElementById('codigosPredios').disabled = false;
                  }
               });
            </script>
         </div>

         <!-- PREGUNTA RANGO VALORES -->
         <div class="areaRangovalores">
            <p class="tituloValor"> Rango Valor Predio</p>
            <p class="subtituloValor">(rangos de 100 millones)</p>
            <p class="areaValor">Desde <input id="valorDesde" type="number" step="100000000" name="Valordesde" min=0 value=0> </p>
            <p class="areaValor">Hasta <input id="valorHasta" type="number" step="100000000" name="Valorhasta" min=0 value=0> </p>
            <script>
               varvalordesde = document.getElementById("valorDesde");
               varvalorhasta = document.getElementById("valorHasta");
               varvalordesde.addEventListener("input", function() {
                  varvalorhasta.value = varvalordesde.value;
               })
               varvalordesde = document.getElementById("valorDesde");
               varvalordesde.addEventListener("input", function() {
                  if (varvalordesde.value > 0) {
                     document.getElementById('codigosPredios').disabled = true;
                  } else {
                     document.getElementById('codigosPredios').disabled = false;
                  }
               })
            </script>
         </div>
         <div>
            <button class="botonConsultar" type="submit">Consultar</button>
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