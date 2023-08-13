import json
from types import SimpleNamespace

from main.peals.utils.Stat import Stat
from main.peals.utils.StatsEncoder import StatsEncoder
from utils.decodePerformanceJson import load_performances_from_file

if __name__ == '__main__':
    pealData = load_performances_from_file()
    stats = []
    ay = pealData[0].academic_year
    tempStat = Stat(ay, 0, 0, 0, 0, 0, 0, 0, 0)

    for peal in pealData:
        if peal.academic_year == ay:
            if peal.changes == "":
                c = 0
            else:
                c = int(peal.changes)

            if peal.type == 0:
                tempStat.peal_changes = tempStat.peal_changes + c
                tempStat.peal_blows = tempStat.peal_blows + (c * len(peal.ringers))
            if peal.type == 1:
                tempStat.quarter_changes = tempStat.quarter_changes + c
                tempStat.quarter_blows = tempStat.quarter_blows + (c * len(peal.ringers))
            if peal.type == 2:
                tempStat.other_changes = tempStat.other_changes + c
                tempStat.other_blows = tempStat.other_blows + (c * len(peal.ringers))

            tempStat.total_changes = tempStat.total_changes + c
            tempStat.total_blows = tempStat.total_blows + (c * len(peal.ringers))

        if peal.academic_year != ay:
            ay = peal.academic_year
            # print(tempStat)
            stats.append(tempStat)
            tempStat = Stat(ay, 0, 0, 0, 0, 0, 0, 0, 0)

    # print(stats)
    jsonStr = json.dumps(stats, indent=4, cls=StatsEncoder)
    f = open("peals/stats.json", "w")
    f.write(jsonStr)
    f.close()

