$(document).ready(function () {

    var menuData = getMenuJSON()
    var openPath = buildOpenPath(menuData);

    buildMenu(menuData, openPath)
    buildBreadcrumb(openPath);
});

function buildMenu(menuData, openPath) {

    var currentParents = [];
    var pendingSeparator = null;

    $.each(menuData, function (key, val) {
        currentParents[val.level] = val
        var shown = isMatchedParents(currentParents, openPath, val.level);

        if (shown) {
            var indent = buildIndent(val.level);
            var id = buildId(val.url);
            var bullet = buildBullet(val.bullet, val.url);

            if (pendingSeparator != null && bullet == '') {
                $(menu).append(pendingSeparator);
                pendingSeparator = null;
            }

            $(menu).append('<div id="menuItem">' + indent + bullet + '<a ' + id + ' href="' + val.url + '" >' + val.text + ' </a> </div>');
            pendingSeparator = '<div id="menuSeparator"> </div >';
        }
    });
}

function buildBreadcrumb(openPath) {
    if ($('#breadcrumb').length) {
        $(breadcrumb).append('<a href="index.htm">Home</a>');

        $.each(openPath, function (key, val) {
            $(breadcrumb).append('&nbsp;&gt;&nbsp;');
            $(breadcrumb).append('<a href="' + val.url + '" >' + val.text + ' </a>');
            if (document.URL.endsWith(val.url)) {
                return false;
            }
        });
    }
}

// build the path of menu nodes that form the parent of the current one. 
function buildOpenPath(menuData) {
    var openPath = [];
    var openPathTemp = [];

    $.each(menuData, function (key, val) {
        openPathTemp[val.level] = val
        if (document.URL.endsWith(val.url)) {
            openPath = jQuery.extend({}, openPathTemp);
        }
    });
    return openPath;
}

function buildIndent(level) {
    var indent = '';
    for (i = 0; i < level; i++) {
        indent += '&nbsp;&nbsp;&nbsp;'
    }
    return indent;
}

function isMatchedParents(currentParents, openPath, level) {
    var matchedParents = true;
    for (i = 0; i < level; i++) {
        if (currentParents[i] != openPath[i]) {
            matchedParents = false;
            break;
        }
    }
    return matchedParents
}

function buildId(url) {
    return ((document.URL.endsWith(url)) ? 'id="menuNavSelected"' : 'id="menuNav"');
}

function buildBullet(bullet, url) {
    if (bullet == false) return '';

    return '<img src="images/' + ((document.URL.endsWith(url)) ? 'bullet_selected.gif' : 'bullet.gif') + '" width="9" height="14"/>&nbsp;';
}


function getMenuJSON() {
    var json =

        [
            {
                "text": "Home",
                "url": "index.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "50th Dinner Day",
                "url": "50thDinnerDay.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "Events",
                "url": "events.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "Ringing",
                "url": "practises.html",
                "bullet": false,
                "level": 0
            },
            {
                "text": "Spurriergate",
                "url": "spurriergate.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "St Lawrences",
                "url": "stLawrences.html",
                "bullet": true,
                "level": 1
            },


            {
                "text": "Quotes",
                "url": "quotes.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "Committee",
                "url": "committeeCurrent.html",
                "bullet": false,
                "level": 0
            },
            {
                "text": "Current",
                "url": "committeeCurrent.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2019/20",
                "url": "committee19_20.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2018/19",
                "url": "committee18_19.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2017/18",
                "url": "committee17_18.html",
                "bullet": true,
                "level": 1
            },

            {
                "text": "Bob the Badger",
                "url": "bob.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "History",
                "url": "history.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "Peals and Quarters",
                "url": "pealsQuarters.html",
                "bullet": false,
                "level": 0
            },
            {
                "text": "2019/20",
                "url": "qp2019_20.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2018/19",
                "url": "qp2018_19.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2017/18",
                "url": "qp2017_18.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2016/17",
                "url": "qp2016_17.html",
                "bullet": true,
                "level": 1
            },
            {
                "text": "2015/16",
                "url": "qp2015_16.html",
                "bullet": true,
                "level": 1
            },

            {
                "text": "Older Quarters",
                "url": "qp2014_15.html",
                "bullet": true,
                "level": 1
            },

            {
                "text": "2014/15",
                "url": "qp2014_15.html",
                "bullet": true,
                "level": 2
            },

            {
                "text": "Gallery",
                "url": "gallery.html",
                "bullet": false,
                "level": 0
            },

            {
                "text": "Contact Us",
                "url": "contact.html",
                "bullet": false,
                "level": 0
            },
        ]

    return json;
}
