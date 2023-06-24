FROM php:8.2-apache
ARG GITHUB_SHA
ENV GITHUB_SHA=$GITHUB_SHA
RUN sed -i "s/Listen 80/Listen 8080/g" /etc/apache2/ports.conf 
COPY htdocs/ /var/www/html/
RUN sed -i "s/@@@GITHASH@@@/$GITHUB_SHA/g" /var/www/html/include/menu-stop.inc.php
USER 1000:1000
EXPOSE 8080

