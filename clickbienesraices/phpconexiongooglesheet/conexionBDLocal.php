<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$dbname = "clickbie_clickbienesraices";

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $dbname);

// Verificar la conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
//echo "Conexión exitosa";

// Cerrar conexión (opcional al final del script)
// mysqli_close($conexion);


// 4. Cerrar conexión
//mysqli_close($conexion);
