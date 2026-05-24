
// FUNCION PARA COPIARELENLACE DELPREDIO PARA COMPARTIR
function copiarenlace(varIDEnlace) {
	//var varIDEenlace = '<?php echo json_encode($varidenlace); ?>';
	// Obtener el campo de texto
	const enlace = document.getElementById(varIDEnlace).getAttribute('href');

	// Copiar el texto dentro del campo
	navigator.clipboard.writeText(enlace)
		.then(() => alert("Enlace Copiado, para pegarlo use CTRL+V : " + enlace))
}

//----------------------------------------------------------

// SUBIR LOS PREDIOS ACTIVOS EN LA APP
function visualizarPredios() {

	var varCategoria = CATEGORIA;
	var varTipo = TIPOCATEGORIA;
	var varnumpredios = arraypredios.length;


	createTitulopagina(varCategoria, varTipo, varnumpredios);

	if (arraypredios.length == 0) {
		document.getElementById('textoMensajepredio').textContent = 'Lo sentimos, no hay predios disponibles para esta categoría';
		return;
	}

	// DESPLIEGA LOS PREDIOS DISPONIBLES
	arraypredios.forEach((predio, i) => {
		var varCodigo_Predio = predio.Codigo_Predio;
		var varValor_Predio = predio.Valor;
		var varEstado = predio.Estado;
		var varEnlace_Site = predio.Enlace_Site;

		createTarjetapredio(varCodigo_Predio);
		createInformacionpredio(predio, varCodigo_Predio, varTipo);
		createImagenespredio(varCodigo_Predio, varValor_Predio, varEstado);
		createCaracteristicaspredio(varCodigo_Predio, varEnlace_Site);
	})
}

//-----------------------------------------------------------------------
// TITULO DE LA PAGINA
function createTitulopagina(varcategoria, vartipo, varnumpredios) {

	var encabezadopagina = document.querySelector("main");
	const tituloPagina = document.createElement("div");
	tituloPagina.id = "areatitulos";

	let urlAnterior = document.referrer;
	let urlLongitud = urlAnterior.length;
	let urlComparar = urlAnterior.substring(urlLongitud - 21)

	if (urlComparar == "desplegarconsulta.php") {
		tituloPagina.innerHTML = `  
		<h1 id="textotitulos" > ${varcategoria} (${varnumpredios})</h1>
	 `
	} else
		if (vartipo == "U") {
			tituloPagina.innerHTML = `  
    <h1 id="textotitulos" > ${varcategoria} (${varnumpredios})</h1>
    <a href="../html/ofertas-urbanas.html">
				<img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
		</a>
  `
		}
		else {
			tituloPagina.innerHTML = `  
    <h1 id="textotitulos" > ${varcategoria} (${varnumpredios})</h1>
    <a href="../php/ofertas-rurales.php">
				<img id="imgregresar" src="../imagenes_site/flecha-izquierda.png">
		</a>
  `
		}
	encabezadopagina.appendChild(tituloPagina);
}

//----------------------------------------------------------------------------
//  SUBIR LAS TARJETAS DE LOS PREDIOS
function createTarjetapredio(varCodigo_Predio,) {
	const nuevaSeccion = document.createElement("section");
	nuevaSeccion.id = varCodigo_Predio;
	nuevaSeccion.classList.add('tarjetaPredio' + varCodigo_Predio);
	nuevaSeccion.classList.add('tarjetaPredio');

	nuevaSeccion.innerHTML = `  
    <div id="tarjetaDatos${varCodigo_Predio}" class="tarjetaDatos"> </div>
  `
	var main = document.querySelector("main");
	main.appendChild(nuevaSeccion)
}

