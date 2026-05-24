<?php

    // 1. Incluir la librería

    require '../libs/phpqrcode/qrlib.php';

    // 2. Definir contenido y nombre del archivo
    $contenido = 'www.clickbienesraices.com.co';
    $archivo = 'codigo_qr.png';

    // 3. Generar código QR
    QRcode::png($contenido, $archivo);

    echo "Código QR generado con éxito: <img src=' ".$archivo."' />";
?>