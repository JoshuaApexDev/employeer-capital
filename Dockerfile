FROM php:7.4

ENV PORT=8012
ARG NODE_VERSION=16

RUN apt-get update; apt-get install -y wget libzip-dev
RUN docker-php-ext-install zip pdo_mysql
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install exif

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer -O - -q | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . .
RUN composer update && composer install

RUN apt-get update && \
    curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

RUN php artisan key:generate

RUN DB_CONNECTION=mysql
RUN DB_HOST=mysql_container
RUN DB_PORT=3306
RUN DB_DATABASE=employer_capital_crm
RUN DB_USERNAME=root
RUN DB_PASSWORD=S3cr3t!

RUN npm install && npm run prod

# Create a symbolic link for storage
RUN php artisan storage:link

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Create the start.sh script
RUN echo "#!/bin/sh\n php artisan serve --host 0.0.0.0 --port \$PORT" > /app/start.sh
RUN chmod +x /app/start.sh

# Start the application and cron service
CMD ["/app/start.sh"]
