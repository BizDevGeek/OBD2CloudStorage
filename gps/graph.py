#Jozef Nagy
#Basic MatPlotLib example that exports hard coded figures to a text file on Linux server. 

import matplotlib.pyplot as plt
import os

#Create the directory to store the output files (graphs)
if not os.path.exists("graphs"):
    os.makedirs("graphs")

plt.plot([1,2,3,4])
plt.ylabel('some numbers')
plt.savefig('graphs/test.png')
