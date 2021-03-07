FROM luckyj/php-7.4-cli-kafka:latest

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user with correct gid and uid
ARG PUID
ARG PGID
RUN groupadd -g ${PGID} printherro && \
    useradd -u ${PUID} -g printherro -s /bin/bash -m printherro

ADD ./src /var/www/html

WORKDIR /var/www/html

USER printherro

RUN composer install -n -o

CMD ["php", "cli/app.php", "consumer:listen"]