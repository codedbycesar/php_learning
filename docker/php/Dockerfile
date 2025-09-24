FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies in one layer
RUN apt-get update && apt-get install -y \
    # Build tools
    build-essential \
    autoconf \
    g++ \
    make \
    pkg-config \
    # Image processing libraries
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    # Other essential libraries
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libsodium-dev \
    libpcre2-dev \
    zlib1g-dev \
    libsasl2-dev \
    # Utilities
    locales \
    zip \
    unzip \
    git \
    curl \
    vim \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    && rm -rf /var/lib/apt/lists/*

# Configure GD extension
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# Install core PHP extensions (in groups for better error handling)
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql mysqli
RUN docker-php-ext-install -j$(nproc) mbstring exif pcntl bcmath
RUN docker-php-ext-install -j$(nproc) gd zip intl
RUN docker-php-ext-install -j$(nproc) soap opcache

# Install PECL extensions
RUN pecl install redis-5.3.7 \
    && pecl install xdebug-3.2.2 \
    && docker-php-ext-enable redis xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Create system user
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copy custom configurations
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Create log directories and set permissions
RUN mkdir -p /tmp && chmod 755 /tmp

# Set permissions
RUN chown -R www:www /var/www/html

# Don't change to www user - stay as root for PHP-FPM to work properly
# USER www

# Expose port and start php-fpm
EXPOSE 9000
CMD ["php-fpm"]