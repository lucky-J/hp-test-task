FROM luckyj/php-7.4-kafka:latest

RUN apt-get update \
    && apt-get install -y \
    zip \
    unzip \
    libssl-dev \
    libpq-dev

# Install php extensions
RUN docker-php-ext-install \
    pdo \
    pgsql \
    pdo_pgsql \
    opcache

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD ./src /var/www/html

WORKDIR /var/www/html

RUN composer install -n -o