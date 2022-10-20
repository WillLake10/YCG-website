import json

from .PerformanceCount import PerformanceCount
from .Location import Location
from .LocationCount import LocationCount
from .Summary import Summary
from .PerformanceEncoder import PerformanceEncoder
from .locationData import locationSynonyms


def build_counts(performances):

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
    currentLocation = locationSynonyms[performancesOriginal[0].location]

    tempCount = LocationCount(ay, [], "")
    summary = Summary(0, 0, 0, 0)
    tempLocation = Location(locationSynonyms[performancesOriginal[0].location], 0, 0, 0, 0)
    counts = []

    for perf in performancesOriginal:
        if perf.academic_year != ay:
            # print(tempLocation.tower)
            tempCount.tower.append(tempLocation)

            tempCount.tower.sort(key=lambda x: (-x.total, -x.peals, -x.quarters, -x.other))
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
            # print("------------")

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
                print("No Location Synonym: ", perf.location)
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