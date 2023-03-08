import os
import json

input_variable = {
    "username": os.environ['INPUT_USERNAME'],
    "email": os.environ['INPUT_EMAIL'],
    "quote": {
        "name1": os.environ['INPUT_QUOTE_NAME1'],
        "quote1": os.environ['INPUT_QUOTE_QUOTE1'],
        "name2": os.environ['INPUT_QUOTE_NAME2'],
        "quote2": os.environ['INPUT_QUOTE_QUOTE2'],
        "name3": os.environ['INPUT_QUOTE_NAME3'],
        "quote3": os.environ['INPUT_QUOTE_QUOTE3'],
        "name4": os.environ['INPUT_QUOTE_NAME4'],
        "quote4": os.environ['INPUT_QUOTE_QUOTE4']
    }
}

print("Input Variable:", json.dumps(input_variable))
