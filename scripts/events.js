var n = 0

const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];

console.log(ALL_EVENTS)
ALL_EVENTS.forEach(function (event) {
    console.log(event.discription)
    disc = event.discription

    var sDate = new Date(event.startDate)
    var eDate = new Date(event.endDate)
    if (!event.description.includes("!null")) {
        n = n + 1
        document.write('<li><time datetime="' + sDate.getFullYear() + '-' + sDate.getMonth() + '-' + sDate.getDate() + ' ' + sDate.getHours() + sDate.getMinutes() + '">')
        document.write('<span class="day">' + sDate.getDate() + '</span>')
        document.write('<span class="month">' + monthNames[sDate.getMonth()] + '</span>')
        document.write('<span class="year">' + sDate.getFullYear() + '</span>')
        document.write(' <span class="time">' + sDate.getHours() + ':' + sDate.getMinutes() + '</span>')
        document.write('</time><div class="info">')
        document.write('<h2 class="title">' + event.title + '</h2>')
        document.write('<p class="desc"><span class="text-ycgGreen">Where:</span> ' + event.location.substr(0, getPosition(event.location, ",", 2)) + '</p>')
        document.write('<p class="desc"><span class="text-ycgGreen">When:</span> ' + tim24hourTo12hour(sDate.getTime(), 1) + " - " + tim24hourTo12hour(eDate.getTime(), 2) + '</p>')
        document.write('<p class="desc"><span class="text-ycgGreen">What:</span> ' + event.description + '</p>')
        document.write('</div></li>')
    }
})

if (n === 0) {
    document.write('<h2>No Events Upcoming</h2>');
}

function tim24hourTo12hour(time, run) {
    var dateTime = new Date(time)
    var hours = ""
    if (run === 2) {
        hours = ""
    } else {
        hours = dayOfWeek(dateTime.getDay()) + ", "
    }
    if (dateTime.getHours() > 12) {
        hours = hours + (dateTime.getHours() - 12) + ":" + pad(2, dateTime.getMinutes()) + "pm"
    } else if (dateTime.getHours() === 0) {
        hours = hours + "12:" + pad(2, dateTime.getMinutes()) + "am";
    } else if (dateTime.getHours() === 12) {
        hours = hours + "12:" + pad(2, dateTime.getMinutes()) + "pm";
    } else {
        hours = hours + dateTime.getHours() + ":" + pad(2, dateTime.getMinutes()) + "am"
    }
    return hours
}

function dayOfWeek(day) {
    if (day === 0) {
        return "Sunday"
    } else if (day === 1) {
        return "Monday"
    } else if (day === 2) {
        return "Tuesday"
    } else if (day === 3) {
        return "Wednesday"
    } else if (day === 4) {
        return "Thursday"
    } else if (day === 5) {
        return "Friday"
    } else {
        return "Saturday"
    }
}

function getEnd(day) {
    if (day > 3 && day < 21) return 'th';
    switch (day % 10) {
        case 1:
            return "st";
        case 2:
            return "nd";
        case 3:
            return "rd";
        default:
            return "th";
    }
}

function getPosition(string, subString, index) {
    return string.split(subString, index).join(subString).length;
}

function pad(size, number) {
    var s = String(number);
    while (s.length < (size || 2)) {
        s = "0" + s;
    }
    return s;
}