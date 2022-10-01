import http.client
import xml.etree.ElementTree as et
import xml.dom.minidom
import datetime
import multiprocessing as mp
import json
import datetime

# reqCount = "50"
reqCount = "2000"


class Performance:
    def __init__(self, academic_year, type, date, location, weight, time, changes, method, details, ringers, footnotes):
        self.academic_year = academic_year
        self.type = type
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


class PerformanceCount:
    def __init__(self, academic_year, peals, quarters, other):
        self.academic_year = academic_year
        self.peals = peals
        self.quarters = quarters
        self.other = other


class LocationCount:
    def __init__(self, academic_year, tower, summary):
        self.academic_year = academic_year
        self.tower = tower
        self.summary = summary


class Location:
    def __init__(self, tower, peals, quarters, other, total):
        self.tower = tower
        self.peals = peals
        self.quarters = quarters
        self.other = other
        self.total = total


class Summary:
    def __init__(self, peals, quarters, other, total):
        self.peals = peals
        self.quarters = quarters
        self.other = other
        self.total = total


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

    type = 2
    if changes != '':
        if int(changes) > 1200:
            type = 1
        if int(changes) > 5000:
            type = 0

    return Performance(academic_year, type, date, location, weight, time, changes, method, details, ringers, footnotes)


def get_last_peal(all_perf):
    for pm in all_perf:
        if pm.changes != "":
            if int(pm.changes) > 5000:
                last_peal = open("peals/lastPeal.json", "w")
                last_peal.write(json.dumps(pm, indent=4, cls=PerformanceEncoder))
                last_peal.close()
                break


