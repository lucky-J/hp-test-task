FROM luckyj/php-7.4-cli-kafka:latest

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD ./src /var/www/html

WORKDIR /var/www/html

RUN composer install -n -o

CMD ["php", "cli/app.php", "consumer:listen"]