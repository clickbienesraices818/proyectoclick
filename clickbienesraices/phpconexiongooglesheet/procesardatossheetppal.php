<?php

// Validar si se solicitó la acción específica

if (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarPredios' && isset($_GET['basedatos']))
    actualizarPredios($_GET['basedatos']);
elseif (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarCaracteristicas' && isset($_GET['basedatos']))
    actualizarCaracteristicas($_GET['basedatos']);
elseif (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarImagenes' && isset($_GET['basedatos']))
    actualizarImagenes($_GET['basedatos']);
elseif (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarCategorias' && isset($_GET['basedatos']))
    actualizarCategorias($_GET['basedatos']);
elseif (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarNoticias' && isset($_GET['basedatos']))
    actualizarNoticias($_GET['basedatos']);
elseif (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizarMunicipios' && isset($_GET['basedatos']))
    actualizarMunicipios($_GET['basedatos']);
//---------------------------------------------------

function actualizarPredios($varbasedatos)
{
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetpredios.php';

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
    $varregtotal = count($varpredios);
    $varregprocesados = 0;

    if (!empty($varpredios)) {
        foreach ($varpredios as $Predio) {
            if ($Predio[1] != "Inactivo" && $Predio[14] === 'TRUE') {
                $varregprocesados++;
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


    echo "Se Procesaron: " . $varregprocesados . "  Predios";
};


// --------------    ACTUALIZAR LAS CARACTERISTICAS DE LOS PREDIOS
function actualizarCaracteristicas($varbasedatos)
{
    set_time_limit(0);

    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetpredios.php';


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
    $varregtotal = count($varcaracteristicas);
    $varregprocesados = 0;

    if (!empty($varcaracteristicas)) {
        foreach ($varcaracteristicas as $Caracteristica) {
            if (!empty([$Caracteristica[0]]) && $Caracteristica[5] === "TRUE") {
                $varregprocesados++;
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

    echo "Se Procesaron: " . $varregprocesados . "  Caracteristicas";
};

//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD IMAGENES
function actualizarImagenes($varbasedatos)
{
    set_time_limit(0);
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetpredios.php';

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
    $varregtotal = count($varimagenes);
    $varregprocesados = 0;

    if (!empty($varimagenes)) {
        foreach ($varimagenes as $Imagen) {
            if (!empty([$Imagen[0]]) && $Imagen[6] === 'TRUE') {
                $varregprocesados++;
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

    echo "Se Procesaron: " . $varregprocesados . "  Imagenes";
};

//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD NOTICIAS
function actualizarNoticias($varbasedatos)
{
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetnoticias.php';

    // BORRA LA TABLA DE IMAGENES
    $sqlnoticias = "DELETE
      FROM ne_noticias";

    $noticiasTotal = $conexion->query($sqlnoticias);

    //------------------------------------------------------------------
    /* TRAER LAS NOTICIAS  DESDE GOOGLE SHEET
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "NE Noticias Exportar!A2:I1000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varnoticias = $response->getValues();
    $varregtotal = count($varnoticias);
    $varregprocesados = 0;

    if (!empty($varnoticias)) {
        foreach ($varnoticias as $noticia) {

            if (!empty([$noticia[0]]) && $noticia[8] === "TRUE") {
                $varregprocesados++;
                $varidnoticia = $noticia[0];
                $varfechapublicar = $noticia[1];
                $varfechadesmontar = $noticia[2];
                $vartitulo = $noticia[3];
                $varcontenido = $noticia[4];
                $varleermas = $noticia[5];
                $varcreditos = $noticia[6];
                $varimagen = $noticia[7];
                $varactivo = $noticia[8];


                $sqlnoticias = "INSERT INTO ne_noticias (ID_Noticia, Fecha_Publicar, Fecha_Desmontar,
                                            Titulo, Contenido, Leer_Mas, Creditos, Imagen, Activo)
                                VALUES ('$varidnoticia', '$varfechapublicar', '$varfechadesmontar', 
                                        '$vartitulo', '$varcontenido', '$varleermas', '$varcreditos',
                                        '$varimagen', '$varactivo')";

                $noticiasTotal = $conexion->query($sqlnoticias);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "Se Procesaron: " . $varregprocesados . "  noticias";
};

//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD CATEGORIAS
function actualizarCategorias($varbasedatos)
{

    set_time_limit(0);
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS

    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';


    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetpredios.php';

    // BORRA LA TABLA DE CATEGORIAS
    $sqlcategorias = "DELETE
      FROM pr_categorias";

    $categoriasTotal = $conexion->query($sqlcategorias);

    //------------------------------------------------------------------
    /* TRAER LAS CATEGORIAS DESDE GOOGLE SHEET
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "PR Categorias Exportar!A2:F10000"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varcategorias = $response->getValues();
    $varregtotal = count($varcategorias);
    $varregprocesados = 0;

    if (!empty($varcategorias)) {
        foreach ($varcategorias as $categoria) {
            if (!empty([$categoria[0]])) {
                $varregprocesados++;
                $varcodigocategoria = $categoria[0];
                $varcategoria = $categoria[1];
                $varcategoriaredes = $categoria[2];
                $varimagen = $categoria[3];

                $sqlcategorias = "INSERT INTO pr_categorias (Codigo_Categoria, Categoria, 
                                            Categoria_Redes, Imagen)
                                VALUES ('$varcodigocategoria', '$varcategoria', '$varcategoriaredes', '$varimagen')";

                $categoriasTotal = $conexion->query($sqlcategorias);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "Se Procesaron: " . $varregprocesados . "  categorias";
};

//---------------------------------------------------------------------------
//    ACTUALIZAR LAS BD MUNICIPIOS
function actualizarMunicipios($varbasedatos)
{
    // LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
    if ($varbasedatos === "BDHosting")
        include 'conexionBDHosting.php';
    elseif ($varbasedatos === "BDLocal")
        include 'conexionBDLocal.php';

    //LLAMADO A LA CONEXION CON GOOGLESHEET
    include  'conexiongooglesheetmunicipios.php';

    // BORRA LA TABLA DE IMAGENES
    $sqlmunicipios = "DELETE
      FROM si_municipios";

    $municipiosTotal = $conexion->query($sqlmunicipios);

    //------------------------------------------------------------------
    /* TRAER LAS municipios  DESDE GOOGLE SHEET
        Y SUBIRLOS A LA BASE DE DATOS */


    $range = "SI Municipios!C2:C100"; // Rango a leer
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $varmunicipios = $response->getValues();
    $varregtotal = count($varmunicipios);
    $varregprocesados = 0;

    if (!empty($varmunicipios)) {
        foreach ($varmunicipios as $municipio) {

            if (!empty([$municipio[0]])) {
                $varregprocesados++;
                $varmunicipio = $municipio[0];

                $sqlmunicipios = "INSERT INTO si_municipios (Municipio)
                                VALUES ('$varmunicipio')";

                $municipiosTotal = $conexion->query($sqlmunicipios);
            };
        };
    };

    // CERRAR LA CONEXION
    mysqli_close($conexion);

    echo "Se Procesaron: " . $varregprocesados . "  municipios";
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