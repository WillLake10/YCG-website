<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Who have I rung with</title>
</head>
<body>
<h1>Who have I rung with</h1>
<input id="numb">
<button type="button" onclick="myFunction()">Submit</button>
<p id="demo"></p>
</body>
<script>
    function myFunction() {
        fetch('https://bb.ringingworld.co.uk/search.php?place=york&pagesize=20000', {
            method: 'GET',
            headers: {
                'Access-Control-Allow-Origin': 'https://www.ycg.org.uk'
            },
        })
            .then(response => text = response)
            .then(response => console.log(response))
            .catch(err => console.error(err));

        document.getElementById("demo").innerHTML = text;
    }
</script>
</html>