import os
import json

input_variable = {
    "username": os.environ['INPUT_USERNAME'],
    "email": os.environ['INPUT_EMAIL'],
    "code": os.environ['INPUT_CODE'],
    "quote": {
        "name1": os.environ['INPUT_CODE'],
        "quote1": os.environ['INPUT_CODE'],
        "name2": os.environ['INPUT_CODE'],
        "quote2": os.environ['INPUT_CODE'],
        "name3": os.environ['INPUT_CODE'],
        "quote3": os.environ['INPUT_CODE'],
        "name4": os.environ['INPUT_CODE'],
        "quote4": os.environ['INPUT_CODE']
    }
}

print("Input Variable:", json.dumps(input_variable))
