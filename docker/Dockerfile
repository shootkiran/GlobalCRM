FROM php:8.3-apache

# Set environment variable for timezone
ENV TZ=Asia/Kathmandu

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    curl \
    supervisor \
    sqlite3 \
    libsqlite3-dev \
    libicu-dev \
    g++ \
    tzdata \
    iputils-ping \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && docker-php-ext-install intl pdo pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy supervisor config
COPY docker/supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Set working directory
WORKDIR /var/www/html

EXPOSE 80

# Start Supervisor as main process (it manages apache2 and other workers)
CMD ["/usr/bin/supervisord"]