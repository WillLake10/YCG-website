import json
import os


def fix_bracket(in_str):
    return in_str.replace("!bracketO!", "(").replace("!bracketC!", ")")


quote_id = os.environ['INPUT_QUOTE_ID']
# quote_id = "4367698854-1"

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
add.append([fix_bracket(newQuote["quote"]["name1"]), fix_bracket(newQuote["quote"]["quote1"])])
if fix_bracket(newQuote["quote"]["name2"]) != '' or fix_bracket(newQuote["quote"]["quote2"]) != '':
    add.append([fix_bracket(newQuote["quote"]["name2"]), fix_bracket(newQuote["quote"]["quote2"])])
if fix_bracket(newQuote["quote"]["name3"]) != '' or fix_bracket(newQuote["quote"]["quote3"]) != '':
    add.append([fix_bracket(newQuote["quote"]["name3"]), fix_bracket(newQuote["quote"]["quote3"])])
if fix_bracket(newQuote["quote"]["name4"]) != '' or fix_bracket(newQuote["quote"]["quote4"]) != '':
    add.append([fix_bracket(newQuote["quote"]["name4"]), fix_bracket(newQuote["quote"]["quote4"])])

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
