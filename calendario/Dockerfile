# Imagen base con PHP y servidor embebido
FROM php:8.2-apache

# Instalar extensiones que pudiera necesitar tu app (ajusta si hace falta)
RUN docker-php-ext-install pdo pdo_mysql

# Configurar el DocumentRoot a la carpeta /var/www/html
WORKDIR /var/www/html

# Copiar el código de la aplicación
COPY . /var/www/html

# Dar permisos de escritura a la carpeta de datos (si los ficheros de tareas se guardan ahí)
RUN chown -R www-data:www-data /var/www/html/data \
    && chmod -R 775 /var/www/html/data

# Habilitar mod_rewrite (por si lo usas más adelante)
RUN a2enmod rewrite

# Exponer el puerto HTTP
EXPOSE 80

# Comando por defecto: iniciar Apache en foreground
CMD ["apache2-foreground"]
