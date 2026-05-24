<?php

//LLAMADO A LA CONEXION CON GOOGLESHEET
include  'conexiongooglesheet.php';

// LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
include 'conexionBDHosting.php';

//---------------------------------------------------

// --- EJEMPLO 1: LEER DATOS ---
$range = "PR Predios Exportar!A2:R1000"; // Rango a leer
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (!empty($values)) {
    foreach ($values as $row) {
        // Imprimir datos de cada fila
        echo $row[0] . " - " . $row[1] . "<br>";
    }
}

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