//--------------------------------------------------------------------
//  SUBIR LA INFORMACION DEL PREDIO
function createInformacionpredio(varPredio, varCodigo_Predio, varTipo) {

	// TARJETA DEL PREDIO
	var idtarjetadatos = "#tarjetaDatos" + varCodigo_Predio;
	var tarjetaDatos = document.querySelector(idtarjetadatos);

	const nuevaTarjetainformacion = document.createElement("div");
	var idnnuevaTarjetainformacion = "tarjetaInformacion" + varCodigo_Predio;
	nuevaTarjetainformacion.id = idnnuevaTarjetainformacion;
	nuevaTarjetainformacion.classList.add("tarjetaInformacion");

	// TITULO DEL PREDIO
	const nuevoTituloinformacion = document.createElement("div");
	var idnnnuevoTituloinformacion = "tituloInformacion" + varCodigo_Predio;
	nuevoTituloinformacion.id = idnnnuevoTituloinformacion;
	nuevoTituloinformacion.classList.add("tituloInformacion");
	nuevoTituloinformacion.innerHTML = `
    <h1 class="tituloPredio"> Código Predio: ${varCodigo_Predio}</h1> 
  `
	nuevaTarjetainformacion.appendChild(nuevoTituloinformacion);

	// INFORMACION GENERAL DEL PREDIO
	const nuevoDetalleinformacion = document.createElement("div");
	var idnuevoDetalleinformacion = "detalleInformacion" + varCodigo_Predio;
	nuevoDetalleinformacion.id = idnuevoDetalleinformacion;
	nuevoDetalleinformacion.classList.add("detalleInformacion");

	if (varTipo === "U")
		vartextoubicacion = "Barrio";
	else
		vartextoubicacion = "Vereda";

	nuevoDetalleinformacion.innerHTML = `
    <p class="textoInformacion"> <span class="etiquetasInfo"> Ciudad: </span>  ${varPredio.Municipio}.</p>
    <p class="textoInformacion"> <span class="etiquetasInfo"> ${vartextoubicacion}: </span>   ${varPredio.Ubicacion}.</p>
    <p class="textoInformacion"> <span class="etiquetasInfo"> Area Total: </span>  ${varPredio.Area_Total} ${varPredio.Medida_AT}. </p>
	`
	nuevaTarjetainformacion.appendChild(nuevoDetalleinformacion);

	// DATO AREA CONSTRUIDA SI EXISTE
	if (varPredio.Area_Construida.length !== 0) {
		const nuevoParrafoinformacion = document.createElement("p");
		nuevoParrafoinformacion.innerHTML = `
		<p class="textoInformacion"> <span class="etiquetasInfo"> Area Construída: </span>  ${varPredio.Area_Construida} ${varPredio.Medida_AC}. </p>
		`
		nuevoDetalleinformacion.appendChild(nuevoParrafoinformacion);
	};

	// DATO VALOR DEL PREDIO
	const nuevoParrafoinformacion = document.createElement("p");
	nuevoParrafoinformacion.innerHTML = `
	<p class="textoInformacion"> <span class="etiquetasInfo"> Valor: </span> ${varPredio.Valor}.</p>
	`
	nuevoDetalleinformacion.appendChild(nuevoParrafoinformacion);
	nuevaTarjetainformacion.appendChild(nuevoDetalleinformacion);
	tarjetaDatos.appendChild(nuevaTarjetainformacion);

	// SE CREA LA DESCRIPCION SI EXISTE
	if (varPredio.Descripcion.length != 0) {

		const nuevaAreadescripcion = document.createElement("div");
		nuevaAreadescripcion.classList.add("areaDescripcion");
		var idnuevaAreadescripcion = "areaDescripcion" + varCodigo_Predio;
		nuevaAreadescripcion.id = idnuevaAreadescripcion;

		const nuevoDetalledescripcion = document.createElement("details");
		var idnuevoTitulodescripcion = "tituloDescripcion" + varCodigo_Predio;
		nuevoDetalledescripcion.id = idnuevoTitulodescripcion;
		nuevoDetalledescripcion.innerHTML = `
			<summary class="tituloDescripcion">Descripción</sumamary>
		`
		const nuevoParrafodescripcion = document.createElement("p");
		nuevoParrafodescripcion.innerHTML = `
			<p class="textoDescripcion"> ${varPredio.Descripcion}</p>
		`
		nuevoDetalledescripcion.appendChild(nuevoParrafodescripcion);

		nuevaAreadescripcion.appendChild(nuevoDetalledescripcion);
		nuevaTarjetainformacion.appendChild(nuevaAreadescripcion);
	};
}

