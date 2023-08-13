class Stat:
    def __init__(self, academic_year, peal_changes, quarter_changes, other_changes, total_changes, peal_blows,
                 quarter_blows, other_blows, total_blows):
        self.academic_year = academic_year
        self.peal_changes = peal_changes
        self.quarter_changes = quarter_changes
        self.other_changes = other_changes
        self.total_changes = total_changes
        self.peal_blows = peal_blows
        self.quarter_blows = quarter_blows
        self.other_blows = other_blows
        self.total_blows = total_blows

    def __str__(self):
        return (self.academic_year + "," + str(self.peal_changes) + "," + str(self.quarter_changes) + ","
                + str(self.other_changes)+ "," + str(self.total_changes) + "," + str(self.peal_blows) + ","
                + str(self.quarter_blows) + "," + str(self.other_blows) + "," + str(self.total_blows))
