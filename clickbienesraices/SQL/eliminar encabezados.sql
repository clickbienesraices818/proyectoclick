USE clickbie_clickbienesraices;

DELETE FROM `pr_imagenes` WHERE Codigo_Predio = "Codigo";
DELETE FROM `pr_imagenes` WHERE Codigo_Predio = "";
DELETE FROM `pr_categorias` WHERE Codigo_Categoria = "Cod";
DELETE FROM `pr_categorias` WHERE Codigo_Categoria = "";
DELETE FROM `pr_caracteristicas` WHERE Codigo_Predio = "Codigo";
DELETE FROM `pr_caracteristicas` WHERE Codigo_Predio = "";
DELETE FROM `ne_noticias` WHERE ID_Noticia = "Indice";
DELETE FROM `ne_noticias` WHERE ID_Noticia = "";
DELETE FROM `pr_predios` WHERE Codigo_Predio = "Codigo";
DELETE FROM `pr_predios` WHERE Codigo_Predio = "desde";
DELETE FROM `pr_predios` WHERE Codigo_Predio = "";