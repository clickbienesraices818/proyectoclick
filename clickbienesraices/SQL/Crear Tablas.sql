USE clickbie_clickbienesraices;

CREATE TABLE PR_Predios (
    Codigo_Predio VARCHAR(7) NOT NULL UNIQUE,
    Estado VARCHAR(15) NOT NULL,
    Tipo VARCHAR(7) NOT NULL,
    Categoria VARCHAR(25) NOT NULL,
    Municipio VARCHAR(25) NOT NULL,
    Ubicacion VARCHAR(70) NOT NULL,
    Descripcion TEXT,
    Valor VARCHAR(20) NOT NULL,
    Area_Total VARCHAR(11) NOT NULL,
    Medida_AT VARCHAR(10) NOT NULL,
    Area_Construida VARCHAR(11),
    Medida_AC VARCHAR(10)
); 


CREATE TABLE PR_Caracteristicas (
   Codigo_Predio VARCHAR(7) NOT NULL,
   Caracteristica VARCHAR(50) NOT NULL,
   Valor VARCHAR(25) NOT NULL,
   Orden INT(2)
); 

CREATE TABLE PR_Imagenes (
   Codigo_Predio VARCHAR(7) NOT NULL,
   Nombre_Imagen VARCHAR(50) NOT NULL,
   ID_Imagen VARCHAR(40),
   Archivo_Imagen VARCHAR(40) NOT NULL
);

CREATE TABLE PR_Categorias (
   Codigo_Categoria VARCHAR(3) NOT NULL,
   Categoria VARCHAR(50) NOT NULL
); 