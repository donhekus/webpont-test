FROM php:8.1-fpm

# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get -y update && apt-get install -y \
    build-essential \
    libonig-dev \
    libicu-dev \
    libpng-dev libwebp-dev libjpeg62-turbo-dev libfreetype6-dev \
    jpegoptim optipng pngquant gifsicle \
    libzip-dev \
    libpq-dev \
    locales \
    zip \
    mc \
    unzip \
    git \
    curl \
    pgloader

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl intl
RUN docker-php-ext-configure gd --with-freetype --with-webp --with-jpeg
RUN docker-php-ext-install gd
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require laravel/installer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Install npm and yarn
RUN curl -sL https://deb.nodesource.com/setup_17.x | bash - \
    && apt-get install -y nodejs \
    && npm i -g yarn

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
