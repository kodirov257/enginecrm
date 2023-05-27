FROM enginecrm_php-fpm

# Install supervisord
RUN apk add --update supervisor

# RUN usermod -u 1000 www-data

COPY cron_commands /etc/cron.d/cron-commands

RUN chmod 0644 /etc/cron.d/cron-commands

RUN crontab /etc/cron.d/cron-commands

RUN touch /var/log/cron.log

ADD websockets.conf /etc/supervisor/conf.d/websockets.conf

EXPOSE 6001

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/websockets.conf"]

CMD /usr/bin/supervisord -c /etc/supervisor/conf.d/websockets.conf & crond -l 2 -f

#ADD start.sh /
#RUN chmod +x /start.sh
#CMD ["/start.sh"]
