# 1. Imagen base oficial de PHP con servidor Apache
FROM php:8.2-apache

# 2. Instalar extensiones de PHP necesarias (ejemplo: mysqli y pdo_mysql para conectar a bases de datos)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Habilitar el módulo de Apache 'rewrite' (muy usado para URLs amigables en Laravel, WordPress, etc.)
RUN a2enmod rewrite

# 4. Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www/php

# 5. Copiar los archivos de tu proyecto local al directorio del servidor en el contenedor
COPY . /var/www/php/

# 6. Exponer el puerto 80 para que el servidor web sea accesible
EXPOSE 80