import http.client
import xml.etree.ElementTree as et


# reqCount = "50"
reqCount = "2000"


def send_request(req):
    conn = http.client.HTTPSConnection("bb.ringingworld.co.uk")
    payload = ""
    headers = {'Accept': "application/xml"}
    conn.request("GET", req, payload, headers)
    res = conn.getresponse()
    return res.read()


def get_ids():
    data = send_request("/search.php?association_id=115&pagesize=" + reqCount)
    root = et.fromstring(data.decode("utf-8"))
    ids = []

    for x in root:
        ids.append(x.attrib.get("href").replace("view.php?id=", ""))

    return ids