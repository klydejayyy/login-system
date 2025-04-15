FROM php:apache
# To enable the use of mysqli function
RUN docker-php-ext-install mysqli 
EXPOSE 80
