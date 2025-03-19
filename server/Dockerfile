# Utiliser une image PHP officielle avec Apache
FROM php:8.0-apache

# Activer le module mod_rewrite pour les routes PHP
RUN a2enmod rewrite

# Copier le code source de ton projet dans le conteneur
# Copier le dossier 'public' dans le répertoire Apache par défaut
COPY ./public /var/www/html/

# Copier le fichier .htaccess dans le répertoire Apache par défaut
COPY ./.htaccess /var/www/html/

# Copier le fichier de configuration si nécessaire
COPY ./config.php /var/www/html/

# Copier le dossier 'App' dans le conteneur si nécessaire (par exemple pour les contrôleurs, modèles)
COPY ./App /var/www/html/App

# Copier le dossier 'routes' dans le conteneur
COPY ./routes /var/www/html/routes

# Modifier les permissions si nécessaire pour Apache
RUN chown -R www-data:www-data /var/www/html/

# Exposer le port 80 (par défaut pour HTTP)
EXPOSE 80

# Démarrer Apache en premier plan
CMD ["apache2-foreground"]
