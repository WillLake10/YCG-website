import multiprocessing as mp
import json
import datetime

from utils.request import get_ids
from utils.PerformanceEncoder import PerformanceEncoder
from utils.getPerformances import get_performance
from utils.buildCounts import build_counts


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

    customIds = ["1107684", "1103088", "12526", "1527256", "1527126", "1526223", "1523183", "1523517", "1523514",
                 "1526423", "1526422", "1149980", "996941"]
    with mp.Pool(mp.cpu_count()) as p:
        performancesCustom = p.map(get_performance, customIds)

    for perf in performancesCustom:
        performances.append(perf)

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

    performances.sort(key=lambda x: x.time_in_ms, reverse=True)
    jsonStr = json.dumps(performances, indent=4, cls=PerformanceEncoder)
    f = open("peals/pealDataOriginal.json", "w")
    f.write(jsonStr)
    f.close()

    build_counts(performances)

    print("File Write Finished")
