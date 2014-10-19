#Jozef Nagy
#Basic MatPlotLib example that exports hard coded figures to a text file on Linux server. 

import matplotlib.pyplot as plt
import os
from ConfigParser import *
import datetime
import mysql.connector

c = ConfigParser()
c.read("../config.txt")

db_name = c.get("DB", "cfg_db")
db_user = c.get("DB", "cfg_db_user")
db_passwd = c.get("DB", "cfg_db_passwd")

#Create the directory to store the output files (graphs)
if not os.path.exists("graphs"):
    os.makedirs("graphs")

#Grab GPS data from database
#debug:
#print db_name
#print db_user
#print db_passwd
cnx = mysql.connector.connect(user=db_user, database=db_name, password=db_passwd)
cursor = cnx.cursor()

query = ("SELECT count(*) as total FROM gps "
         "WHERE EventDate BETWEEN %s AND %s and uid=%s")

dtStart = datetime.date(2013, 1, 1)
dtEnd = datetime.date(2014, 12, 31)
UID = 17

cursor.execute(query, (dtStart,dtEnd,UID))

#Add data into object to feed into plotter
for (total) in cursor:
  print(total)

cursor.close()
cnx.close()

#Plot the GPS results to a image file
plt.plot([1,2,3,4])
plt.ylabel('some numbers')
plt.savefig('graphs/test.png')
