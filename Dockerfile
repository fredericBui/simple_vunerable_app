FROM debian
RUN apt-get update && apt-get install -y apache2
RUN apt-get install -y php libapache2-mod-php php-mysql php-mbstring php-xml php-curl php-gd
RUN /etc/init.d/apache2 restart
RUN rm /var/www/html/index.html
COPY . /var/www/html/
WORKDIR /var/www/html

RUN apt install -y openssh-server
RUN service ssh start
RUN echo "root:root" | chpasswd
RUN echo "\nPermitRootLogin yes\nPasswordAuthentication yes" >> /etc/ssh/sshd_config
RUN service ssh restart

CMD ["apache2ctl", "-D", "FOREGROUND"]
EXPOSE 80