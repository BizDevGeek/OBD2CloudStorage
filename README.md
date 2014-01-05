OBD2CloudStorage
================

Cloud storage database and API for storing OBD2 data

Purpose: To allow for the long term storage of OBD2 data. Once significant data is stored, patterns will emerge that will allow for helpful analysis at the individual level and in aggregate across many drivers. 

The most common use cases are to use an OBD2 reader to view live data, pull error codes, or to tune the engine. This architecture is meant to use an OBD2 reader as more of a black box to log information all the time the car is on and to store it centrally. By using a MySQL database, the system can handle massive amounts of car data that is beyond what many hobbyists use when writing live OBD2 data down to a log file, CSV file, or onto the screen.  


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
