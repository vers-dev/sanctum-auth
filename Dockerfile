FROM webdevops/php-nginx:8.2-alpine

ENV WEB_DOCUMENT_ROOT=/var/www/public


ENV PHP_DISMOD=calendar,exiif,ffi,intl,gettext,ldap,imap,mysqli,pdo_mysql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,apcu,vips,amqp

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www
COPY ./ /var/www
RUN composer install --no-interaction --optimize-autoloader --no-dev

# add custom php-fpm pool settings, these get written at entrypoint startup
ENV FPM_PM_MAX_CHILDREN=20 \
    FPM_PM_START_SERVERS=2 \
    FPM_PM_MIN_SPARE_SERVERS=1 \
    FPM_PM_MAX_SPARE_SERVERS=3

RUN chown -R application:application .

RUN php artisan optimize
RUN php artisan key:generate
