import json

f = open('../data/galleryData.json')
data = json.load(f)

for i in data:
    print(i["folderName"])
    f = open(i["folderName"] + ".php", "w")
    f.write("<?php \n")
    f.write("$page = \""+i["folderName"]+"\"; \n")
    f.write("include('displayImages.php');")
    f.close()
