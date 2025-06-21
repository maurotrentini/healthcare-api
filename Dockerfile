# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install intl pdo pdo_mysql xml zip opcache mbstring

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set Apache to serve from /public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess overrides
RUN echo '<Directory /var/www/html/public/>\n\
    AllowOverride All\n\
</Directory>' > /etc/apache2/conf-available/override.conf && a2enconf override

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application files
COPY . /var/www/html

# Trust this directory for git
RUN git config --global --add safe.directory /var/www/html

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/var
RUN chmod -R 755 /var/www/html/var

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]