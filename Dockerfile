FROM php:8.2-apache
COPY . /var/www/html
WORKDIR /var/www/html
RUN docker-php-ext-install mysqli
# CMD [ "php", "./index.php" ]
