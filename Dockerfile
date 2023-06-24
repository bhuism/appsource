FROM php:8.2-apache
RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf 
COPY htdocs/ /var/www/html/
EXPOSE 8080
