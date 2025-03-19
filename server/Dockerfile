# Utiliser PHP 8.0 avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite
RUN a2enmod rewrite

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier tous les fichiers dans le conteneur
COPY ./server /var/www/html/

# Changer la racine du serveur Apache vers le dossier public
RUN sed -i "s|/var/www/html|/var/www/html/public|g" /etc/apache2/sites-available/000-default.conf

# Redémarrer Apache
CMD ["apache2-foreground"]
