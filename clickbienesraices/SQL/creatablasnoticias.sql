USE clickbie_clickbienesraices;

CREATE TABLE Noticias (
   ID_Noticia VARCHAR(7) NOT NULL,
   Fecha_Publicar DATE,
   Fecha_Desmontar DATE,
   Titulo TEXT,
   Contenido TEXT,
   Leer_Mas TEXT,
   Creditos VARCHAR(100),
   Imagen VARCHAR(30),
   ID_Imagen VARCHAR(70),
   Activo VARCHAR(5)
)