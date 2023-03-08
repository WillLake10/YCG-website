import json
import os

quote_id = os.environ['INPUT_QUOTE_ID']

print(quote_id)

file = open("quotes/pending/" + quote_id + ".json")
newQuote = json.load(file)


file = open("quotes/pending/" + quote_id + ".json")
oldQuotes = json.load(file)

os.remove("quotes/pending/" + quote_id + ".php")
os.remove("quotes/pending/" + quote_id + ".json")
