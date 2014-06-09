OBD2CloudStorage
================

Cloud storage database and API for storing OBD2 data

Main project page: http://www.blackboxpi.com

Purpose: To allow for the long term storage of OBD2 data. Once significant data is stored, patterns will emerge that will allow for helpful analysis at the individual level and in aggregate across many drivers. 

The most common use cases are to use an OBD2 reader to view live data, pull error codes, or to tune the engine. This architecture is meant to use an OBD2 reader as more of a black box to log information all the time the car is on and to store it centrally. By using a MySQL database, the system can handle massive amounts of car data that is beyond what many hobbyists use when writing live OBD2 data down to a log file, CSV file, or onto the screen.  

Use this API in conjunction with the Python based SDK: https://github.com/BizDevGeek/OBD2SDK_Python

The SDK can be integrated into any OBD2 client. When polling PID data from the computer, you can use the SDK to save that data to the cloud storage. Or you can write an SDK in any other language you need. Please contact the author to share it. I'll try to make the SDK available in other languages. 

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
