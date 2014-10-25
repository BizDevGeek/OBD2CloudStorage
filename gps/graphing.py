#!/usr/bin/env python

#Jozef Nagy
#Basic MatPlotLib example that exports hard coded figures to a text file on Linux server. 

# Import modules for CGI handling 
import cgi, cgitb
import sys
import matplotlib.pyplot as plt
import os
from ConfigParser import *
import datetime
import mysql.connector
from array import *

# Create instance of FieldStorage 
form = cgi.FieldStorage()

# Get data from fields
#uid = form.getvalue('uid')

#file = open("test.txt", "w")
#file.write(api)
#file.close()

print "Content-type: text/html\n"
print 
print "<html><body>"
print "Graph generated for: <br>"
print "<img src='/custom/graphs/test.png'>"
#print "graph generated: "
#sys.exit()

c = ConfigParser()
c.read("../config.txt")
print "asdf"
db_name = c.get("DB", "cfg_db")
db_user = c.get("DB", "cfg_db_user")
db_passwd = c.get("DB", "cfg_db_passwd")

#==============================================
print "fff" #<<<<<<--------- this won't print
#=============================================

#Create the directory to store the output files (graphs)
if not os.path.exists("graphs"):
	try:
		print "test"
		os.makedirs("graphs")
	except ValueError:
		print "failed to make subdir"

#Grab GPS data from database
#debug:
#print db_name
#print db_user
#print db_passwd
cnx = mysql.connector.connect(user=db_user, database=db_name, password=db_passwd)
cursor = cnx.cursor()

#query = ("SELECT count(*) as total FROM gps "
#         "WHERE EventDate BETWEEN %s AND %s and uid=%s")
query = ("select lat from gps where eventdate between %s and %s and uid=%s limit 10")
#query = ("select count(*) as total from gps where uid=%s")

dtStart = datetime.date(2013, 1, 1)
dtEnd = datetime.date(2014, 12, 31)
UID = 17
#uid = form.getvalue('uid')

cursor.execute(query, (dtStart, dtEnd, UID))

#Add data into object to feed into plotter
results = array('f') #f=floating point values
for (lat) in cursor:
#	print(lat[0])
#	print(str(lat[0])+"<br>")
#	print("{}".format(lat))
	results.append(lat[0]) 

cursor.close()
cnx.close()

#Plot the GPS results to a image file
#plt.plot([1,2,3,4])
plt.plot(results)
plt.ylabel('some numbers')
#plt.savefig('graphs/test.png')

#print "Graph generated for: " + str(UID) + "<br>"
#print "<img src='/custom/graphs/test.png'>"
print "<br>asdf"
print "</body></html>"
