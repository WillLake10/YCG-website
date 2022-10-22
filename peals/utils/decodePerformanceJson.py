import json

from .Performance import Performance
from .Ringer import Ringer


def load_performances_from_file():
    perf_json = load_json()
    performances = []
    for perf in perf_json:
        # print(perf)
        ringers = []
        for ringer in perf['ringers']:
            ringers.append(Ringer(ringer['name'], ringer['bell']))
        footnotes = []
        for footnote in perf['footnotes']:
            footnotes.append(footnote)
        performances.append(
            Performance(
                perf['academic_year'],
                perf['type'],
                perf['date'],
                perf['location'],
                perf['weight'],
                perf['time'],
                perf['changes'],
                perf['method'],
                perf['details'],
                ringers,
                footnotes,
                perf['id'],
                perf['time_in_ms'],
            )
        )

    return performances


def load_json():
    f = open('peals/pealDataOriginal.json')
    data = json.load(f)
    return data
