FROM phpdockerio/php71-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.1-mysql php-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ADD init.sh /init.sh

WORKDIR "/application"

CMD /init.sh && /usr/bin/php-fpm

# Open up fcgi port
EXPOSE 9000