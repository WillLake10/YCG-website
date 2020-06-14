/*
Website: York Colleges Guild
Type: Menu Generation Code
Created: 19th April 2020
Last modified: 20th April 2020
Author: Will Lake
 */

var path = window.location.pathname;
var page = path.split("/").pop();

var pageaddresses = [
    ['index.html', 'Home'],
    ['events.html', 'Events'],
    ['ringing.html', 'Ringing'],
    ['outings.html', 'YCG Outings'],
    ['quotes.html', 'Quotes'],
    ['committee.html', 'YCG Committee'],
    ['bob.html', 'Bob the Badger'],
    ['history.html', 'History'],
    ['pealsQuarters.html', 'Peals and Quarters'],
    //['gallery.html', 'Gallery'],
    ['contact.html', 'Contact Us'],
];

document.write('<nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top">');

document.write('<a class="navbar-brand" href="index.html">');
document.write('<img src="images/ycg_logo/ycg_logo_navbar.png" alt="Logo" style="width:50px;">');
document.write('</a>');

document.write('<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">')
document.write('<span class="navbar-toggler-icon"></span>')
document.write('</button>')
document.write('<div class="collapse navbar-collapse" id="collapsibleNavbar">')
document.write('<ul class="navbar-nav">');


for (var i = 0; i < pageaddresses.length; i++) {
    if (pageaddresses[i][0].localeCompare(page) === 0) {
        document.write('<li class="nav-item active">');
    } else{
        document.write('<li class="nav-item">');
    }
    document.write('<a class="nav-link" href="' + pageaddresses[i][0] + '">' + pageaddresses[i][1] + '</a>');
    document.write('</li>');
}

document.write('</ul>');
document.write('</div>')
document.write('</nav>');

