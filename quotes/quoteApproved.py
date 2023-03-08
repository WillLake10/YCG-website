import os

quote_id = os.environ['INPUT_QUOTE_ID']

print(quote_id)

os.remove(quote_id+".php")
os.remove(quote_id+".json")
