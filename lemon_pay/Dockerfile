FROM 39.108.191.89:5000/lemon_api_interface:v1.0

COPY  ./nginx-conf/default  /etc/nginx/sites-enabled/default
COPY  ./php-fpm-conf/php-fpm.sh /etc/init.d/php-fpm
COPY  ./app_home/api /var/www/html/api
COPY  ./app_home/web /var/www/html/web

 RUN chmod 755 /etc/init.d/php-fpm \
    && update-rc.d php-fpm defaults

# 暴露 80 端口
EXPOSE 80