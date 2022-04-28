FROM php:8.1.5-fpm

WORKDIR /var/www/

COPY . .

CMD ["php", "-S", "0.0.0.0:3000"]

EXPOSE 3000