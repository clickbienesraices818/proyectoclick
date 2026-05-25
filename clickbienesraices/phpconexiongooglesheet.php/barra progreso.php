<?php
// Define el porcentaje de progreso de forma dinámica (puede venir de una base de datos)
$progreso = 45; 


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Progreso en PHP y HTML</title>
    <style>

    </style>
</head>
<body>

<div class="contenedor">
    <!-- Muestra el número del porcentaje actual -->
    <div class="texto">Progreso: <?php echo $progreso; ?>%</div>
    
    <div class="barra-fondo">
        <div class="barra-progreso"></div>
    </div>
</div>

</body>
</html>