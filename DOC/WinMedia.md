Afin d'ajouter le tritrage dans ODR-EncoderManager

## Installation d'Apache

    $ sudo aptitude install apache2
    $ sudo chown -R pi:www-data /var/www/html/
    $ sudo chmod -R 770 /var/www/html/
  
## Installation de PHP

    $ sudo aptitude install php php-mbstring php-xml php-mysql
  
## Titrage WinMedia

    $ cd /var/www/html
    $ wget https://raw.githubusercontent.com/LyonelB/ODR-EncoderManager/master/WinMedia.php
    $ sudo chmod -R 740 WinMedia.php
    $ sudo chown -R odr:www-data /var/www/html
    $ sudo usermod -a -G www-data odr

## Restart Apache2

    $ sudo /etc/init.d/apache2 restart
  
  
  pi@raspberrypi:/var/www/html $ sudo chown -R www-data:www-data /var/www/html/
  
  sudo apt-get php7.0-curl php7.0-gd php7.0-imap php7.0-json php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-xmlrpc
