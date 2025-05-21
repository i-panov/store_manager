FROM php:8.3-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP-расширений
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath opcache

# Установка phpredis
RUN pecl install redis && docker-php-ext-enable redis

# Копируем дефолтный php.ini и делаем его видимым
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Рабочая директория внутри контейнера
WORKDIR /var/www/html

# Копируем только composer.json и lock, чтобы слои кэшировались
COPY src/composer.json src/composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Копируем оставшиеся файлы
COPY src/ .

# Генерация автозагрузки
RUN composer dump-autoload

# Установка прав
RUN chown -R www-data:www-data /var/www/html