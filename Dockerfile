FROM diegomarangoni/hhvm

MAINTAINER thanhpv.102@gmail.com

RUN apt-key adv --keyserver hkp://pgp.mit.edu:80 --recv-keys 573BFD6B3D8FBC641079A6ABABF5BD827BD9BF62 \
    && echo "deb http://nginx.org/packages/debian/ jessie nginx" >> /etc/apt/sources.list \
    && apt-get update \
    && apt-get -y install --no-install-recommends --no-install-suggests \
            mysql-client \
            ca-certificates \
            nginx \
            gettext-base \
            hhvm-dev \
        --no-install-recommends \

    && apt-get purge -y g++ wget automake build-essential git libtool \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && usermod -u 1000 www-data \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

EXPOSE 80 443 9000

COPY docker/php.ini /etc/hhvm/php.ini

ENV PHP_SRC_ROOT /var/www/html

WORKDIR /var/www/html

COPY . .
COPY docker/nginx.conf /etc/nginx/nginx.conf

COPY docker/config/db.php config/db.php

COPY docker/taxmng_entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/taxmng_entrypoint.sh \
    && ln -s /usr/local/bin/taxmng_entrypoint.sh / \
    && mkdir runtime \
    && mkdir web/assets \
    && chown -R www-data:www-data .

VOLUME ["/var/www/html"]

ENTRYPOINT ["taxmng_entrypoint.sh"]
CMD ["hhvm", "--mode", "server", "--config", "/etc/hhvm/php.ini"]
