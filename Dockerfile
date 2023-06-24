FROM php:8.2-apache
RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf 
COPY htdocs/ /var/www/html/
RUN sed -i "s/@@@GITHASH@@@/xxx/" /var/www/html/include/menu-stop.inc.php
USER 1000:1000
EXPOSE 8080

