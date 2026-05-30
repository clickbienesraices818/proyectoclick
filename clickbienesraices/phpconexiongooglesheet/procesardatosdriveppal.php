<?php

// Validar si se solicitó la acción específica


//---------------------------------------------------

// LLAMADA A CREAR LA CONEXION A LA BASE DE DATOS
include 'conexionBDHosting.php';

//LLAMADO A LA CONEXION CON GOOGLESHEET
include  'conexiongoogledriveimagenes.php';

//------------------------------------------------------------------
/* TRAER LOS DEL DIRECTORIO */
// 3. Obtener los archivos dentro del directorio
set_time_limit(0); 

$allFiles = array(); // Aquí se guardarán ABSOLUTAMENTE TODOS los archivos
$pageToken = null;

do {
    $optParams = array(
        'pageSize' => 100, 
        'q' => "'$folderId' in parents and trashed = false",
        'fields' => 'nextPageToken, files(id, name)'
    );

    // Si ya tenemos un token de la vuelta anterior, lo agregamos
    if ($pageToken) {
        $optParams['pageToken'] = $pageToken;
    }

    // Consulta a la API
    $results = $service->files->listFiles($optParams);
    
    // Fusionar los archivos encontrados en el arreglo principal
    $allFiles = array_merge($allFiles, $results->getFiles());

    // Actualizar el token para la siguiente vuelta (será null si ya no hay más)
    $pageToken = $results->getNextPageToken();

} while ($pageToken); // El bucle se repite mientras Google diga que hay más páginas


// 4. Mostrar resultados
if (count($allFiles) == 0) {
    print "No se encontraron archivos en el directorio.\n";
} else {
    foreach ($allFiles as $file) {

        // El ID único del archivo de Drive
        $fileId = $file->getId();
        $fileName = $file->getName();

        $sqlimagenes = "SELECT Archivo_Imagen
                        FROM pr_imagenes
                        WHERE Archivo_Imagen = '$fileName'";

        $imagenesTotal = $conexion->query($sqlimagenes);

        $varregtotal = mysqli_num_rows($imagenesTotal);
        if ($varregtotal == 0) {
            printf($varregtotal,"\n<br>");
            printf("Archivo Eliminado : %s (%s)\n<br>", $file->getName(), $file->getId());
        }


        /*try {
            // Elimina el archivo permanentemente
            $driveService->files->delete($fileId);
            echo "Archivo eliminado correctamente.";
        } catch (Exception $e) {
            print "Ocurrió un error: " . $e->getMessage();
        }*/


        
    }
}

    // CERRAR LA CONEXION
    mysqli_close($conexion);


    ?>
