import os

quote_id = os.environ['INPUT_QUOTE_ID']

os.remove("quotes/pending/" + quote_id + ".php")
os.remove("quotes/pending/" + quote_id + ".json")
