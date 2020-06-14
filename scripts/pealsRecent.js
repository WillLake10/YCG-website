/*
Website: York Colleges Guild
Type: 2019 Peals Generation Code
Created: 14th June 2020
Last modified: 14th June 2020
Author: Will Lake
 */

let recentPealData;
document.write('<section id="recent"><div class="container"><div class="row">')
for (var a = 0; a < 2; a++) {
    document.write('<div class="col-md-6 pb-3"><div class="head_title">')
    if (a === 0){
        document.write('Last Peal')
        recentPealData = getRecentPeal()
    } else{
        document.write('Last Ringing')
        recentPealData = getRecentQuater()
    }
    document.write('</div>')
    document.write('<div class="card bg-light text-dark pealcardpadding"><div class="card-head">')
    document.write('<div class="pealdate">' + recentPealData[0].date + '</div>')
    document.write('<div class="pealtower">' + recentPealData[0].location)
    if (recentPealData[0].weight !== "") {
        document.write(' (' + recentPealData[0].weight + ')')
    }
    if (recentPealData[0].time !== "") {
        document.write(' in ' + recentPealData[0].time)
    }
    document.write('</div>')
    document.write('</div><div class="card-body">')
    document.write('<div class="pealmethodmain">' + recentPealData[0].method + '</div>')
    document.write('<div class="pealmethodsecondery">' + recentPealData[0].methodSecond + '</div>')
    document.write('<div class="pealringer"><ul style="list-style-type:none;">')
    for (var j = 0; j < recentPealData[0].ringers.length; j++) {
        document.write('<li>' + recentPealData[0].ringers[j][0] + ' - ' + recentPealData[0].ringers[j][1] + '</li>')
    }
    document.write('</ul></div>')
    for (var k = 0; k < recentPealData[0].footnotes.length; k++) {
        document.write('<div class="pealfootnote">' + recentPealData[0].footnotes[k] + '</div>')
    }
    document.write('<img src="' + recentPealData[0].image + '" class="img-fluid mx-auto d-block pealphoto">')
    document.write('<span class="pealphotocaption">' + recentPealData[0].imageCaption + '</span>')
    document.write('</div></div></div>')
}
document.write('</div></div></section>')

function getRecentQuater() {
    return [
        {
            "date": "Saturday, 13 June 2020",
            "location": "Ringing Room, UK",
            "weight": "",
            "time": "6m",
            "method": "120 Plain Bob Doubles",
            "methodSecond": "",
            "ringers": [["1", "Rebecca Hall"], ["2", "William Lake"], ["3", "Simon Cumming"], ["4", "Huw Foden"], ["5", "Rosemary S Hall (C)"], ["6", "Tom M G McGonagle"]],
            "footnotes": ["Rung by current members on the day that our 50th dinner day didn't happen due to COVID-19 pandemic", "The band would like to associate Simon's internet connection with this performance",],
            "image": "",
            "imageCaption": "",
        }
    ]
}

function getRecentPeal() {
    return [
        {
            "date": "Friday, 3rd June 2016",
            "location": "St Lawrence, York, North Yorkshire",
            "weight": "7-3-24 in A",
            "time": "2h 56",
            "method": "5152 Yorkshire Surprise Major",
            "methodSecond": "",
            "ringers": [["1", "Peter D Hughes (Superfan)"], ["2", "Claire E Reading (Langwith)"], ["3", "William L K Brooke (Halifax)"], ["4", "Lucy Williamson (Alcuin)"], ["5", "Claire L Pearson (Alcuin)"], ["6", "Nathan C Cox (St John)"], ["7", "Ryan Mills (Halifax) (C)"], ["8", "Eric W S Wolever (Wentworth)"],],
            "footnotes": ["Rung in anticipation of the 46th annual York Colleges Guild Dinner.", "With many thanks to YCG superfan Peter Hughes for replacing Kevin Atkinson's right hand at the last minute!", "First surprise: 2", "First surprise inside: 4",],
            "image": "",
            "imageCaption": "",
        }
    ]
}