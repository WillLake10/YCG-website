import multiprocessing as mp
import json
from datetime import datetime, timedelta

from utils.request import get_ids_changed_since_date
from utils.PerformanceEncoder import PerformanceEncoder
from utils.getPerformances import get_performance
from utils.buildCounts import build_counts
from utils.decodePerformanceJson import load_performances_from_file


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
    date_2_says_ago = datetime.now() - timedelta(days=2)
    all_ids = get_ids_changed_since_date(date_2_says_ago.strftime('%Y-%m-%d'))
    print("--Ending API Call for IDs--")
    print("--Starting API Calls for Performances--")

    with mp.Pool(mp.cpu_count()) as p:
        performances = p.map(get_performance, all_ids)

    print("--API calls complete--")

    performances_existing = load_performances_from_file()

    print(len(performances_existing))

    for performance in performances_existing:
        for perf in performances:
            if performance.id == perf.id:
                performances_existing.remove(performance)

    print(len(performances_existing))

    print("" + str(len(performances)) + " performances updated or added")

    for performance in performances_existing:
        performances.append(performance)

    print("" + str(len(performances)) + " performances in file")

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
    currentTime = datetime.now()
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
