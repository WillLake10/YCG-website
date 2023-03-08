import json
import os

# quote_id = os.environ['INPUT_QUOTE_ID']
quote_id = "4367698854-1"

print(quote_id)

# file = open("pending/" + quote_id + ".json")
file = open("quotes/pending/" + quote_id + ".json")
newQuote = json.load(file)
file.close()

# file = open("quotes.json")
file = open("quotes/quotes.json")
oldQuotes = json.load(file)
file.close()

add = []
add.append([newQuote["quote"]["name1"], newQuote["quote"]["quote1"]])
if newQuote["quote"]["name2"] != '' or newQuote["quote"]["quote2"] != '':
    add.append([newQuote["quote"]["name2"], newQuote["quote"]["quote2"]])
if newQuote["quote"]["name3"] != '' or newQuote["quote"]["quote3"] != '':
    add.append([newQuote["quote"]["name3"], newQuote["quote"]["quote3"]])
if newQuote["quote"]["name4"] != '' or newQuote["quote"]["quote4"] != '':
    add.append([newQuote["quote"]["name4"], newQuote["quote"]["quote4"]])

# print(add)

newOut = []

newOut.append(add)

for i in oldQuotes:
    newOut.append(i)


f = open("quotes/quotes.json", "w")
f.write(json.dumps(newOut))
f.close()

os.remove("quotes/pending/" + quote_id + ".php")
os.remove("quotes/pending/" + quote_id + ".json")
