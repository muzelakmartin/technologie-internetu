FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql
# (volumes z compose toto aj tak prebijú, ale nech je image konzistentný)
COPY ./app/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html
