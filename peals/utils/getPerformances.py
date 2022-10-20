import datetime
import xml.dom.minidom

from Performance import Performance
from Ringer import Ringer
from request import send_request


def get_performance(perf_id):
    data = send_request("/view.php?id=" + perf_id)
    dom = xml.dom.minidom.parseString(data.decode("utf-8"))
    performance = dom.getElementsByTagName("performance")

    perf = performance[0]

    location = weight = ""
    city = dedication = county = ""
    changes = method = ""
    ringers = []
    footnotes = []
    date = perf.getElementsByTagName("date")[0].childNodes[0].data
    academic_year = get_academic_year(date)
    dt = datetime.datetime.strptime(date, '%Y-%m-%d')
    timeMs = int(dt.timestamp() / 100)
    date = dt.strftime('%A, %d %B %Y')
    place = perf.getElementsByTagName("place")
    for pla in place:
        pl = pla.getElementsByTagName("place-name")
        for p in pl:
            if p.getAttribute("type") == "place":
                city = get_child_node_data(p, "city", perf_id)
            if p.getAttribute("type") == "dedication":
                dedication = get_child_node_data(p, "dedication", perf_id)
            if p.getAttribute("type") == "county":
                county = get_child_node_data(p, "county", perf_id)
        location = dedication + ", " + city + ", " + county
        weight = pla.getElementsByTagName("ring")[0].getAttribute("tenor")

    time = get_node(perf, "duration", perf_id)
    title = perf.getElementsByTagName("title")
    for t in title:
        changes = get_node(t, "changes", perf_id)
        method = get_node(t, "method", perf_id)

    details = get_node(perf, "details", perf_id)
    ringers_nodes = perf.getElementsByTagName("ringers")
    for ringer in ringers_nodes:
        ring = ringer.getElementsByTagName("ringer")
        for r in ring:
            name = get_child_node_data(r, "ringer", perf_id)
            bell = r.getAttribute("bell")
            conductor = r.getAttribute("conductor")
            if name in ["-", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"]:
                name = "Unknown"

            if conductor:
                name = name + " (C)"

            ringers.append(Ringer(name, bell))

    fns = perf.getElementsByTagName("footnote")
    for f in fns:
        footnotes.append(get_child_node_data(f, "footnote", perf_id))

    type = 2
    if changes != '':
        if int(changes) > 1200:
            type = 1
        if int(changes) > 5000:
            type = 0

    return Performance(academic_year, type, date, location, weight, time, changes, method, details, ringers, footnotes, perf_id, timeMs)


def get_node(node, aspect, perf_id):
    try:
        return get_child_node_data(node.getElementsByTagName(aspect)[0], aspect, perf_id)
    except IndexError as e:
        # print("No", aspect, "value for:", perf_id, "-", aspect, "set to empty")
        return ""


def get_academic_year(date):
    date = datetime.datetime.strptime(date, '%Y-%m-%d')
    if date.month < 9:
        year_main = date.year - 1
        year_second = date.year
        return f"{year_main}/{str(year_second)[2:]}"
    else:
        year_main = date.year
        year_second = date.year + 1
        return f"{year_main}/{str(year_second)[2:]}"


def get_child_node_data(node, aspect, perf_id):
    try:
        return node.childNodes[0].data
    except IndexError as e:
        # print("No", aspect, "value for:", perf_id, "-", aspect, "set to empty")
        return ""
    except AttributeError as e:
        return ""
