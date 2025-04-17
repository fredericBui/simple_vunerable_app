FROM debian
RUN apt-get update && apt-get install -y apache2
RUN apt-get install -y php libapache2-mod-php php-mysql php-mbstring php-xml php-curl php-gd
RUN /etc/init.d/apache2 restart
RUN rm /var/www/html/index.html
COPY . /var/www/html/
WORKDIR /var/www/html
CMD ["apache2ctl", "-D", "FOREGROUND"]
EXPOSE 80