if __name__ == '__main__':
    print("--Starting API Call for IDs--")
    all_ids = get_ids()
    print("--Ending API Call for IDs--")
    print("--Starting API Calls for Performances--")
    with mp.Pool(mp.cpu_count()) as p:
        performances = p.map(get_performance, all_ids)

    # performances = [get_performance(all_ids[0])]

    print("--API calls complete--")
    print("" + str(len(performances)) + " recorded performances")
    print("Starting File Write")
    get_last_peal(performances)
    f = open("peals/lastRinging.json", "w")
    if performances[0].date == performances[1].date:
        if len(performances[1].ringers) > len(performances[0].ringers):
            f.write(json.dumps(performances[1], indent=4, cls=PerformanceEncoder))
        else:
            f.write(json.dumps(performances[0], indent=4, cls=PerformanceEncoder))
    else:
        f.write(json.dumps(performances[0], indent=4, cls=PerformanceEncoder))
    f.close()
    currentTime = datetime.datetime.now()
    f = open("peals/lastEdit.json", "w")
    f.write("{\n    \"time\": \"" + currentTime.strftime("%d/%m/%Y at %X GMT") + "\"\n}")
    f.close()

    jsonStr = json.dumps(performances, indent=4, cls=PerformanceEncoder)
    f = open("peals/pealDataOriginal.json", "w")
    f.write(jsonStr)
    f.close()

    performancesOriginal = performances.copy()

    performances.sort(key=lambda x: (x.academic_year, -x.type), reverse=True)
    jsonStr = json.dumps(performances, indent=4, cls=PerformanceEncoder)
    f = open("peals/pealData.json", "w")
    f.write(jsonStr)
    f.close()

    ay = performances[0].academic_year
    counts = []
    p = 0
    q = 0
    o = 0
    for perf in performances:
        # print(perf.date)
        #
        # print(perf.type)
        if perf.academic_year != ay:
            counts.append(PerformanceCount(ay, p, q, o))
            ay = perf.academic_year
            p = 0
            q = 0
            o = 0

        if perf.type == 0:
            p += 1
        if perf.type == 1:
            q += 1
        if perf.type == 2:
            o += 1

    jsonStr = json.dumps(counts, indent=4, cls=PerformanceEncoder)
    f = open("peals/counts.json", "w")
    f.write(jsonStr)
    f.close()

    performancesOriginal.sort(key=lambda x: (x.academic_year, x.location), reverse=True)

    ay = performancesOriginal[0].academic_year
    currentLocation = performancesOriginal[0].location

    tempCount = LocationCount(ay, [], "")
    summary = Summary(0, 0, 0, 0)
    tempLocation = Location(performancesOriginal[0].location, 0, 0, 0, 0)
    counts = []

    towerNames = {
        "Huntington": "Huntington (All Saints), North Yorkshire",
        "Arts Centre": "York (Former St John (Arts Center)), Yorkshire",
        "Minster": "York (Cathedral and Metropolitical Church of St Peter), North Yorkshire",
        "Minster (Ringing Chamber)": "York (Ringing Chamber, Cathedral and Metropolitical Church of St Peter), North Yorkshire",
        "Minster (Clock Chamber)": "York (Clock Chamber, SW tower, Cathedral and Metropolitical Church of St Peter), North Yorkshire",
        "St Lawrence": "York (St Lawrence), North Yorkshire",
        "St Martin le Grand": "York (St Martin le Grand, Coney Street), North Yorkshire",
        "Stockton-on-the-Forest": "Stockton-on-the-Forest (Holy Trinity), North Yorkshire",
        "St Wilfrids": "York (Oratory Church of St Wilfrid), North Yorkshire",
        "Clifton": "York (St Philip and St James, Clifton), North Yorkshire",
        "Spurriergate": "York (Spurriergate Centre), North Yorkshire",
        "Bishopthorpe": "York (St Andrew, Bishopthorpe), North Yorkshire",
        "St Olave": "York (St Olave, Marygate), North Yorkshire",
        "Acomb": "Acomb (St Stephen), North Yorkshire",
        "North Street": "York (All Saints, North Street), North Yorkshire",
        "Bedale": "Bedale (St Gregory), North Yorkshire",
        "Nunburnholme": "Nunburnholme (St James), East Riding of Yorkshire",
        "Strensall": "Strensall (St Mary the Virgin), North Yorkshire",
        "Barnoldswick": "Barnoldswick (St Mary le Ghyll), Lancashire",
        "Broughton in Craven": "Broughton in Craven (All Saints), North Yorkshire",
        "Holme on Spalding Moor": "Holme on Spalding Moor (All Saints), East Riding of Yorkshire",
        "Inveraray": "Inveraray (All Saints), Argyll and Bute",
        "Kirby Hill": "Kirby Hill (All Saints), North Yorkshire",
        "Pontefract": "Pontefract (All Saints), West Yorkshire",
        "Rufforth": "Rufforth (All Saints), North Yorkshire",
        "Thorpe Arch": "Thorpe Arch (All Saints), West Yorkshire",
        "Yatesbury": "Yatesbury (All Saints), Wiltshire	",
        "East Campus": "University of York (East Campus), North Yorkshire",
        "Brewster": "Brewster (Melrose School), New York",
        "Dunkirk": "Dunkirk (Red Light Ring), Nottinghamshire",
        "Pontefract (St Giles)": "Pontefract (St Giles), West Yorkshire",
        "West Bridgford": "West Bridgford (St Giles), Nottinghamshire",
        "Ainderby Steeple": "Ainderby Steeple (St Helen), North Yorkshire",
        "Escrick": "Escrick (St Helen), North Yorkshire",
        "Birstwith": "Birstwith (St James the Apostle), North Yorkshire",
        "St John's College": "York (St John's College), North Yorkshire",
        "Seale": "Seale (St Lawrence), Surrey",
        "Bilborough": "Bilborough (St Martin of Tours), Nottinghamshire",
        "Chieveley": "Chieveley (St Mary the Virgin), Berkshire",
        "Beenham": "Beenham (St Mary), Berkshire",
        "Wath": "Wath juxta Ripon (St Mary), North Yorkshire",
        "Weldon": "Weldon (St Mary), Northamptonshire",
        "Midgham": "Midgham (St Matthew), Berkshire",
        "Pirbright": "Pirbright (St Michael), Surrey",
        "Yorktown": "Yorktown (St Michael), Surrey",
        "Chiswick": "Chiswick (St Nicholas), Greater London",
        "Newbury": "Newbury (St Nicolas), Berkshire",
        "Horton in Ribblesdale": "Horton in Ribblesdale (St Oswald), North Yorkshire",
        "Marton in Craven": "Marton in Craven (St Peter), North Yorkshire",
        "Upper Helmsley": "Upper Helmsley (St Peter), North Yorkshire",
        "Harrogate": "Harrogate (St Wilfrids), North Yorkshire",
        "Rochester": "Rochester (The Ascension), New York",
        "Ringing Room": "Ringing Room, UK",
        "Richmond": "Richmond, North Yorkshire",
        "Baskerville": "Baskerville House (Lichfield Diocesan Mobile Belfry), Staffordshire",
        "532 Norwich Road": "Ipswich (532 Norwich Road (The Vestey Ring)), Suffolk",
        "35 Willis Street": "York (35 Willis Street), North Yorkshire",
        "61 Fox Street": "Warrington (61 Fox Street)",
    }

    locationSynonyms = {
        "All Saints, Huntington, York, North Yorkshire": towerNames["Huntington"],
        "All Saints, Huntington, North Yorkshire": towerNames["Huntington"],
        "Art's Centre, York, North Yorkshire": towerNames["Arts Centre"],
        "Arts Centre, Micklegate, York, North Yorkshire": towerNames["Arts Centre"],
        "Arts Centre, York, North Yorkshire": towerNames["Arts Centre"],
        "Former St John (Arts Center), York, Yorkshire": towerNames["Arts Centre"],
        "Former St John, York, North Yorkshire": towerNames["Arts Centre"],
        "Tiger 10 (a ka The Parish, fomerly St John, Ousebridge), York, N Yorkshire": towerNames["Arts Centre"],
        "Cathedral and Metropolitical Church of St Peter, York, North Yorkshire": towerNames["Minster"],
        "Cathedral & Metropolitical Church of St Peter, York, North Yorkshire": towerNames["Minster"],
        "Minster, York, North Yorkshire": towerNames["Minster"],
        "Minster (clock chamber, SW tower), York, ": towerNames["Minster (Clock Chamber)"],
        "Minster (Ringing Chamber), York, ": towerNames["Minster (Ringing Chamber)"],
        "St Lawrence, York, North Yorkshire": towerNames["St Lawrence"],
        "St Lawrence, York, ": towerNames["St Lawrence"],
        "St Lawrence, York, Yorkshire": towerNames["St Lawrence"],
        "St Lawrence, York, N Yorkshire": towerNames["St Lawrence"],
        ", York (St Lawrence), N Yorkshire": towerNames["St Lawrence"],
        "York (St. Lawrence), North Yorkshire": towerNames["St Lawrence"],
        ", York (St. Lawrence), North Yorkshire": towerNames["St Lawrence"],
        ", York St Laurence, North Yorkshire": towerNames["St Lawrence"],
        "St Laurence, Hull Road, York, ": towerNames["St Lawrence"],
        "St Laurence, York, ": towerNames["St Lawrence"],
        "St Laurence, York, N Yorkshire": towerNames["St Lawrence"],
        "St Laurence, York, N. Yorkshire": towerNames["St Lawrence"],
        "St Laurence, York, North Yorkshire": towerNames["St Lawrence"],
        "St Laurence, York, Yorkshire": towerNames["St Lawrence"],
        "St Martin le Grand, York, North Yorkshire": towerNames["St Martin le Grand"],
        "St Martin Le Grand, York, Yorkshire": towerNames["St Martin le Grand"],
        "St Martin-le-Grand, Coney Street, York, North Yorkshire": towerNames["St Martin le Grand"],
        "St Martin le Grand (Coney Street), York, North Yorkshire": towerNames["St Martin le Grand"],
        "St Martin le Grand, Coney Street, York, ": towerNames["St Martin le Grand"],
        "St Martin le Grand, Coney Street, York, North Yorkshire": towerNames["St Martin le Grand"],
        "St Martin le Grand, York, ": towerNames["St Martin le Grand"],
        "St Martin, York, N Yorkshire": towerNames["St Martin le Grand"],
        "St Martin-le-Grand, York, ": towerNames["St Martin le Grand"],
        "St Martin-le-Grand, York, N.Yorkshire": towerNames["St Martin le Grand"],
        "Holy Trinity, Stockton on the Forest, North Yorkshire": towerNames["Stockton-on-the-Forest"],
        "Holy Trinity, Stockton-on-the-Forest, North Yorkshire": towerNames["Stockton-on-the-Forest"],
        "St Wilfrid RC, York, North Yorkshire": towerNames["St Wilfrids"],
        "St Wilfrid, York, North Yorkshire": towerNames["St Wilfrids"],
        "St Wilfrid, York, ": towerNames["St Wilfrids"],
        "St Wilfrid, York, N Yorkshire": towerNames["St Wilfrids"],
        "St Wilfrid, York, N. Yorkshire": towerNames["St Wilfrids"],
        "Oratory Church of St Wilfrid, York, North Yorkshire": towerNames["St Wilfrids"],
        "SS Philip & James, Clifton, York, ": towerNames["Clifton"],
        "SS Philip and James, Clifton, York, ": towerNames["Clifton"],
        "SS Philip and James, Clifton, York, N Yorkshire": towerNames["Clifton"],
        "SS Philip and James, Clifton, York, North Yorkshire": towerNames["Clifton"],
        "St Philip and St James, Clifton, North Yorkshire": towerNames["Clifton"],
        "St Philip and St James, Clifton, York, North Yorkshire": towerNames["Clifton"],
        "Spurriergate (St Michael), York, N Yorkshire": towerNames["Spurriergate"],
        "Spurriergate Centre (Formerly St Michael), York, North Yorkshire": towerNames["Spurriergate"],
        "Spurriergate Centre, York, ": towerNames["Spurriergate"],
        "Spurriergate Centre, York, North Yorkshire": towerNames["Spurriergate"],
        "Spurriergate Centre, York, Yorkshire": towerNames["Spurriergate"],
        "Spurriergate, York, ": towerNames["Spurriergate"],
        "St Michael, Spurriergate, York, N Yorkshire": towerNames["Spurriergate"],
        "St Michael, Spurriergate, York, North Yorkshire": towerNames["Spurriergate"],
        "St Andrew, Bishopthorpe, North Yorkshire": towerNames["Bishopthorpe"],
        "St Andrew, Bishopthorpe, York, North Yorkshire": towerNames["Bishopthorpe"],
        "St Andrew, York (Bishopthorpe), ": towerNames["Bishopthorpe"],
        "St Olave, Marygate, York, North Yorkshire": towerNames["St Olave"],
        "St Olave, York, ": towerNames["St Olave"],
        "St Olave, York, N Yorkshire": towerNames["St Olave"],
        "St Olave, York, North Yorkshire": towerNames["St Olave"],
        "St Stephen, Acomb, North Yorkshire": towerNames["Acomb"],
        "All Saints, North Street, York, North Yorkshire": towerNames["North Street"],
        "St Gregory, Bedale, North Yorkshire": towerNames["Bedale"],
        "St James, Nunburnholme, East Riding of Yorkshire": towerNames["Nunburnholme"],
        "St Mary the Virgin, Strensall, North Yorkshire": towerNames["Strensall"],
        "St Mary le Ghyll, Barnoldswick, Lancashire": towerNames["Barnoldswick"],
        "All Saints, Broughton in Craven, North Yorkshire": towerNames["Broughton in Craven"],
        "All Saints, Holme on Spalding Moor, East Riding of Yorkshire": towerNames["Broughton in Craven"],
        "All Saints, Inveraray, Argyll": towerNames["Inveraray"],
        "All Saints, Kirby Hill, North Yorkshire": towerNames["Kirby Hill"],
        "All Saints, Pontefract, West Yorkshire": towerNames["Pontefract"],
        "All Saints, Rufforth, North Yorkshire": towerNames["Rufforth"],
        "All Saints, Thorpe Arch, West Yorkshire": towerNames["Thorpe Arch"],
        "All Saints, Yatesbury, Wiltshire": towerNames["Yatesbury"],
        "East Campus, University of York, North Yorkshire": towerNames["East Campus"],
        "Campus East Stall 10, University of York Open Day, ": towerNames["East Campus"],
        "Melrose School, Brewster, New York": towerNames["Brewster"],
        "Red Light Ring, Dunkirk, Nottinghamshire": towerNames["Dunkirk"],
        "St Giles, Pontefract, West Yorkshire": towerNames["Pontefract (St Giles)"],
        "St Giles, West Bridgford, Nottinghamshire": towerNames["West Bridgford"],
        "St Helen, Ainderby Steeple, North Yorkshire": towerNames["Ainderby Steeple"],
        "St Helen, Escrick, North Yorkshire": towerNames["Escrick"],
        "St James the Apostle, Birstwith, North Yorkshire": towerNames["Birstwith"],
        "St John's College, York, North Yorkshire": towerNames["St John's College"],
        "St Lawrence, Seale, Surrey": towerNames["Seale"],
        "St Martin of Tours, Bilborough, Nottinghamshire": towerNames["Bilborough"],
        "St Mary the Virgin, Chieveley, Berkshire": towerNames["Chieveley"],
        "St Mary, Beenham, Berkshire": towerNames["Beenham"],
        "St Mary, Wath juxta Ripon, North Yorkshire": towerNames["Wath"],
        "St Mary, Weldon, Northamptonshire": towerNames["Weldon"],
        "St Matthew, Midgham, Berkshire": towerNames["Midgham"],
        "St Michael, Pirbright, Surrey": towerNames["Pirbright"],
        "St Michael, Yorktown, Surrey": towerNames["Yorktown"],
        "St Nicholas, Chiswick, Greater London": towerNames["Chiswick"],
        "St Nicolas, Newbury, Berkshire": towerNames["Newbury"],
        "St Oswald, Horton in Ribblesdale, North Yorkshire": towerNames["Horton in Ribblesdale"],
        "St Peter, Marton in Craven, North Yorkshire": towerNames["Marton in Craven"],
        "St Peter, Upper Helmsley, North Yorkshire": towerNames["Upper Helmsley"],
        "St Wilfrids, Harrogate, North Yorkshire": towerNames["Harrogate"],
        "The Ascension, Rochester, New York": towerNames["Rochester"],
        ", Ringing Room, UK": towerNames["Ringing Room"],
        ", Richmond, North Yorkshire": "Richmond, North Yorkshire",
        "Lichfield Diocesan Mobile Belfry, Baskerville House, Staffordshire": towerNames["Baskerville"],
        "532 Norwich Road (The Vestey Ring), Ipswich, Suffolk": towerNames["532 Norwich Road"],
        "35 Willis Street, York, North Yorkshire": towerNames["35 Willis Street"],
        "61 Fox Street, Warrington, ": towerNames["61 Fox Street"],
    }

    if performancesOriginal[0].location in locationSynonyms:
        temp = False
        for val in tempCount.tower:
            if val.tower == locationSynonyms[perf.location]:
                tempLocation = Location(locationSynonyms[perf.location], val.peals, val.quarters, val.other,
                                        val.total)
                tempCount.tower.remove(val)
                temp = True
        if not temp:
            tempLocation = Location(locationSynonyms[perf.location], 0, 0, 0, 0)
    else:
        tempLocation = Location(perf.location, 0, 0, 0, 0)

    for perf in performancesOriginal:
        if perf.academic_year != ay:
            print(tempLocation.tower)
            tempCount.tower.append(tempLocation)


            tempCount.tower.sort(key=lambda x: -x.total)
            tempCount.summary = summary
            counts.append(tempCount)

            currentLocation = perf.location
            summary = Summary(0, 0, 0, 0)
            ay = perf.academic_year
            tempCount = LocationCount(ay, [], "")
            if perf.location in locationSynonyms:
                temp = False
                for val in tempCount.tower:
                    if val.tower == locationSynonyms[perf.location]:
                        tempLocation = Location(locationSynonyms[perf.location], val.peals, val.quarters, val.other,
                                                val.total)
                        tempCount.tower.remove(val)
                        temp = True
                if not temp:
                    tempLocation = Location(locationSynonyms[perf.location], 0, 0, 0, 0)
            else:
                tempLocation = Location(perf.location, 0, 0, 0, 0)
            currentLocation = perf.location
            print("------------")

        if perf.location != currentLocation:
            # print(tempLocation.tower)
            tempCount.tower.append(tempLocation)
            if perf.location in locationSynonyms:
                temp = False
                for val in tempCount.tower:
                    if val.tower == locationSynonyms[perf.location]:
                        tempLocation = Location(locationSynonyms[perf.location], val.peals, val.quarters, val.other,
                                                val.total)
                        tempCount.tower.remove(val)
                        temp = True
                if not temp:
                    tempLocation = Location(locationSynonyms[perf.location], 0, 0, 0, 0)
            else:
                tempLocation = Location(perf.location, 0, 0, 0, 0)
            currentLocation = perf.location

        if perf.type == 0:
            tempLocation.peals += 1
            summary.peals += 1
        if perf.type == 1:
            tempLocation.quarters += 1
            summary.quarters += 1
        if perf.type == 2:
            tempLocation.other += 1
            summary.other += 1

        tempLocation.total += 1
        summary.total += 1

    jsonStr = json.dumps(counts, indent=4, cls=PerformanceEncoder)
    f = open("peals/locationsCounts.json", "w")
    f.write(jsonStr)
    f.close()

    performancesOriginal.sort(key=lambda x: x.location)
    tempCount = LocationCount("Summary", [], "")
    currentLocation = performancesOriginal[0].location
    summary = Summary(0, 0, 0, 0)
    tempLocation = Location(performancesOriginal[0].location, 0, 0, 0, 0)

    for perf in performancesOriginal:
        if perf.location != currentLocation:
            tempCount.tower.append(tempLocation)
            if perf.location in locationSynonyms:
                for val in tempCount.tower:
                    if val.tower == locationSynonyms[perf.location]:
                        tempLocation = Location(locationSynonyms[perf.location], val.peals, val.quarters, val.other,
                                                val.total)
                        tempCount.tower.remove(val)
                    else:
                        tempLocation = Location(locationSynonyms[perf.location], 0, 0, 0, 0)
            else:
                tempLocation = Location(perf.location, 0, 0, 0, 0)
            currentLocation = perf.location

        if perf.type == 0:
            tempLocation.peals += 1
            summary.peals += 1
        if perf.type == 1:
            tempLocation.quarters += 1
            summary.quarters += 1
        if perf.type == 2:
            tempLocation.other += 1
            summary.other += 1

        tempLocation.total += 1
        summary.total += 1

    tempCount.summary = summary
    tempCount.tower.sort(key=lambda x: (-x.total, x.tower))
    del tempCount.academic_year

    jsonStr = json.dumps(tempCount, indent=4, cls=PerformanceEncoder)
    f = open("peals/locationSummary.json", "w")
    f.write(jsonStr)
    f.close()

    print("File Write Finished")
