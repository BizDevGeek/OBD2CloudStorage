#Jozef Nagy
#Basic MatPlotLib example that exports hard coded figures to a text file on Linux server. 

import matplotlib.pyplot as plt

plt.plot([1,2,3,4])
plt.ylabel('some numbers')
plt.savefig('graphs/test.png')
