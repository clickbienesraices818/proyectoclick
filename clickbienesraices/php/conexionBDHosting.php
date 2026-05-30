<?php
$servidor="148.113.168.24:3306";
$usuario="clickbie_consulta";
$password="ClickbieConsulta";
$dbname="clickbie_clickbienesraices";

// Crear la conexión

$conexion = mysqli_connect($servidor, $usuario, $password, $dbname);

$conexion->set_charset("utf8mb4");

// Verificar la conexión
if (!$conexion)
    die("Conexión fallida: " . mysqli_connect_error());
/*else 
    echo ("Conexion exitosa");*/


// Cerrar conexión (opcional al final del script)
//mysqli_close($conexion);