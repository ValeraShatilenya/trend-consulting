FROM phpdockerio/php:8.1-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        default-mysql-client \
        git \
        supervisor \
        openssh-client \
        php8.1-gd \
        php8.1-mcrypt \
        php8.1-mysql \
        php8.1-intl \
        php8.1-gmp \
        php8.1-bcmath \
        php8.1-redis; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
