# Utiliser une image PHP officielle avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite pour les routes PHP
RUN a2enmod rewrite

# Copier le code source de ton projet dans le conteneur
COPY ./public /var/www/html/

# Modifier les permissions si nécessaire pour Apache
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80 (par défaut pour HTTP)
EXPOSE 80

# Démarrer Apache en premier plan
CMD ["apache2-foreground"]
