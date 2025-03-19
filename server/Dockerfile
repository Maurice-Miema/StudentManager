# Utiliser une image PHP officielle avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite pour gérer les routes dynamiques
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tout le contenu du projet dans le conteneur
COPY . /var/www/html/

# Copier le fichier .htaccess à la racine du conteneur
COPY ./.htaccess /var/www/html/.htaccess

# Copier le fichier config.php dans le répertoire public ou à un autre endroit si nécessaire
COPY ./config.php /var/www/html/config.php

# Copier le fichier .env dans le répertoire public ou à un autre endroit si nécessaire
COPY ./.env /var/www/html/.env

# Modifier la configuration Apache pour définir 'public/' comme racine
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Donner les permissions correctes pour Apache
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

# Exposer le port 80 pour le serveur web
EXPOSE 80

# Démarrer Apache en mode premier plan
CMD ["apache2-foreground"]
