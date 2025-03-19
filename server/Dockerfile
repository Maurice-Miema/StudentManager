# Utiliser l'image PHP officielle comme image de base
FROM php:8.1-apache

# Installer les extensions PHP nécessaires (par exemple MySQL, PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Copier tous les fichiers du dossier server vers /var/www/html dans le conteneur
COPY . /var/www/html/

# Configurer le répertoire public comme racine du document Apache
WORKDIR /var/www/html/public

# Configurer Apache pour rediriger vers le dossier public
COPY .htaccess /var/www/html/.htaccess

# Exposer le port 80
EXPOSE 80

# Démarrer Apache en mode foreground
CMD ["apache2-foreground"]
