<?php

// Validar si se solicitó la acción específica
 if (isset($_POST['actualizarPredios']))
    actualizarPredios();
elseif (isset($_POST['actualizarCaracteristicas']))
    actualizarCaracteristicas();
elseif (isset($_POST['actualizarImagenes']))
    actualizarImagenes();
elseif (isset($_POST['actualizarCategorias']))
    actualizarCategorias(); 

//---------------------------------------------------

function actualizarPredios()
{
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    include 'conexionBDHosting.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheet.php';

    //-------------------------------------
    // BORRA LA TABLA DE PREDIOS

    $sqlpredios = "DELETE
        FROM pr_predios";

    $prediosTotal = $conexion->query($sqlpredios);

    //------------------------------------------------------------------
    /* TRAER LOS PREDIOS DESDE GOOGLE PR PRDEDIOS EXPORTAR
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "PR Predios Exportar!A3:R1000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varpredios = $response->getValues();
    $varcantidad = 0;

    if (!empty($varpredios)) {
        foreach ($varpredios as $Predio) {
            if (($Predio[1] != "Inactivo") && ($Predio[14] = "TRUE")) {

                $varcantidad++;
                $varcodigopredio = $Predio[0];
                $varestado = $Predio[1];
                $vartipo = $Predio[2];
                $varcategoria = $Predio[3];
                $varcategoriab = $Predio[4];
                $varmunicipio = $Predio[5];
                $varubicacion = $Predio[6];
                $vardescripcion = $Predio[7];
                $varvalor = $Predio[8];
                $varareatotal = $Predio[9];
                $varmedidaat = $Predio[10];
                $varareaconstruida = $Predio[11];
                $varmedidaac = $Predio[12];
                $varenlacesite = $Predio[13];
                $varcompleto = $Predio[14];
                $varcodigocategoria = $Predio[15];
                $varcodigocategoriab = $Predio[16];
                $varvalornumero = $Predio[17];

                $sqlpredios = "INSERT INTO pr_predios (Codigo_Predio, Estado, Tipo, Categoria, Categoria_B,
                                    Municipio, Ubicacion, Descripcion, Valor, Area_Total, Medida_AT,
                                    Area_Construida, Medida_AC, Enlace_Site, Completo, Codigo_Categoria,
                                    Codigo_Categoria_B, Valor_Numero)
                            VALUES ('$varcodigopredio', '$varestado', '$vartipo', '$varcategoria',
                                    '$varcategoriab', '$varmunicipio', '$varubicacion', '$vardescripcion',
                                    '$varvalor', '$varareatotal', '$varmedidaat', '$varareaconstruida', 
                                    '$varmedidaac', '$varenlacesite', '$varcompleto', '$varcodigocategoria',
                                    '$varcodigocategoriab', '$varvalornumero')";

                $prediosTotal = $conexion->query($sqlpredios);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);


    echo "<p> Se procesaron:   $varcantidad   Predios </p> ";
};


// --------------    ACTUALIZAR LAS CARACTERISTICAS DE LOS PREDIOS
function actualizarCaracteristicas()
{
    set_time_limit(0);

    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    include 'conexionBDHosting.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheet.php';

    
    //------------------------------------------------------------------
    // BORRA LA TABLA DE CARACTERISTICAS
    $sqlcaracteristicas = "DELETE
      FROM pr_caracteristicas";

    $caracteristicasTotal = $conexion->query($sqlcaracteristicas);

    /* TRAER LAS CARACTERISTICAS DE LOS PREDIOS DESDE GOOGLE SHEETS
        Y SUBIRLOS A LA BASE DE DATOS */

    $range = "PR Caracteristicas Exportar!A2:F10000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varcaracteristicas = $response->getValues();
    $varcantidad = 0;

    if (!empty($varcaracteristicas)) {
        foreach ($varcaracteristicas as $Caracteristica) {
            if (!empty([$Caracteristica[0]]) && [$Caracteristica[5]] === "TRUE") {

                $varcantidad++;
                $varcodigopredio = $Caracteristica[0];
                $varcaracteristica = $Caracteristica[1];
                $varvalor = $Caracteristica[2];
                $varorden = $Caracteristica[3];
                $varcodigocategoria = $Caracteristica[4];

                $sqlcaracteristicas = "INSERT INTO pr_caracteristicas (Codigo_Predio, Caracteristica, 
                        Valor, Orden, Codigo_Categoria)
                    VALUES ('$varcodigopredio', '$varcaracteristica', '$varvalor', 
                            '$varorden', '$varcodigocategoria')";

                $caracteristicasTotal = $conexion->query($sqlcaracteristicas);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "<p> Se procesaron:   $varcantidad   Caracteristicas </p> ";
};

//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD IMAGENES
function actualizarImagenes()
{
    set_time_limit(0);
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    include 'conexionBDHosting.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheet.php';

    // BORRA LA TABLA DE IMAGENES
    $sqlimagenes = "DELETE
      FROM pr_imagenes";

    $imagenesTotal = $conexion->query($sqlimagenes);

    //------------------------------------------------------------------
    /* TRAER LAS IMAGENES OS PREDIOS DESDE GOOGLE SHEET
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "PR Imagenes Exportar!A2:G10000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varimagenes = $response->getValues();
    $varcantidad = 0;

    if (!empty($varimagenes)) {
        foreach ($varimagenes as $Imagen) {
            if (!empty([$Imagen[0]]) && [$Imagen[6]] === "TRUE") {
                
                $varcantidad++;
                $varcodigopredio = $Imagen[0];
                $varnombreimagen = $Imagen[1];
                $varredes = $Imagen[2];
                $vararchivoimagen = $Imagen[3];
                $varcodigocategoria = $Imagen[4];
                $varorden = $Imagen[5];

                $sqlimagenes = "INSERT INTO pr_imagenes (Codigo_Predio, Nombre_Imagen, Redes,
                                            Archivo_Imagen, Codigo_Categoria, Orden)
                                VALUES ('$varcodigopredio', '$varnombreimagen', '$varredes', 
                                '$vararchivoimagen', '$varcodigocategoria', '$varorden')";

                $imagenesTotal = $conexion->query($sqlimagenes);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "<p> Se procesaron:   $varcantidad   Imagenes </p> ";
};


//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD CATEGORIAS
function actualizarCategorias()
{

    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    include 'conexionBDHosting.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheet.php';

    // BORRA LA TABLA DE IMAGENES
    $sqlcategorias = "DELETE
      FROM pr_categorias";

    $categoriasTotal = $conexion->query($sqlcategorias);

    //------------------------------------------------------------------
    /* TRAER LAS IMAGENES OS PREDIOS DESDE GOOGLE SHEET
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "PR Categorias Exportar!A2:F10000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varcategorias = $response->getValues();
    $vartotalregistros = count($varcategorias);
    $varcantidad = 0;

    if (!empty($varcategorias)) {
        foreach ($varcategorias as $categoria) {
            if (!empty([$categoria[0]])) {

                $varcantidad++;
                $varcodigocategoria = $categoria[0];
                $varcategoria = $categoria[1];
                $varcategoriaredes = $categoria[2];
                $varimagen = $categoria[3];

                $varprogreso = ( $varcantidad / $vartotalregistros ) * 100;

                echo "<p class='mensajeProceso'> Procesando :" .  $varcategoria . "</p>";

                $sqlcategorias = "INSERT INTO pr_categorias (Codigo_Categoria, Categoria, 
                                            Categoria_Redes, Imagen)
                                VALUES ('$varcodigocategoria', '$varcategoria', '$varcategoriaredes', '$varimagen')";

                $categoriasTotal = $conexion->query($sqlcategorias);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "<p> Se procesaron:   $varcantidad   categorias </p> ";
};


/* // --- EJEMPLO 2: ESCRIBIR DATOS ---
$rangeToWrite = "Hoja1!A1"; // Rango donde empezará a escribir
$valuesToWrite = [
    ["Dato 1", "Dato 2", "Dato 3"]
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $valuesToWrite
]);
$params = [
    'valueInputOption' => 'RAW' // o 'USER_ENTERED'
];
$result = $service->spreadsheets_values->update($spreadsheetId, $rangeToWrite, $body, $params);
echo "Datos insertados correctamente."; */

?>

