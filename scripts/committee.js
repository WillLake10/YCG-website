var committee = [
    ['Current', ['Chairperson', 'Rosie Hall'], ['Treasurer', 'Rebecca Hall'], ['Secretary', 'Will Lake'], ['Towerbell Master', 'Rosie Hall'], ['Deputy Towerbell Master', 'Will Lake'], ['Handbell Master', 'Zoe Duffin'], ['Social Secretary', 'Zoe Duffin'], ['Webmaster', 'Will Lake']],
    ['2019', ['Chairperson', 'Simon Cumming'], ['Treasurer', 'Will Lake'], ['Secretary', 'Rosie Hall'], ['Towerbell Master', 'Simon Cumming'], ['Deputy Towerbell Master', 'Rosie Hall'], ['Handbell Master', 'Zoe Duffin'], ['Social Secretaries', 'Caroline Crang & Millie Fletcher'], ['Webmaster', 'Will Lake']],
    ['2018', ['Chairperson', 'Michaela Kucerova'], ['Treasurer', 'Simon Cumming'], ['Secretary', 'Georgie Hunt'], ['Towerbell Master', 'Claire Reading'], ['Handbell Master', 'Billy Brooke'], ['Social Secretaries', 'Holly Barrett & Caitlin Turpin']],
    ['2017', ['Chairperson', 'Billy Brooke'], ['Treasurer', 'Caitlin Turpin'], ['Secretary', ' Holly Barrett'], ['Towerbell Master', 'Billy Brooke'], ['Handbell Master', 'Emily Jones'], ['Social Secretaries', 'Sam Turner & Michaele Kucerova']],
];

for (var i = 0; i < committee.length; i++) {
    document.write('<div class="col-md-6"><div class="head_title">')
    document.write(committee[i][0])
    document.write('</div>')
    for (var j = 1; j < committee[i].length; j++) {
        document.write('<p><span class="quotesName">' + committee[i][j][0] + ': </span>')
        document.write('<span class="quotesBody">' + committee[i][j][1] + '</span></p>')
    }
    document.write('</div>')
}