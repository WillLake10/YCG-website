import json

from main.peals.utils.StageOn import StageOn
from main.peals.utils.Stages import Stages
from utils.Stat import Stat
from utils.StatsEncoder import StatsEncoder
from utils.decodePerformanceJson import load_performances_from_file

if __name__ == '__main__':
    pealData = load_performances_from_file()
    stats = []
    stages = []
    ay = pealData[0].academic_year
    tempStat = Stat(ay, 0, 0, 0, 0, 0, 0, 0, 0)
    tempStagePeal = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)
    tempStageQuarter = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)
    tempStageOther = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

    for peal in pealData:
        if peal.academic_year != ay:
            stages.append(Stages(ay, tempStagePeal, tempStageQuarter, tempStageOther))
            ay = peal.academic_year
            # print(tempStat)
            stats.append(tempStat)
            tempStat = Stat(ay, 0, 0, 0, 0, 0, 0, 0, 0)
            tempStagePeal = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)
            tempStageQuarter = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)
            tempStageOther = StageOn(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

        if peal.changes == "":
            c = 0
        else:
            c = int(peal.changes)

        if peal.type == 0:
            tempStat.peal_changes = tempStat.peal_changes + c
            tempStat.peal_blows = tempStat.peal_blows + (c * len(peal.ringers))
            if "singles" in peal.method.lower():
                tempStagePeal.singles += 1
            elif "minimus" in peal.method.lower():
                tempStagePeal.minimus += 1
            elif "doubles" in peal.method.lower():
                tempStagePeal.doubles += 1
            elif "minor" in peal.method.lower():
                tempStagePeal.minor += 1
            elif "triples" in peal.method.lower():
                tempStagePeal.triples += 1
            elif "major" in peal.method.lower():
                tempStagePeal.major += 1
            elif "caters" in peal.method.lower():
                tempStagePeal.caters += 1
            elif "royal" in peal.method.lower():
                tempStagePeal.royal += 1
            elif "cinques" in peal.method.lower():
                tempStagePeal.cinques += 1
            elif "maximus" in peal.method.lower():
                tempStagePeal.maximus += 1
            else:
                tempStagePeal.other += 1
        if peal.type == 1:
            tempStat.quarter_changes = tempStat.quarter_changes + c
            tempStat.quarter_blows = tempStat.quarter_blows + (c * len(peal.ringers))
            if "singles" in peal.method.lower():
                tempStageQuarter.singles += 1
            elif "minimus" in peal.method.lower():
                tempStageQuarter.minimus += 1
            elif "doubles" in peal.method.lower():
                tempStageQuarter.doubles += 1
            elif "minor" in peal.method.lower():
                tempStageQuarter.minor += 1
            elif "triples" in peal.method.lower():
                tempStageQuarter.triples += 1
            elif "major" in peal.method.lower():
                tempStageQuarter.major += 1
            elif "caters" in peal.method.lower():
                tempStageQuarter.caters += 1
            elif "royal" in peal.method.lower():
                tempStageQuarter.royal += 1
            elif "cinques" in peal.method.lower():
                tempStageQuarter.cinques += 1
            elif "maximus" in peal.method.lower():
                tempStageQuarter.maximus += 1
            else:
                tempStageQuarter.other += 1
        if peal.type == 2:
            tempStat.other_changes = tempStat.other_changes + c
            tempStat.other_blows = tempStat.other_blows + (c * len(peal.ringers))
            if "singles" in peal.method.lower():
                tempStageOther.singles += 1
            elif "minimus" in peal.method.lower():
                tempStageOther.minimus += 1
            elif "doubles" in peal.method.lower():
                tempStageOther.doubles += 1
            elif "minor" in peal.method.lower():
                tempStageOther.minor += 1
            elif "triples" in peal.method.lower():
                tempStageOther.triples += 1
            elif "major" in peal.method.lower():
                tempStageOther.major += 1
            elif "caters" in peal.method.lower():
                tempStageOther.caters += 1
            elif "royal" in peal.method.lower():
                tempStageOther.royal += 1
            elif "cinques" in peal.method.lower():
                tempStageOther.cinques += 1
            elif "maximus" in peal.method.lower():
                tempStageOther.maximus += 1
            else:
                tempStageOther.other += 1

        tempStat.total_changes = tempStat.total_changes + c
        tempStat.total_blows = tempStat.total_blows + (c * len(peal.ringers))

    # print(stats)
    jsonStr = json.dumps(stats, indent=4, cls=StatsEncoder)
    f = open("peals/stats.json", "w")
    f.write(jsonStr)
    f.close()

    jsonStr = json.dumps(stages, indent=4, cls=StatsEncoder)
    f = open("peals/stages.json", "w")
    f.write(jsonStr)
    f.close()
