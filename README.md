# ODR-EncoderManager

OpenDigitalRadio Encoder Manager est un outil qui permet de lancer et configurer facilement ODR Encoder grâce à son interface WebGUI.

![Screenshot](https://raw.github.com/YoannQueret/ODR-EncoderManager/master/ODR-Encoder_Manager.png)

# Installation sur Raspberry Pi 3

## Installation d'ODR-mmbtools

Avec Raspbian Jessie : http://downloads.raspberrypi.org/raspbian/images/raspbian-2017-07-05/
Fonctionne également avec Raspbian Jessie Lite et Raspbian Stretch Lite

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

    $ wget https://raw.githubusercontent.com/LyonelB/ODR-EncoderManager/master/EncManInstall.sh
    $ chmod +x raspdab.sh
    $ ./raspdab.sh 
    $ cd

## Installation de ODR-EncoderManager

    $ sudo apt-get install python-cherrypy3 python-jinja2 python-serial supervisor
    $ sudo usermod -a -G dialout odr
    $ sudo usermod -a -G audio odr
    $ cd /home/odr
    $ git clone https://github.com/LyonelB/ODR-EncoderManager.git
    $ mv /home/odr/ODR-EncoderManager/config.json.sample /home/odr/ODR-EncoderManager/config.json
    $ sudo ln -s /home/odr/ODR-EncoderManager/supervisor-encoder.conf /etc/supervisor/conf.d/odr-encoder.conf
    $ sudo ln -s /home/odr/ODR-EncoderManager/supervisor-gui.conf /etc/supervisor/conf.d/odr-gui.conf
    $ sudo nano /etc/supervisor/supervisord.conf
    
Et ajoutez les lignes suivantes :

    [inet_http_server]
    port = 9200
    username = user ; Auth username
    password = pass ; Auth password
    
Reprenez l'installation :

    $ sudo /etc/init.d/supervisor restart
    $ sudo supervisorctl reread
    $ sudo supervisorctl update ODR-encoderManager
    $ sudo reboot
    
Rendez-vous à l'adresse ip de votre Raspberry Pi : http://<ip_address>:8080 pour accéder à l'interface d'ODR encoder 

Et connectez-vous, avec les identifiants/mdp indiqué dans le fichier /home/odr/ODR-EncoderManager/config.json

    joe
    secret

## Supervisor

Rendez-vous à l'adresse ip de votre Raspberry Pi : http://<ip_address>:9200 pour accéder à l'interface de Supervisor
Et connectez-vous avec les identifiants/mdp : 

    user
    pass
    
## Parametrage

    $ mkdir /pad/
    $ chmod 777 /pad/
    $ mkdir /pad/slide/
    $ chmod 777 /pad/slide/

Dans la partie "PAD Encoder" d'ODR-EncoderManager :

PAD fifo file: /pad/metadata.pad
DLS fifo file: /pad/metadata.dls
Slide directory : /pad/slide/

Pour ajouter votre image :

    $ cd /pad/slide
    $ wget http://url.de.votre.image.jpeg

## Monitoring

    $ sudo nano /etc/supervisor/supervisord.conf
    
Ajoutez les lignes suivantes 

    [eventlistener:supermail]
    command=python /usr/local/bin/supermail.py -a -m mail@domain.com -o "[ODR]"
    events=PROCESS_STATE
    
    $ sudo apt-get install sendmail
    $ cd /usr/local/bin
    $ sudo wget https://raw.githubusercontent.com/YoannQueret/ODR-tools/master/supervisor/supermail.py
    $ sudo /etc/init.d/supervisor restart
    $ sudo supervisorctl reread
    $ sudo supervisorctl update

# Hardware

Il y a différentes options : Raspberry Pi, Shuttle, Supermicro ...

### PC avec port PCI express

shuttle xh110g : http://www.shuttle.eu/fr/produits/slim/xh110g/apercu/

Supermicro Barebone 5019S-L : https://www.brack.ch/fr/supermicro-barebone-5019s-388376

### Cartes son PCI express

ESI MAYA44 eX : http://www.esi-audio.com/products/maya44ex/

Audioscience ASI5211 : http://www.audioscience.com/internet/products/sound_cards/asi5111_5211.htm

Lynx Studio E22 : https://www.lynxstudio.com/products/e22/

Digigram VX222e : https://www.digigram.com/sound-cards/vx222e-stereo-pcm-sound-card/

### Autres

Solutions choisies par Digris :

https://service.digris.ch/doc/service/encoder/onsite.html#hardware


PC en rack avec carte APU2x ou APU3x

Rack Matrix : https://www.rack-matrix.com/fr/

Varia-store : http://varia-store.com/Hardware/19-DualRack-Box/complete-system/APU3B2-19-Rack-Bundle-power-supply-board-case::29591.html

Carte son Mini PCI Express

http://www.dpie.com/mini-pcie/audio/

Titres en cours

https://github.com/mpbraendli/mmbtools-aux/blob/master/icy-info.py

Pochette 

https://github.com/mpbraendli/mmbtools-aux/blob/master/fipcover.py


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

### Notes et liens

https://www.rack-matrix.com/fr/galerie#20

https://store.rack-matrix.com/en/products/29-apu-2-2-or-4-gb-amd-gx-412tc-quad-core-1-ghz.html#/14-memory-4_gb

https://store.rack-matrix.com/en/front-panel/8-rack-matrix-enclosure-plate-for-apualix-3x-leds-placement-and-push-button.html

https://store.rack-matrix.com/en/rackmatrix-enclosure/2-rackmatrix-m1-enclosure.html#/2-brand-white/62-front_panel-without_front_panel


