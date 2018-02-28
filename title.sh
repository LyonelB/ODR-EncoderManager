
#!/bin/bash

DLS=$(curl -s http://www.urban-radio.com/titrage/title_winmedia.txt )
echo $DLS > "/pad/metadata.dls"
