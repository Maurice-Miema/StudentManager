# Utiliser une image PHP avec Apache
FROM php:8.0-apache

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers sauf ceux dans .dockerignore
COPY . /var/www/html/

# Copier le fichier .env dans l'image Docker
COPY .env /var/www/html/.env

# Modifier le DocumentRoot pour qu'il pointe vers le dossier 'public' (assure-toi que 'public' existe)
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Activer le module mod_rewrite
RUN a2enmod rewrite

# Modifier Apache pour autoriser .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Donner les bons droits aux fichiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

# Lancer Apache en mode foreground (important pour Docker)
CMD ["apache2-foreground"]
