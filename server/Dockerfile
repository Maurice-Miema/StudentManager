# Utiliser une image de base (par exemple PHP avec Apache, si c'est ton cas)
FROM php:8.0-apache

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers sauf ceux dans .dockerignore
COPY . /var/www/html/

# Copier le fichier .env dans l'image Docker
COPY .env /var/www/html/.env

# Modifier le DocumentRoot pour qu'il pointe vers le dossier 'public' (si c'est ce que tu veux)
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Activer les modules nécessaires
RUN a2enmod rewrite

# Redémarrer Apache
RUN service apache2 restart

# Exposer le port 80
EXPOSE 80
