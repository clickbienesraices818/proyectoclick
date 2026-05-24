/* <script> */

// FUNCION PARA COPIARELENLACE DE LA NOTICIA PARA COMPARTIR
function copiarenlacenoticia(varIDNoticia) {
	//var varIDEenlace = '<?php echo json_encode($varidenlace); ?>';
	// Obtener el campo de texto
	const enlace = document.getElementById(varIDNoticia).getAttribute('href');

	// Copiar el texto dentro del campo
	navigator.clipboard.writeText(enlace)
		.then(() => alert("Enlace Copiado, para pegarlo use CTRL+V : " + enlace))
}

//----------------------------------------------------------
// SUBIR LAS NOTICIAS ACTIVAS EN LA APP

function visualizarNoticias() {

	arraynoticias.forEach((noticia, i) => {
		createTarjetanoticia(noticia, i);
		createContenidonoticia(noticia, i);
	})
}

//------------------------------------------------------------------
//  SUBIR LAS TARJETAS PARA LAS NOTICIAS
function createTarjetanoticia(varNoticia, index) {
	const nuevaSeccion = document.createElement("section");
	var varID_Noticia = varNoticia.ID_Noticia;
	nuevaSeccion.id = "seccionNoticia" + varID_Noticia;
	nuevaSeccion.classList.add('seccionNoticia');
	nuevaSeccion.innerHTML = `  
    <div id="tarjetaNoticia${varID_Noticia}" class="tarjetaNoticia"> </div>
  `
	var main = document.querySelector("main");
	main.appendChild(nuevaSeccion)
}

//-----------------------------------------------------------------
//  SUBIR LA INFORMACION LA NOTICIA
function createContenidonoticia(varNoticia, index) {

	var varNombrelongitud = varNoticia.Imagen.length;
	var varArchivoimagen = varNoticia.Imagen.substring(19, varNombrelongitud - 4);
	var varID_Noticia = varNoticia.ID_Noticia;
	var idtarjetaNoticia = "#tarjetaNoticia" + varID_Noticia;
	var tarjetaNoticia = document.querySelector(idtarjetaNoticia);

	const nuevaTarjetaimagen = document.createElement("div");
	var idnuevaTarjetaimagen = "tarjetaImagen" + varID_Noticia;
	nuevaTarjetaimagen.id = idnuevaTarjetaimagen;
	nuevaTarjetaimagen.classList.add("tarjetaImagen");

	const nuevaImagennoticia = document.createElement("img");
	var idnuevaImagennoticia = "imagenNoticia" + varID_Noticia;
	nuevaImagennoticia.id = idnuevaImagennoticia;
	nuevaImagennoticia.classList.add("imagenNoticia");

	nuevaImagennoticia.src = "../imagenes_noticias/" + varArchivoimagen + ".webp";
	nuevaTarjetaimagen.appendChild(nuevaImagennoticia);
	tarjetaNoticia.appendChild(nuevaTarjetaimagen);

	const nuevaTarjetacuerpo = document.createElement("div");
	var idnuevTarjetacuerpo = "tarjetaCuerpo" + varID_Noticia;
	nuevaTarjetacuerpo.id = idnuevTarjetacuerpo;
	nuevaTarjetacuerpo.classList.add("tarjetaCuerpo");

	const nuevaTarjetatitulo = document.createElement("h3");
	var idnuevaTarjetatitulo = "tarjetaTitulo" + varID_Noticia;
	nuevaTarjetatitulo.id = idnuevaTarjetatitulo;
	nuevaTarjetatitulo.classList.add("tarjetaTitulo");
	nuevaTarjetatitulo.innerText = varNoticia.Titulo;

	nuevaTarjetacuerpo.appendChild(nuevaTarjetatitulo);

	const nuevaTarjetacontenido = document.createElement("p");
	var idnuevaTarjetacontenido = "tarjetaContenido" + varID_Noticia;
	nuevaTarjetacontenido.id = idnuevaTarjetacontenido;
	nuevaTarjetacontenido.classList.add("tarjetaContenido");
	nuevaTarjetacontenido.innerHTML = `
    <p> ${varNoticia.Contenido}</p> 
  `
	nuevaTarjetacuerpo.appendChild(nuevaTarjetacontenido);

	const nuevaTarjetaLeermas = document.createElement("a");
	var idnuevaTarjetaLeermas = "tarjetaLeermas" + varID_Noticia;
	nuevaTarjetaLeermas.id = idnuevaTarjetaLeermas;
	nuevaTarjetaLeermas.classList.add("tarjetaLeermas");
	nuevaTarjetaLeermas.innerHTML = `
    <a target="_blank" href=${varNoticia.Leer_Mas}>Leer más... </a>
 `
	nuevaTarjetacuerpo.appendChild(nuevaTarjetaLeermas);

	const nuevaTarjetaCreditos = document.createElement("h5");
	var idnuevaTarjetaCreditos = "tarjetaCreditos" + varID_Noticia;
	nuevaTarjetaCreditos.id = idnuevaTarjetaCreditos;
	nuevaTarjetaCreditos.classList.add("tarjetaCreditos");
	nuevaTarjetaCreditos.innerHTML = `
    <h5> ${varNoticia.Creditos}</h5> 
 `
	nuevaTarjetacuerpo.appendChild(nuevaTarjetaCreditos);

	const nuevaAreacopiarenlacenoticia = document.createElement("div");
	var idnuevaAreacopiarenlacenoticia = "areaCopiarenlacenoticia" + varID_Noticia;
	nuevaAreacopiarenlacenoticia.id = idnuevaAreacopiarenlacenoticia;
	nuevaAreacopiarenlacenoticia.classList.add("areaCopiarenlacenoticia");
	var idnuevoBotonenlacenoticia = "botonEnlacenoticia" + varID_Noticia;
	nuevaAreacopiarenlacenoticia.innerHTML = `
      <a onclick="copiarenlacenoticia('${idnuevoBotonenlacenoticia}')">
         <img id="${idnuevoBotonenlacenoticia}" class="botonEnlacenoticia" href="https://clickbienesraices.com.co/php/desplegarnoticias.php?idnoticia=${varID_Noticia}" src="../imagenes_site/copiar enlace.png">
      </a>
		<p class="textoCopiarenlace">
			Copiar Enlace
		</p>
 `
	nuevaTarjetacuerpo.appendChild(nuevaAreacopiarenlacenoticia);
	tarjetaNoticia.appendChild(nuevaTarjetacuerpo);
}
/* </script> */

