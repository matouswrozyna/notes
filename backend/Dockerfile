FROM arm64v8/php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