//---------------------------------------------------------------
//  SUBIR LAS FOTOS DE LOS PREDIOS
function createImagenespredio(varCodigo_Predio, valorPredio, varEstado) {

	var idtarjetadatos = "#tarjetaDatos" + varCodigo_Predio;
	var tarjetaDatos = document.querySelector(idtarjetadatos);

	const nuevaTarjetafotos = document.createElement("div");
	var idnuevaTarjetafotos = "tarjetaFotos" + varCodigo_Predio;
	nuevaTarjetafotos.id = idnuevaTarjetafotos;
	nuevaTarjetafotos.classList.add("tarjetaFotos");

	const nuevoDetallefotos = document.createElement("div");
	var idnuevoDetallefotos = "detalleFotos" + varCodigo_Predio;
	nuevoDetallefotos.id = idnuevoDetallefotos;
	nuevoDetallefotos.classList.add("detalleFotos");

	arrayimagenes.forEach(imagen => {
		if (imagen.Codigo_Predio === varCodigo_Predio) {
			var varlongitudnombre = imagen.Archivo_Imagen.length;
			var varnombreimagen = imagen.Archivo_Imagen.substring(0, varlongitudnombre - 4) + ".webp";

			var nuevaimagen = document.createElement("img");
			nuevaimagen.classList.add("foto");
			nuevaimagen.onclick = "this.classList.toggle('agrandar')";
			nuevaimagen.src = "../imagenes_predios_webp/" + varnombreimagen;

			fetch("../imagenes_predios_webp/" + varnombreimagen, { method: 'HEAD' })
				.then(response => {
					if (response.ok)
						nuevoDetallefotos.appendChild(nuevaimagen);
				});
		}
		nuevaTarjetafotos.appendChild(nuevoDetallefotos);
	})


	// TARJETA DEL PRECIO
	const nuevoTituloprecio = document.createElement("div");
	var idnuevoTituloprecio = "tituloPrecio" + varCodigo_Predio;
	nuevoTituloprecio.id = idnuevoTituloprecio;
	nuevoTituloprecio.classList.add("tituloPrecio");

	if (varEstado === "Vendido")
		nuevoTituloprecio.innerHTML = `<h1 class="textoVendido" > VENDIDO</h1>`
	else
		nuevoTituloprecio.innerHTML = `<h1 class=textoPrecio> ${valorPredio} <span class="textoCop"> COP</span></h1>`
	nuevaTarjetafotos.appendChild(nuevoTituloprecio);


	// INSERTA TARJETA PARA EL VIDEO
	var varnombrevideo = varCodigo_Predio + ".mp4";
	var vararchivovideo = "../videos_predios/" + varnombrevideo;

	fetch(vararchivovideo, { method: 'HEAD' })
		.then(response => {
			if (response.ok) {
				const nuevaTarjetaVideo = document.createElement("div");
				var idnuevaTarjetavideo = "tarjetaVideopredio" + varCodigo_Predio;
				nuevaTarjetaVideo.id = idnuevaTarjetavideo;
				nuevaTarjetaVideo.classList.add("tarjetaVideopredio");

				var idnuevaAreavideo = "areaVideo" + varCodigo_Predio;

				nuevaTarjetaVideo.innerHTML = `  
					<details>
						<summary class="tituloVideopredio">Video Predio</summary>
						<div id="${idnuevaAreavideo}">
						</div>
					</details>
				`
				nuevaTarjetafotos.appendChild(nuevaTarjetaVideo);

				const nuevoVideopredio = document.createElement("video");
				var idnuevoVideopredio = "videoPredio" + varCodigo_Predio;
				nuevoVideopredio.id = idnuevoVideopredio;
				nuevoVideopredio.classList.add("videoPredio");
				nuevoVideopredio.controls = true;
				nuevoVideopredio.innerHTML = `
					<source src="${vararchivovideo}" type="video/mp4">
				`
				var varareavideo = document.querySelector("#areaVideo" + varCodigo_Predio);

				varareavideo.appendChild(nuevoVideopredio);

				varvideopredio = document.querySelector("#videoPredio" + varCodigo_Predio);
				varvideopredio.addEventListener('loadedmetadata', function () {
					if (this.videoWidth > this.videoHeight) {
						varareavideo.classList.add("areaVideohorizontal");
					} else if (this.videoWidth < this.videoHeight) {
						varareavideo.classList.add("areaVideovertical");
					}
				});
			}
		});
	tarjetaDatos.appendChild(nuevaTarjetafotos);
}

