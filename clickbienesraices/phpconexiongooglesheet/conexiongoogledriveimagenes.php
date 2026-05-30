<?php
/* SE REALIZA LA CONEXION A GOOGLE DRIVE */

require '..\vendor\autoload.php';

// 1. Configurar el cliente de Google
$client = new Google_Client();
$client->setApplicationName('Conexion Google Drive PHP');
$client->setScopes([Google_Service_Drive::DRIVE]);

// Ruta a tu archivo JSON descargado en el paso 1
$client->setAuthConfig('..\apikey\clickbienesraices-4891a1f55461.json');

// 2. Crear el servicio de Sheets
$service = new Google_Service_Drive($client);

// 3. ID de tu Google Sheet (lo encuentras en la URL de tu navegador)
$folderId = '1maZs817s1NOn1XeBY5NZ2hqNwjn4g_4l';
