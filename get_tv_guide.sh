#!/bin/bash
wget http://teleguide.info/download/new3/xmltv.xml.gz -O xmltv.xml.gz --progress=dot:mega
gunzip xmltv.xml.gz
php tv_vin.php
rm xmltv.xml*
