Afin d'ajouter le tritrage dans ODR-EncoderManager

## Installation d'Apache

    $ sudo aptitude install apache2
    $ sudo chown -R pi:www-data /var/www/html/
    $ sudo chmod -R 770 /var/www/html/
  
## Installation de PHP

    $ sudo aptitude install php php-mbstring php-xml
  
## Titrage WinMedia

    $ cd /var/www/html
    $ wget https://raw.githubusercontent.com/LyonelB/ODR-EncoderManager/master/WinMedia.php
    $ sudo chmod -R 740 WinMedia.php
    $ sudo chown -R www-data:www-data /var/www/html

  pi@raspberrypi:/var/www/html $ sudo chown -R www-data:www-data /var/www/html/
