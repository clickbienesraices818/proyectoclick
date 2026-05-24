php<?php
require __DIR__ . '/vendor/autoload.php';

// 1. Configurar el cliente de Google
$client = new Google_Client();
$client->setApplicationName('Conexion Google Sheets PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
// Ruta a tu archivo JSON descargado en el paso 1
$client->setAuthConfig(__DIR__ . '/apikey/clickbienesraices-2aa3370471af.json');

// 2. Crear el servicio de Sheets
$service = new Google_Service_Sheets($client);

// 3. ID de tu Google Sheet (lo encuentras en la URL de tu navegador)
$spreadsheetId = "1BWtJrrwsBSCdkbFv67f-KQCscMeuwCfZZto7ygJ5Ghg"; 

// --- EJEMPLO 1: LEER DATOS ---
$range = "Hoja1!A1:C10"; // Rango a leer
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (!empty($values)) {
    foreach ($values as $row) {
        // Imprimir datos de cada fila
        echo $row[0] . " - " . $row[1] . "<br>";
    }
}

// --- EJEMPLO 2: ESCRIBIR DATOS ---
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
echo "Datos insertados correctamente.";