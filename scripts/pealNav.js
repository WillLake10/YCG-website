var year1 =
    [[
        ["2019", "2019/20"],
        ["2018", "2018/19"],
        ["2017", "2017/18"],
        ["2016", "2016/17"],
        ["2015", "2015/16"],
        ["2014", "2014/15"],
        ["2013", "2013/14"],
        ["2012", "2012/13"],
    ],
    [
        ["2011", "2011/12"],
        ["2010", "2010/11"],
        ["2009", "2009/10"],
        ["2008", "2008/09"],
        ["2007", "2007/08"],
        ["2006", "2006/07"],
        ["2005", "2005/06"],
        ["2004", "2004/05"],
    ],
    [
        ["2003", "2003/04"],
        ["2002", "2002/03"],
        ["2001", "2001/02"],
        ["2000", "2000/01"],
        ["Pre2000", "Pre 2000"],
    ]]


document.write('<section id="yearnav"><div class="container">')

for (var a = 0; a < year1.length; a++) {
        document.write('<nav class="navbar navbar-expand-sm navbar-light justify-content-center"><ul class="navbar-nav">')
        for (var b = 0; b < year1[a].length; b++) {
            if (year1[a][b][0] === "2003") {
                document.write('<li class="nav-item"><a class="nav-link disabled" href="#nav' + year1[a][b][0] + '">' + year1[a][b][1] + '</a></li>')
            } else {
                document.write('<li class="nav-item"><a class="nav-link" href="#nav' + year1[a][b][0] + '">' + year1[a][b][1] + '</a></li>')
            }
        }
        document.write('</ul></nav>')
}

document.write('</div></section>')