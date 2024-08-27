<?php

require_once 'secrets.php';

$googleApiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $apiKey . '&units=metric&lang=nl';
?>

<!doctype html>
<html>

<head>
    <title>Kan ik met een dikke kont een korte broek aan?</title>
</head>

<body>
    <div class="canvas">
        <div class="inner-canvas">
            <h1 id="title"></h1>
            <p id="text"></p>
            <div id="feels-like"></div>
            <div id="temperature"></div>
            <div id="wind-speed"></div>
            <div id="wind-gust"></div>
            <div id="visibility"></div>
        </div>
        <img id="yes" class="img" src="./yes.webp" alt="ja">
        <img id="no" class="img" src="./no.webp" alt="nee">
    </div>

    <div id="footer"><a href="https://zegert.nl">zegert.nl</a></div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var feels_like = 0;
var wind_speed = 0;
var wind_gust = 0;
var visibility = 0;
$.ajax({
    type: "POST",
    url: '<?= $googleApiUrl ?? '' ?>',
    dataType: "json",
    success: function(result, status, xhr) {


        if (result.main.feels_like > 20 && 
            result.wind.speed < 10 && 
            result.wind.gust < 20 && 
            result.visibility > 8000) {
            document.getElementById("yes").style.display = "block";
            document.getElementById("title").innerHTML = "Ja!";
            document.getElementById("text").innerHTML = "Je kan met een dikke kont een korte broek aan.";
        } else {
            document.getElementById("no").style.display = "block";
            document.getElementById("title").innerHTML = "Brr, Nee!";
            document.getElementById("text").innerHTML = "Je kan met een dikke kont geen korte broek aan.";
        }

        document.getElementById("feels-like").innerHTML = "Gevoelstemperatuur: " + result.main.feels_like + "°C";
        document.getElementById("temperature").innerHTML = "Min. temp.: " + result.main.temp_min + "°C - max. temp.: " + result.main.temp_max + "°C";
        document.getElementById("wind-speed").innerHTML = "Windsnelheid: " + result.wind.speed + " km/h";
        document.getElementById("wind-gust").innerHTML = "Windstoten: " + result.wind.gust + " km/h";
        document.getElementById("visibility").innerHTML = "Zicht: " + result.visibility / 1000 + " km";
    },
});
</script>

<style>
@font-face {
  font-display: optional;
  font-family: "Montserrat";
  font-style: normal;
  font-weight: 300;
  src: url("./fonts/montserrat-v25-latin-300.eot");
  src: url("./fonts/montserrat-v25-latin-300.eot?#iefix") format("embedded-opentype"), url("./fonts/montserrat-v25-latin-300.woff2") format("woff2"), url("./fonts/montserrat-v25-latin-300.woff") format("woff"), url("./fonts/montserrat-v25-latin-300.ttf") format("truetype"), url("./fonts/montserrat-v25-latin-300.svg#Montserrat") format("svg");
}
.canvas {
  font-family: "Montserrat", "Roboto", sans-serif;
  font-weight: 500;
}
.canvas img {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  -o-object-fit: cover;
     object-fit: cover;
}
.canvas .inner-canvas {
  position: absolute;
  top: 30%;
  left: 30%;
  right: 30%;
  width: auto;
  height: auto;
  padding: 20px;
  z-index: 10;
  background-color: rgba(255, 255, 255, 0.6);
  border-radius: 25px;
  text-align: center;
}
.canvas .inner-canvas h1 {
  font-weight: 600;
}
@media (max-width: 768px) {
  .canvas .inner-canvas {
    top: 10% !important;
    left: 10% !important;
    right: 10% !important;
  }
}

#footer {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 10;
  text-align: center;
  padding: 20px;
  font-size: 12px;
  color: #b9134f;
}
#footer a {
  color: #b9134f;
}
#footer a:hover {
  color: #b9134f;
  text-decoration: none;
}
</style>

</html>
