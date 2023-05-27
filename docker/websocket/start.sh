#!/bin/bash

/usr/bin/supervisord -c /etc/supervisor/conf.d/websockets.conf
crond -l 2 -f
