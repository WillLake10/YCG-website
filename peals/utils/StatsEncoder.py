import json


class StatsEncoder(json.JSONEncoder):
    def default(self, o):
        return o.__dict__
