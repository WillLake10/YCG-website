import json


class PerformanceEncoder(json.JSONEncoder):
    def default(self, o):
        return o.__dict__
