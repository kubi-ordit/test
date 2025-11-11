FROM serversideup/php:8.4-cli

USER root

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN mkdir /etc/nginx
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID
RUN echo '#!/bin/bash\nphp /var/www/html/bin/console "$@"' > /usr/bin/sf && chmod +x /usr/bin/sf

USER www-data

CMD ["./startup.sh"]
