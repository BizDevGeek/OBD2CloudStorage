OBD2CloudStorage
================

Cloud storage database and API for storing OBD2 data

Components:
1) Database tables
2) API 

Database
MySQL database tables

API
PHP based JSON + REST. The PHP code

Setup
config.php - Contains the database name and login info. Fill this in with your database login info. It's assumed the database is running on localhost. 
Store the API's PHP files on an apache webserver such as in /var/www/obdapi. 
