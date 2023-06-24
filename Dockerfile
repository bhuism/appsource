FROM php:8.2-apache
RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf 
USER 1000:1000
EXPOSE 8080
COPY htdocs/ /var/www/html/
