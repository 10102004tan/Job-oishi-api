FROM php:8.2-cli

# Cài đặt các gói phụ thuộc
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    gnupg

# Cài đặt Node.js và npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g npm

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Đặt thư mục làm việc và sao chép mã nguồn
WORKDIR /usr/src/job-oishi-api
COPY . /usr/src/job-oishi-api

# Cài đặt các phụ thuộc PHP và Node.js
RUN composer install
RUN composer update
RUN npm install

# Chạy các lệnh cần thiết
RUN php artisan migrate

# Mở cổng
EXPOSE 8000

# Khởi động máy chủ Laravel
CMD php artisan serve --host=127.0.0.1 --port=8000
