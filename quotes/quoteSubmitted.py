import os
import json
import string
import random

import smtplib
from email.mime.text import MIMEText


def id_generator(size=6, chars=string.ascii_letters + string.digits):
    return ''.join(random.choice(chars) for _ in range(size))


quote_id = id_generator(15)
print(quote_id)

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

data_file = open(("quotes/" + quote_id + ".json"), "x")
data_file.write(json.dumps(input_variable))

page_file = open(("quotes/" + quote_id + ".php"), "x")
page_file.write(open("quotes/quoteTop.txt", "r").read())
page_file.write(quote_id)
page_file.write(open("quotes/quoteBottem.txt", "r").read())

msg = MIMEText("A new quote has been submitted for the YCG quote page")

senderEmail = "ycg.new.quote@gmail.com"
receverEmail = "william.j.lake2000@gmail.com"
senderPw = open("quotes/email.txt", "r").read()

msg['Subject'] = "Email subject"
msg['From'] = senderEmail
msg['To'] = receverEmail
msg.set_content("This is eamil message")

# send email
with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    smtp.login(senderEmail, senderPw)
    smtp.send_message(msg)
