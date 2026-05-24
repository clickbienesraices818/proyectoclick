
window.onload = function () {
  cargarNoticias();
  console.log("Página completamente cargada (imágenes incluidas)");
}


// LLAMA LA FUNCIONES QUE VARGAN LOS DATOS DEL PREDIO
function cargarNoticias() {
  getnoticias();
  visualizarNoticias();
}

//--------------------------------------------------------
// IMPORTAR PREDIOS ---

function getnoticias() {

  arraynoticias = [];

  for (const noticia of listaNoticias) {

    const nuevanoticia = {
      ID_Noticia: noticia["ID_Noticia"],
      Fecha_Publicar: noticia["Fecha_Publicar"],
      Fecha_Desmontar: noticia["Fecha_Desmontar"],
      Titulo: noticia["Titulo"],
      Contenido: noticia["Contenido"],
      Leer_Mas: noticia["Leer_Mas"],
      Creditos: noticia["Creditos"],
      Imagen: noticia["Imagen"],
      ID_Imagen: noticia["ID_Imagen"],
      Activo: noticia["Activo"]
    };
    arraynoticias.push(nuevanoticia);

  };
}
