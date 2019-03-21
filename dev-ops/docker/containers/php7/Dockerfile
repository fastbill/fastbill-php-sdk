FROM php:7.1-apache

RUN apt-get update -qq && apt-get install -y -qq apt-utils && mkdir -p /usr/share/man/man1 \
    && apt-get update -qq && apt-get install -y -qq openjdk-8-jre-headless \
    && apt-get update -qq && apt-get install -y -qq  openjdk-8-jdk && dpkg --configure -a

RUN apt-get update -qq && apt-get install -y -qq \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        software-properties-common  \
        libcurl3 curl \
        git \
        zip \
        unzip \
        git \
        nano \
        sudo \
        vim

RUN docker-php-ext-install iconv mcrypt mbstring opcache \
    && docker-php-ext-install curl \
    && docker-php-ext-install intl

RUN pecl install apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ADD server-apache2-vhosts.conf /etc/apache2/sites-enabled/000-default.conf
ADD server-apache2-run-as.conf /etc/apache2/conf-available
RUN ln -s /etc/apache2/conf-available/server-apache2-run-as.conf /etc/apache2/conf-enabled

ADD php-config.ini /usr/local/etc/php/conf.d/php-config.ini
ADD timezone-berlin.ini /usr/local/etc/php/conf.d/timezone.ini
ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY createuser.sh /tmp/createuser.sh
RUN chmod +rwx /tmp/createuser.sh
RUN /tmp/createuser.sh

RUN echo "alias ll='ls -ahl'" >> /etc/bash.bashrc

WORKDIR /var/www/fastbill-sdk

COPY id_rsa /home/app-shell/.ssh
COPY id_rsa.pub /home/app-shell/.ssh

COPY run-container.sh /run-container.sh
RUN chmod +x /run-container.sh

CMD /run-container.sh
