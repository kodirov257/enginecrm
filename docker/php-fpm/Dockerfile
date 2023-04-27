FROM joseluisq/php-fpm:8.1

RUN apk add gnupg
RUN apk add --update linux-headers
ENV ACCEPT_EULA=Y

# Install ioncube
ADD http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz /tmp/
RUN tar -xzvf /tmp/ioncube_loaders_lin_x86-64.tar.gz -C /tmp/ \
    && mkdir -p /usr/local/php/ext/ioncube \
    && cp -a /tmp/ioncube/ioncube_loader_lin_${PHP_VERSION%.*}.so /usr/local/php/ext/ioncube/ioncube_loader.so

COPY ["conf.d/05-apcu-recommended.ini", "conf.d/05-opcache-recommended.ini", "conf.d/05-security-recommended.ini", "/usr/local/etc/php/conf.d/"]

#Download the desired package(s)
RUN curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.10.2.1-1_amd64.apk \
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.10.1.1-1_amd64.apk

#(Optional) Verify signature, if 'gpg' is missing install it using 'apk add gnupg':
RUN curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.10.2.1-1_amd64.sig \
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.10.1.1-1_amd64.sig

RUN curl https://packages.microsoft.com/keys/microsoft.asc  | gpg --import - \
    && gpg --verify msodbcsql17_17.10.2.1-1_amd64.sig msodbcsql17_17.10.2.1-1_amd64.apk \
    && gpg --verify mssql-tools_17.10.1.1-1_amd64.sig mssql-tools_17.10.1.1-1_amd64.apk

#Install the package(s)
RUN apk add --allow-untrusted msodbcsql17_17.10.2.1-1_amd64.apk \
    && apk add --allow-untrusted mssql-tools_17.10.1.1-1_amd64.apk \
    && rm -f msodbcsql17_17.10.2.1-1_amd64.apk mssql-tools_17.10.1.1-1_amd64.apk

# Configure opcache
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN sed -i 's/;opcache.enable=1/opcache.enable=0/g' /usr/local/etc/php/php.ini
RUN echo 'max_execution_time=120' >> /usr/local/etc/php/conf.d/php.ini
RUN echo 'memory_limit=512M' >> /usr/local/etc/php/conf.d/php.ini

# Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Xdebug
RUN apk update \
    && apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./xdebug.ini "${PHP_INI_DIR}/conf.d"
COPY ./error_reporting.ini "${PHP_INI_DIR}/conf.d"

EXPOSE 9000
CMD ["php-fpm", "-F"]
