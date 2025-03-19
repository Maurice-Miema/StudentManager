# Utiliser une image PHP officielle avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite pour les routes PHP
RUN a2enmod rewrite

# Copier tout le projet dans le dossier Apache
COPY . /var/www/html/

# Modifier le DocumentRoot pour pointer vers le dossier 'public'
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Modifier les permissions si nécessaire pour Apache
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
