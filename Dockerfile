FROM php:8.3-fpm

ARG USER=app_user
ARG UID=1000
ARG GID=1000

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

# Создание пользователя
RUN groupadd --gid ${GID} ${USER} || true \
    && useradd -u ${UID} -g ${GID} -s /bin/bash -d /var/www/html -m ${USER} \
    && usermod -aG sudo ${USER} \
    && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

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

# Настройка прав
RUN chown -R ${USER}:${USER} /var/www/html && \
    chown -R ${USER}:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Пользователь по умолчанию
USER ${USER}
