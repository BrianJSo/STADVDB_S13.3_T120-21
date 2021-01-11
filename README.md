# STADVDB_S13.3_T120-21 (PHP version)
* Cai, Mark Jayson
* Sanchez, Martin Christopher
* Santos, Carlo Luis
* Sarabia, Ryan Miguel
* So, Brian Jezreel

## Deployed Web Application
This web application is deployed to Infinity Free and can be accessed using this link: http://imdbnav.42web.io/ 

## Local Web Application
### Setting up XAMPP and configurations
1. To run this application locally, **XAMPP** is needed to be installed.
2. The **STADVDB_S13.3_T120-21** folder must be placed under **xampp/htdocs/**
3. Replace **xampp\phpMyAdmin\libraries\config.default.php** with the **config.default.php** found in the project folder.
4. Replace **xampp\php\php.ini** with the **php.ini** found in the project folder.
### Setting up the database
1. Go to https://localhost/phpmyadmin/index.php 
2. Open the **Import** tab and choose the **imdb_ijs.sql** file located in the project folder
### Optimizing the database
1. After creating the **imdb_ijs** database, select it and open the **SQL tab**
2. Copy and paste the contents from **optimization.sql** and click **Go**
### Accessing the application
1. After setting up your XAMPP configurations, start running **Apache** and **MySql** from the XAMPP Control Panel
2. The application will then be available by accessing http://localhost/STADVDB_S13.3_T120-21/ from your browser.
