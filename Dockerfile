FROM php:8.2-cli
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /usr/src/job-oishi-api
COPY . /usr/src/job-oishi-api
RUN composer install
RUN docker-php-ext-install pdo_mysql
EXPOSE 3000
CMD php artisan serve --host=0.0.0.0 --port=3000
#-v "$(PWD):/usr/src/job-oishi-api"