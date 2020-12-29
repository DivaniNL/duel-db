<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a id="click"><canvas id ="myCanvas" width= "200" height= "200"></canvas></a>
<script>
var button = document.getElementById('click');
var canvas = document.getElementById('myCanvas');
button.addEventListener('click', function (e) {
    var dataURL = canvas.toDataURL('image/png');
    button.href = dataURL;
});
</script>
</body>
</html>