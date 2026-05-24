
window.onload = function () {
  cargarPredios();
  console.log("Página completamente cargada (imágenes incluidas)");
}


// LLAMA LA FUNCIONES QUE VARGAN LOS DATOS DEL PREDIO
function cargarPredios() {
  getpredios();
  getimagenes();
  getcaracteristicas();

  visualizarPredios();
}

//--------------------------------------------------------
// IMPORTAR PREDIOS ---

function getpredios() {
  arraypredios = [];
  for (const predio of listaPredios) {
    const nuevopredio = {
      Codigo_Predio: predio["Codigo_Predio"],
      Estado: predio["Estado"],
      Tipo: predio["Tipo"],
      Categoria: predio["Categoria"],
      Municipio: predio["Municipio"],
      Ubicacion: predio["Ubicacion"],
      Valor: predio["Valor"],
      Area_Total: predio["Area_Total"],
      Medida_AT: predio["Medida_AT"],
      Area_Construida: predio["Area_Construida"],
      Medida_AC: predio["Medida_AC"],
      Descripcion: predio["Descripcion"],
      Enlace_Site: predio["Enlace_Site"],
      Valor_Numero: predio["Valor_Numero"]
    };
    arraypredios.push(nuevopredio);
  };
}

//--------------------------------------------------------
// IMPORTAR IMAGENES ----

function getimagenes() {
  arrayimagenes = [];
  for (const imagen of listaImagenes) {
    if (!imagen[2] || imagen[4] == undefined) {
      const nuevaimagen = {
        Codigo_Predio: imagen["Codigo_Predio"],
        Archivo_Imagen: imagen["Nombre_Imagen"],
        Archivo_Imagen: imagen["Archivo_Imagen"],
        Codigo_Categoria: imagen["Codigo_Categoria"]
      };
      arrayimagenes.push(nuevaimagen);
    };
  };
}

//--------------------------------------------------------
// IMPORTAR CARACTERISTICAS ----

function getcaracteristicas() {
  arraycaracteristicas = [];
  for (const caracteristica of listaCaracteristicas) {
    const nuevacaracteristica = {
      Codigo_Predio: caracteristica["Codigo_Predio"],
      Caracteristica: caracteristica["Caracteristica"],
      Valor: caracteristica["Valor"],
      Orden: caracteristica["Orden"],
      Codigo_Categoria: caracteristica["Codigo_Categoria"]
    };
    arraycaracteristicas.push(nuevacaracteristica);
  };
}