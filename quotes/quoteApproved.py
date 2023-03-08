import os

quote_id = os.environ['INPUT_QUOTE_ID']

print(quote_id)

os.remove("quotes/" + quote_id + ".php")
os.remove("quotes/" + quote_id + ".json")
