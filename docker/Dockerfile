FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    curl \
    supervisor \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy supervisor config
COPY docker/supervisor.conf /etc/supervisor/supervisor.conf

# Set working directory
WORKDIR /var/www/html

EXPOSE 80
# Start Supervisor as main process (it manages apache2 and other workers)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisor.conf"]