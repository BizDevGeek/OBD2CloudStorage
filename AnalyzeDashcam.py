import requests
import json

headers = {'Content-type': 'application/json',
           "Ocp-Apim-Subscription-Key":"a09add9425da4753bfb094f2ed94a70f"}

#data = {"url":"http://www.myhappybeagle.com/wp-content/uploads/2016/08/Beagles-And-Buddies.jpg"}
data ={"url":"https://ashleighbugg.files.wordpress.com/2015/02/img_8471-001.jpg"}
data_json = json.dumps(data)


#Analyze Image
url="https://eastus2.api.cognitive.microsoft.com/vision/v1.0/analyze"
response = requests.post(url, data=data_json, headers=headers)
print("\nAnalyze")
print(response)
print(response.json())


#Describe Image
url="https://eastus2.api.cognitive.microsoft.com/vision/v1.0/describe"
response = requests.post(url, data=data_json, headers=headers)
print("\nDescribe")
print(response)
print(response.json())


#Tag Image
url="https://eastus2.api.cognitive.microsoft.com/vision/v1.0/tag"
response = requests.post(url, data=data_json, headers=headers)
print("\nTags")
print(response)
print(response.json())
