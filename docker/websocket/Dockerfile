FROM enginecrm_php-fpm

# Install supervisord
RUN apk add --update supervisor

ADD websockets.conf /etc/supervisor/conf.d/websockets.conf

EXPOSE 6001

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/websockets.conf"]
