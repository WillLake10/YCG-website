import icalendar
import recurring_ical_events
import urllib.request
import json
from datetime import date
from dateutil.relativedelta import relativedelta


class Event:
    def __init__(self, s_date, e_date, title, location, description, social, practice):
        self.s_date = s_date
        self.e_date = e_date
        self.title = title
        self.location = location
        self.description = description
        self.social = social
        self.practice = practice


class DateVal:
    def __init__(self, day, month, year, time, weekday, full):
        self.day = day
        self.month = month
        self.year = year
        self.time = time
        self.weekday = weekday
        self.full = full


class EventEncoder(json.JSONEncoder):
    def default(self, o):
        return o.__dict__


def check_str_contains(sub_str, description):
    if sub_str in description:
        return True
    else:
        return False


start_date = date.today()
end_date = date.today() + relativedelta(months=+3)
url = "https://calendar.google.com/calendar/ical/ycg.org.uk_qneu0krg83dhmovjrnko6qmp6c%40group.calendar.google.com/public/basic.ics"

ical_string = urllib.request.urlopen(url).read()
calendar = icalendar.Calendar.from_ical(ical_string)
events = recurring_ical_events.of(calendar).between(start_date, end_date)

date_string = "%H:%M, %A %d %B"

all_events = []

for event in events:
    if not check_str_contains("!null", event["DESCRIPTION"]):
        all_events.append(
            Event(
                s_date=event["DTSTART"].dt,
                e_date=event["DTEND"].dt,
                title=str(event["SUMMARY"]),
                location=str(event["LOCATION"]).replace(", York, Lawrence St, York YO10 3WP, UK", "").replace(", York YO1 7HH, UK", "").replace(", 8 Marygate Ln, York YO30 7BJ, UK", "").replace(", York YO1 7EF, UK", "").replace(" Clifton Vicarage,", "").replace(", York YO30 6BH, UK", "").replace("DN1 1RD, UK", "").replace(", York YO1 9QL, UK", ""),
                description=str(event["DESCRIPTION"].replace("!Social", "").replace("!Practice", "")),
                social=check_str_contains("!Social", event["DESCRIPTION"]),
                practice=check_str_contains("!Practice", event["DESCRIPTION"])
            )
        )

all_events.sort(key=lambda x: x.s_date)

for event in all_events:
    event.s_date = DateVal(
        day=event.s_date.strftime("%d"),
        month=event.s_date.strftime("%B"),
        year=event.s_date.strftime("%Y"),
        time=event.s_date.strftime("%H:%M"),
        weekday=event.s_date.strftime("%A"),
        full=event.s_date.strftime(date_string)
    )
    event.e_date = DateVal(
        day=event.e_date.strftime("%d"),
        month=event.e_date.strftime("%B"),
        year=event.e_date.strftime("%Y"),
        time=event.e_date.strftime("%H:%M"),
        weekday=event.e_date.strftime("%A"),
        full=event.e_date.strftime(date_string)
    )
    # event.e_date = event.e_date.strftime(date_string)
    print(event.__dict__)

jsonStr = json.dumps(all_events, indent=4, cls=EventEncoder)
f = open("calender/calender.json", "w")
f.write(jsonStr)
f.close()
