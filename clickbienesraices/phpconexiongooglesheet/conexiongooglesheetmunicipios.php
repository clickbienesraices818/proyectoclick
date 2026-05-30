<?php
/* SE REALIZA LA CONEXION A GOOGLE SHEETS */

require '..\vendor\autoload.php';

// 1. Configurar el cliente de Google
$client = new Google_Client();
$client->setApplicationName('Conexion Google Sheets PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

// Ruta a tu archivo JSON descargado en el paso 1
$client->setAuthConfig('..\apikey\clickbienesraices-4891a1f55461.json');

// 2. Crear el servicio de Sheets
$service = new Google_Service_Sheets($client);

// 3. ID de tu Google Sheet (lo encuentras en la URL de tu navegador)
$spreadsheetId = "1ToqkvB0aRUFkMCUC3Dgpd7sij1JLXd9FrRupOOmc_PE"; 

