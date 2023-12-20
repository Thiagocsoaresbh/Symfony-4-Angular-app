# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /app
WORKDIR /var/www/html

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Install any needed packages
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    libicu-dev \
    && docker-php-ext-install \
    intl \
    pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run Composer install
RUN composer install --no-scripts --no-autoloader

# Copy project files into the container
COPY . /var/www/html

# Run Composer dump-autoload for optimized autoloader
RUN composer dump-autoload --no-scripts --optimize

# Make port 80 available to the world outside this container
EXPOSE 80

# Define the environment variable
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update the default apache site with the config we created
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Start Apache
CMD ["apache2-foreground"]
