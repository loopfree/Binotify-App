FROM php:8.0-apache
# COPY . /var/www/html
WORKDIR /var/www/html

RUN apt-get update

# Install PDO and PGSQL Drivers
RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

RUN echo "upload_max_filesize = 0" >> /usr/local/etc/php/conf.d/custom.ini
RUN echo "post_max_size = 0" >> /usr/local/etc/php/conf.d/custom.ini