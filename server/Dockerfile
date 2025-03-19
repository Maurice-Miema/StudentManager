# Utiliser une image PHP avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite pour la gestion des routes
RUN a2enmod rewrite

# Copier tout le projet dans /var/www/html/
COPY . /var/www/html/

# Vérifier que le fichier .env existe bien (débogage)
RUN ls -la /var/www/html/

# Modifier le DocumentRoot pour qu'Apache utilise 'public/'
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Vérifier si le fichier .env est bien copié
RUN if [ ! -f /var/www/html/.env ]; then echo ".env est manquant !"; exit 1; fi

# Modifier les permissions pour Apache
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
