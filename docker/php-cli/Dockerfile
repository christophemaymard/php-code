FROM php:7.3-cli

RUN apt-get update \
    && apt-get install -y \
        git \
        subversion \
        openssh-client \
        mercurial \
        patch \
        make \
        zip \
        unzip \
        zlib1g-dev \
        libzip-dev \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) \
        zip \
        opcache \
    && docker-php-ext-enable \
        opcache

RUN php -r " \
        \$COMPOSER_SIGNATURE = trim(file_get_contents('https://composer.github.io/installer.sig')); \
        copy('https://getcomposer.org/installer', '/tmp/composer-installer.php'); \
        \$COMPOSER_HASH = hash_file('SHA384', '/tmp/composer-installer.php'); \
        if (\$COMPOSER_HASH === \$COMPOSER_SIGNATURE) { \
            echo 'Composer Installer verified.' . PHP_EOL; \
        } else { \
            echo 'Composer Installer corrupt.' . PHP_EOL; \
            unlink('/tmp/composer-installer.php'); \
            exit(1); \
        }" \
    && php /tmp/composer-installer.php --install-dir=/usr/local/bin --filename=composer \
    && rm -f /tmp/composer-installer.php
