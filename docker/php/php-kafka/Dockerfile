FROM php:7.4-fpm

RUN apt-get update

# Install kafka extension
RUN apt-get install -y librdkafka-dev git
RUN pecl install rdkafka

#####################################
# Clean up
#####################################
RUN apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog \
    rm -rf /tmp/pear

COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html
