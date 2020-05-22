FROM php:fpm-alpine
RUN addgroup --gid 1024 mygroup
RUN adduser --disabled-password --gecos "" --force-badname --ingroup 1024 vidavi
USER vidavi
COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk --update --no-cache add git

RUN docker-php-ext-install pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm 

EXPOSE 9000
