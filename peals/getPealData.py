import http.client
import xml.etree.ElementTree as et
import xml.dom.minidom
import datetime
import multiprocessing as mp
import json
import datetime

class Performance:
    def __init__(self, academic_year, date, location, weight, time, changes, method, details, ringers, footnotes):
        self.academic_year = academic_year
        self.date = date
        self.location = location
        self.weight = weight
        self.time = time
        self.changes = changes
        self.method = method
        self.details = details
        self.ringers = ringers
        self.footnotes = footnotes


class Ringer:
    def __init__(self, name, bell):
        self.name = name
        self.bell = bell


class PerformanceEncoder(json.JSONEncoder):
    def default(self, o):
        return o.__dict__


def send_request(req):
    conn = http.client.HTTPSConnection("bb.ringingworld.co.uk")
    payload = ""
    headers = {'Accept': "application/xml"}
    conn.request("GET", req, payload, headers)
    res = conn.getresponse()
    return res.read()


def get_ids():
    data = send_request("/search.php?association_id=115&pagesize=20000")
    root = et.fromstring(data.decode("utf-8"))
    ids = []

    for x in root:
        ids.append(x.attrib.get("href").replace("view.php?id=", ""))

    return ids


def get_child_node_data(node, aspect, perf_id):
    try:
        return node.childNodes[0].data
    except IndexError as e:
        # print("No", aspect, "value for:", perf_id, "-", aspect, "set to empty")
        return ""
    except AttributeError as e:
        return ""


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
    date = datetime.datetime.strptime(date, '%Y-%m-%d').strftime('%A, %d %B %Y')
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

    return Performance(academic_year, date, location, weight, time, changes, method, details, ringers, footnotes)


def get_last_peal(all_perf):
    for pm in all_perf:
        if pm.changes != "":
            if int(pm.changes) > 5000:
                last_peal = open("peals/lastPeal.json", "w")
                last_peal.write(json.dumps(pm, indent=4, cls=PerformanceEncoder))
                last_peal.close()
                break


if __name__ == '__main__':
    all_ids = get_ids()
    print("--Starting API Calls--")
    with mp.Pool(mp.cpu_count()) as p:
        performances = p.map(get_performance, all_ids)

    # performances = [get_performance(all_ids[0])]

    print("--API calls complete--")
    print("" + str(len(performances)) + " recorded performances")
    print("Starting File Write")
    jsonStr = json.dumps(performances, indent=4, cls=PerformanceEncoder)
    f = open("peals/pealData.json", "w")
    f.write(jsonStr)
    f.close()
    get_last_peal(performances)
    f = open("peals/lastRinging.json", "w")
    f.write(json.dumps(performances[0], indent=4, cls=PerformanceEncoder))
    f.close()
    currentTime = datetime.datetime.now()
    f = open("peals/lastEdit.json", "w")
    f.write("{\n    \"time\": \"" + currentTime.strftime("%d/%m/%Y at %X GMT") + "\"\n}")
    f.close()
    print("File Write Finished")
