# kaltura-power-bi

## Requirements
Deze applicaties zijn nodig voor het installeren van het datawarehouse voor Kaltura:
* **XAMPP [download](https://www.apachefriends.org/download.html)**
* **Git [download](https://git-scm.com/downloads)**
* **Composer [download](https://getcomposer.org/download/)**

Nadat deze applicaties zijn geïnstalleerd, open **CMD**(opdrachtprompt).
Vervolgens ga naar C:\xampp\htdocs en typ:

``git clone https://github.com/hanzestudent/kaltura-power-bi.git``

Nu worden alle bestanden van GitHub gepulled. Vervolgens ga naar "**C:\xampp\apache\conf**"
en open het bestand "**httpd.conf**", vervolgens zoek op het woord **DocumentRoot** en verander
het pad wat daar staat naar "**C:\xampp\htdocs\kaltura-power-bi\public**"

Vervolgens open Xampp Control panel en klik op start bij zowel **Apache** 
en **MySQL** 

Klik vervolgens op **Admin** bij MySQL en maak een database aan genaamd **datawarehouse**.
Daarnaast maak ook een user aan die toegang heeft tot deze nieuw aangemaakte database.

Vervolgens ga naar "**C:\xampp\htdocs\kaltura-power-bi\public**" en verander het bestand 
**.env** 
Deze variabelen moet je aanpassen:
* DB_DATABASE=datawarehouse
* DB_USERNAME=(user die je hebt aangemaakt)
* DB_PASSWORD=(Paswoord voor username)

Als laatst ga naar **XAMPP control panel** en klik op **config** bij MySQL -> **my.ini**
Voeg hier onder de tag [mysqld] deze waarden toe:
``innodb_large_prefix = On
  innodb_file_per_table = On
  innodb_file_format = Barracuda``