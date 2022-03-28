var year1 =
    [
        ["2021", "2020/22", false],
        ["2020", "2020/21", true],
        ["2019", "2019/20", false],
        ["2018", "2018/19", false],
        ["2017", "2017/18", false],
        ["2016", "2016/17", false],
        ["2015", "2015/16", false],
        ["2014", "2014/15", false],
        ["2013", "2013/14", false],
        ["2012", "2012/13", false],
        ["2011", "2011/12", false],
        ["2010", "2010/11", false],
        ["2009", "2009/10", false],
        ["2008", "2008/09", false],
        ["2007", "2007/08", false],
        ["2006", "2006/07", false],
        ["2005", "2005/06", false],
        ["2004", "2004/05", false],
        ["2003", "2003/04", true],
        ["2002", "2002/03", false],
        ["2001", "2001/02", false],
        ["2000", "2000/01", false],
        ["1999", "1999/00", false],
        ["1998", "1998/99", false],
        ["1997", "1997/98", false],
        ["1996", "1996/97", false],
        ["1995", "1995/96", false],
        ["1994", "1994/95", false],
        ["1993", "1993/94", false],
        ["1992", "1992/93", false],
        ["1991", "1991/92", false],
        ["1990", "1990/91", false],
        ["1989", "1989/90", false],
        ["1988", "1988/89", false],
        ["1987", "1987/88", false],
        ["1986", "1986/87", false],
        ["1985", "1985/86", true],
        ["1984", "1984/85", true],
        ["1983", "1983/84", true],
        ["1982", "1982/83", true],
        ["1981", "1981/82", true],
        ["1980", "1980/81", true],
        ["1979", "1979/80", true],
        ["1978", "1978/79", true],
        ["1977", "1977/78", false],
        ["1976", "1976/77", false],
        ["1975", "1975/76", true],
        ["1974", "1974/75", true],
        ["1973", "1973/74", false],
        ["1972", "1972/73", false],
        ["1971", "1971/72", false],
        ["1970", "1970/71", false],
        ["1969", "1969/70", false],
    ]

document.write('<section id="yearnav"><div class="container">')

i = 0
for (var a = 0; a < year1.length; a++) {
    if (i % 10 === 0) {
        document.write('<nav class="navbar navbar-expand-sm navbar-light justify-content-center"><ul class="navbar-nav">')
    }

    if (year1[a][2]) {
        document.write('<li class="nav-item"><a class="nav-link disabled" href="#nav' + year1[a][0] + '">' + year1[a][1] + '</a></li>')
    } else {
        document.write('<li class="nav-item"><a class="nav-link" href="#nav' + year1[a][0] + '">' + year1[a][1] + '</a></li>')
    }

    if (i % 10 === 9) {
        document.write('</ul></nav>')
    }
    i++
}
document.write('</div></section>')