//----------------------------------------------------------------------
//  SUBIR LAS CARACTERISTICAS DEL PREDIO
function createCaracteristicaspredio(varCodigo_Predio, varEnlace_Site) {
	var idtarjetadatos = "#tarjetaDatos" + varCodigo_Predio;
	var tarjetaDatos = document.querySelector(idtarjetadatos);

	const nuevaTarjetacaracteristicas = document.createElement("div");
	var idnuevasTarjetacaracteristicas = "tarjetaCaracteristicas" + varCodigo_Predio;
	nuevaTarjetacaracteristicas.id = idnuevasTarjetacaracteristicas;
	nuevaTarjetacaracteristicas.classList.add("tarjetaCaracteristicas");

	const nuevoDetalletarjeta = document.createElement("details");
	var idnuevotitulotarjeta = "tituloCaracteristicas" + varCodigo_Predio;
	nuevoDetalletarjeta.id = idnuevotitulotarjeta;
	nuevoDetalletarjeta.innerHTML = `<summary class="tituloCarcateristicas">Carcaterísticas</sumamary>`
	nuevaTarjetacaracteristicas.appendChild(nuevoDetalletarjeta);

	const nuevaListacaracteriticas = document.createElement("div");
	var idnuevaListacaracteristicas = "listaCarcateriticas" + varCodigo_Predio;
	nuevaListacaracteriticas.id = idnuevaListacaracteristicas;
	nuevaListacaracteriticas.classList.add("listaCaracteristicas");

	arraycaracteristicas.forEach(caracteristica => {
		if (caracteristica.Codigo_Predio === varCodigo_Predio) {
			var nuevaCaracteristica = document.createElement("li");
				nuevaCaracteristica.innerHTML = `
					<li class=textoCaracteristica> <span class="etiquetasInfo">${caracteristica.Caracteristica}:  </span>${caracteristica.Valor}.</li>
				`
			nuevaListacaracteriticas.appendChild(nuevaCaracteristica);
		}
		nuevoDetalletarjeta.appendChild(nuevaListacaracteriticas);
		tarjetaDatos.appendChild(nuevaTarjetacaracteristicas);
	})

	// INSERTA EL ICONO DE COPIAR ENLACE
	const nuevaareaCopiarenlacepredio= document.createElement("div");
	nuevaareaCopiarenlacepredio.classList.add("areaCopiarenlacepredio");
	var idnuevoBotonenlace = "botonEnlace" + varCodigo_Predio;
	nuevaareaCopiarenlacepredio.innerHTML = `  
    	<a onclick="copiarenlace('${idnuevoBotonenlace}')">
				<img class="botonEnlace" id="${idnuevoBotonenlace}" href="${varEnlace_Site}" src="../imagenes_site/copiar enlace.png">
	 	</a>
		<p class="textoCopiarenlace">
			Copiar Enlace
		</p>
  `
	tarjetaDatos.appendChild(nuevaareaCopiarenlacepredio);
}



