# ODR-EncoderManager

OpenDigitalRadio Encoder Manager est un outil qui permet de lancer et configurer facilement ODR Encoder gràace à son interface WebGUI.

![Screenshot](https://raw.github.com/YoannQueret/ODR-EncoderManager/master/ODR-Encoder_Manager.png)

# Installation sur Raspberry Pi 3

## Installation d'ODR-mmbtools

Avec Raspbian Jessie : http://downloads.raspberrypi.org/raspbian/images/raspbian-2017-07-05/

    $ sudo adduser odr
    $ sudo visudo -f /etc/sudoers

Ajoutez la ligne suivante après “root All=(ALL:ALL) ALL”

    odr ALL=(ALL:ALL) ALL
  
Puis rebootez :

    $ sudo reboot
    $ su odr
    $ cd
    $ sudo nano /etc/apt/sources.list

Supprimez le “#” au début de la ligne commençant par “deb-src”

    $ sudo apt-get update
    
Importez le script d'installation 

    $ wget https://raw.githubusercontent.com/LyonelB/RaspDAB/master/raspdab.sh
    $ chmod +x raspdab.sh
    $ ./raspdab.sh 
    $ cd

## Installation de ODR-EncoderManager

    $ sudo apt-get install python-cherrypy3 python-jinja2 python-serial supervisor
    $ sudo usermod -a -G dialout odr
    $ sudo usermod -a -G audio odr
    $ cd /home/odr/
    $ git clone https://github.com/YoannQueret/ODR-EncoderManager.git
    $ mv /home/odr/ODR-EncoderManager/config.json.sample /home/odr/ODR-EncoderManager/config.json
    $ sudo ln -s /home/odr/ODR-EncoderManager/supervisor-encoder.conf /etc/supervisor/conf.d/odr-encoder.conf
    $ sudo ln -s /home/odr/ODR-EncoderManager/supervisor-gui.conf /etc/supervisor/conf.d/odr-gui.conf
    $ sudo nano /etc/supervisor/supervisord.conf
    
Et ajoutez les lignes suivantes :

    [inet_http_server]
    port = 9100
    username = user ; Auth username
    password = pass ; Auth password
    
Reprenez l'installation :

    $ sudo /etc/init.d/supervisor restart
    $ sudo supervisorctl reread
    $ sudo supervisorctl update ODR-encoderManager
    
Rendez-vous à l'adresse ip de votre Raspberry Pi : http://<ip_address>:8080 pour accéder à l'interface d'ODR encoder 

Et connectez-vous, avec les identifiants/mdp indiqué dans le fichier /home/odr/ODR-EncoderManager/config.json

## Supervisor

Rendez-vous à l'adresse ip de votre Raspberry Pi : http://<ip_address>:9100 pour accéder à l'interface de Supervisor
Et connectez-vous avec les identifiants/mdp : 

    user
    pass

# INSTALLATION

  * (root) Install requirement : apt install python-cherrypy3 python-jinja2 python-serial supervisor
  * (root) Add odr user to dialout group : usermod -a -G dialout odr
  * (root) Add odr user to audio group : usermod -a -G audio odr
  * (user) Got to odr user home : cd /home/odr/
  * (user) Clone git repository : git clone https://github.com/YoannQueret/ODR-EncoderManager.git
  * (user) Rename sample config : mv /home/odr/ODR-EncoderManager/config.json.sample /home/odr/ODR-EncoderManager/config.json
  * (root) Make the symlink: ln -s /home/odr/ODR-EncoderManager/supervisor-encoder.conf /etc/supervisor/conf.d/odr-encoder.conf
  * (root) Make the symlink: ln -s /home/odr/ODR-EncoderManager/supervisor-gui.conf /etc/supervisor/conf.d/odr-gui.conf
  * (root) Edit /etc/supervisor/supervisord.conf and add this section :
```
[inet_http_server]
port = 9001
username = user ; Auth username
password = pass ; Auth password
```
  * (root) Restart supervisor : /etc/init.d/supervisor restart
  * (root) Start WEB server : supervisorctl reread; supervisorctl update ODR-encoderManager
  * Go to : http://<ip_address>:8080
  


# CONFIGURATION
  * You can edit global configuration, in particular path in this files :
    * config.json
    * supervisor-gui.conf
  * If you want to change supervisor XMLRPC login/password, you need to edit /etc/supervisor/supervisord.conf and config.json files
    

# ADVANCED
  * To use the reboot api (/api/reboot), you need to allow odr user to run shutdown command by adding the line bellow at the end of /etc/sudoers file :
```
odr     ALL=(ALL) NOPASSWD: /sbin/shutdown
```

