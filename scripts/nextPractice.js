var n = 0;
var disc

const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

console.log((ALL_EVENTS))
ALL_EVENTS.forEach(function (event) {
    console.log(event)
    if (event.practice === true && n === 0) {
        console.log("Event Found: " + event.title)
        var sDate = new Date(event.startDate)
        document.write('<p>What - ' + event.title + '</p><p>Where - ' + event.location.substr(0, getPosition(event.location, ",", 2)) + '</p><p>When - ' + tim24hourTo12hour(sDate.getTime()) + '</p>');
        n = 1
    }
})

if (n === 0) {
    document.write('<p>What - No Practice for now</p><p>Where - </p><p>When - </p>');
}

function tim24hourTo12hour(time) {
    var dateTime = new Date(time)
    let hours = dateTime.getHours()
    console.log(dateTime.getMinutes())
    if (hours > 12) {
        hours -= 12;
        hours = hours + ":" + pad(2, dateTime.getMinutes()) + "pm, "
    } else if (dateTime.getHours() === 0) {
        hours = hours + "12:" + pad(2, dateTime.getMinutes()) + "am";
    } else if (dateTime.getHours() === 12) {
        hours = hours + "12:" + pad(2, dateTime.getMinutes()) + "pm";
    } else {
        hours = hours + ":" + pad(2, dateTime.getMinutes()) + "am, "
    }
    console.log(hours)
    hours = hours + dayOfWeek(dateTime.getDay()) + " " + dateTime.getDate() + getEnd(dateTime.getDate())
    hours = hours + " " + monthNames[dateTime.getMonth()]
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