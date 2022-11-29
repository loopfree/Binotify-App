FROM php:8.1-apache

WORKDIR /var/www/html

RUN apt-get update

# Install PDO and PGSQL Drivers
RUN apt-get install -y libpq-dev \
  && apt-get install -y libxml2-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql soap

RUN echo "upload_max_filesize = 0" >> /usr/local/etc/php/conf.d/custom.ini
RUN echo "post_max_size = 0" >> /usr/local/etc/php/conf.d/custom.ini
RUN echo "extension = soap" >> /usr/local/etc/php/conf.d/custom.ini