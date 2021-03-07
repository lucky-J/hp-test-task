FROM luckyj/php-7.4-cli-kafka:latest

RUN apt-get update \
    && apt-get install -y \
    zip \
    unzip \
    libssl-dev \
    libpq-dev \
    supervisor

# Install php extensions
RUN docker-php-ext-install \
    pdo \
    pgsql \
    pdo_pgsql \
    opcache

ADD ./docker/supervisor/supervisor.conf /etc/supervisord.conf
ADD ./src /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install -n -o

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]

WORKDIR /etc/supervisor/conf.d/