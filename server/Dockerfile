# Utiliser une image PHP avec Apache
FROM php:8.0-apache

# Activer le module rewrite d'Apache pour le PHP
RUN a2enmod rewrite

# Copier tous les fichiers du dossier `server` dans le dossier approprié sur le serveur Apache
COPY ./server /var/www/html/

# Définir les permissions du dossier pour Apache
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80 pour l'API
EXPOSE 80

# Démarrer Apache en mode foreground
CMD ["apache2-foreground"]
