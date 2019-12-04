<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 2019-12-02
 * Time: 14:14
 */

$apiKey = "&appid=4ca32f819be8e3856fafa857fbf628e5";
$city= "Amsterdam";
$input = "";
$imageIconPart1 = "http://openweathermap.org/img/wn/";
$imageIconPart3 = "@2x.png";
date_default_timezone_set("Europe/Brussels");


//unset($_GET['input-button']);




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Weatherforecast on the whole planet</title>
    <meta charset= "utf-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content= "">
    <meta name ="keywords" content = "Meta Tags, Metadata" />
    <meta name ="author" content = "Danny Eeraerts"/>
    <link href="DDWeather.css" rel="stylesheet">
    <link href="css/weather-icons-wind.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.6.3/css/all.css" >

  </head>

<body>
  <div class= "wrapper">
    <h1>worldwide weather forecast</h1>
    <main>

      <form class="form-inline text-center first-child"  role="form" id="searchform" action="" method="get">

              <div class="form-group">
                <label class="sr-only" for="help-search">Find weather conditions for:</label>
                <br>
                <input id="input" name="inputText" class="city-input" placeholder="London,uk">
              </div>
              <button  name = "sendbutton" class="weather-button" value="Submit">Find out NOW!</button>
      </form>
        <?php

        function ConvertWindDeg($windDegree){

            if($windDegree >= 349 && $windDegree <= 11){
                return "N";
            } else if ($windDegree >= 12 && $windDegree <= 33) {
                return "NNE";
            } else if ($windDegree >= 34 && $windDegree <= 56) {
                return "NE";
            } else if ($windDegree >= 57 && $windDegree <= 78) {
                return "ENE";
            } else if ($windDegree >= 79 && $windDegree <= 101) {
                return "E";
            } else if ($windDegree >= 102 && $windDegree <= 123) {
                return "ESE";
            } else if ($windDegree >= 124 && $windDegree <= 146) {
                return "SE";
            } else if ($windDegree >= 147 && $windDegree <= 168) {
                return "SSE";
            } else if ($windDegree >= 169 && $windDegree <= 191) {
                return "S";
            } else if ($windDegree >= 192 && $windDegree <= 213) {
                return "SSW";
            } else if ($windDegree >= 214 && $windDegree <= 236) {
                return "SW";
            } else if ($windDegree >= 237 && $windDegree <= 258) {
                return "WSW";
            } else if ($windDegree >= 259 && $windDegree <= 281) {
                return "W";
            } else if ($windDegree >= 282 && $windDegree <= 303) {
                return "WNW";
            } else if ($windDegree >= 304 && $windDegree <= 326) {
                return "NW";
            } else if ($windDegree >= 327 && $windDegree <= 348) {
                return "NNW";
            }
            /*switch ($windDegree) {
                case ($windDegree >= 349 && $windDegree <= 11):
                    return "N";
                    break;
                case ($windDegree >= 12 && $windDegree <= 33):
                    return "NNE";
                    break;
                case ($windDegree >= 34 && $windDegree <= 56):
                    return "NE";
                    break;
                case ($windDegree >= 57 && $windDegree <= 78):
                    return "ENE";
                    break;
                case ($windDegree >= 79 && $windDegree <= 101):
                    return "E";
                    break;
                case ($windDegree >= 102 && $windDegree <= 123):
                    return "ESE";
                    break;
                case ($windDegree >= 124 && $windDegree <= 146):
                    return "SE";
                    break;
                case ($windDegree >= 147 && $windDegree <= 168):
                    return "SSE";
                    break;
                case ($windDegree >= 169 && $windDegree <= 191):
                    return "S";
                    break;
                case ($windDegree >= 192 && $windDegree <= 213):
                    return "SSW";
                    break;
                case ($windDegree >= 214 && $windDegree <= 236):
                    return "SW";
                    break;
                case ($windDegree >= 237 && $windDegree <= 258):
                    return "WSW";
                    break;
                case ($windDegree >= 259 && $windDegree <= 281):
                    return "W";
                    break;
                case ($windDegree >= 282 && $windDegree <= 303):
                    return "WNW";
                    break;
                case ($windDegree >= 304 && $windDegree <= 326):
                    return "NW";
                    break;
                case ($windDegree >= 327 && $windDegree <= 348):
                    return "NNW";
                    break;*/
            }

            if(isset($_GET['sendbutton'])){ //check if form was submitted
                $input = $_GET['inputText']; //get input text
                //echo $input;
                if (!empty($input)) {
                    $ApiUrl = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?q=" . $input . $apiKey);
                    $ApiData = json_decode($ApiUrl);
                    //var_dump($ApiData);
                    //echo $ApiData->list[0]->dt_txt;
                    $lenght = count($ApiData->list);
                    echo "<h2>weather next 5 days for <h1>".$input."</h1></h2>"
                ?>
                <?php
                    $j=1;
                    for ($i=0; $i<$lenght; $i+=8){
                        $date = $ApiData->list[$i]->dt_txt;
                        $newDate = date("d-m-Y H:i:s", strtotime($date));
                        if (date('l', strtotime($newDate)) == date('l')){
                            $weekDate = "Today";
                        }
                        else {
                            $weekDate = date('l', strtotime($newDate));
                        }
                        ?>
                      <div class = "weather-card">
                        <div class="top">
                          <h3 class="day-time">
                            <strong class="daytime"><?php echo $weekDate."&nbsp;".$newDate; ?></strong>
                          </h3>
                          <?php $sourceIcon = $ApiData->list[$i]->weather[0]->icon;
                          $weatherSourceIcon= $imageIconPart1.$sourceIcon.$imageIconPart3;
                          //echo $weatherSourceIcon; ?>
                          <img src = "<?php echo $weatherSourceIcon;?>" class ="wheater-icon" alt="weather-icon">
                          <?php $weatherDescription = $ApiData->list[$i]->weather[0]->description;?>
                          <p class="wheater-description"><?php echo strval($weatherDescription); ?></p>
                        </div>
                          <?php $minTemp = $ApiData->list[$i]->main->temp_min - 273.15;
                          $lowTemperatureIcon= "<i class=\"far fa-temperature-low\"></i>"?>
                        <div class = "details">
                          <p class="wheater-min-temperature"><?php echo "Min-temp: ".$lowTemperatureIcon.round($minTemp,2). " C°"; ?></p>
                          <?php $maxTemp = $ApiData->list[$i]->main->temp_max - 273.15;
                          $highTemperatureIcon= "<i class='far fa-temperature-high'></i>"?>
                          <p class="wheater-max-temperature"><?php echo "Max-temp: ".$highTemperatureIcon. round($maxTemp,2). " C°"; ?></p>
                          <?php $humidity = $ApiData->list[$i]->main->humidity;
                          $humidityIcon = "<i class=\"far fa-humidity\"></i>"?>
                          <p class="wheater-humidity"><?php echo "Humidity: ".$humidityIcon.round($humidity,2); ?></p>
                          <?php $windDegree = $ApiData->list[$i]->wind->deg;
                          $windDirection = ConvertWindDeg($windDegree);
                          $windArrowDirection = strtolower($windDirection);
                          $arrow = "<i class = 'wi wi-wind wi-from-$windArrowDirection'>"."</i>";
                          ?>
                          <p class="wheater-winddirection"><?php echo "Winddirection: ".$arrow." ". $windDirection ?></p>
                          <?php  $windSpeed = $ApiData->list[$i]->wind->speed * 3.6;?>
                          <p class="wheater-windspeed"><?php echo "Windspeed: ". intval( $windSpeed)." km/h"; ?></p>
                          <?php  $pressure = $ApiData->list[$i]->main->pressure;?>
                          <p class="wheater-pressure"><?php echo "Air pressure: ". intval( $pressure)." bar"; ?></p>
                          <?php
                          $latitude = $ApiData->city->coord->lat;
                          $longitude = $ApiData->city->coord->lon;
                          $currenttime =time() + ($j* 24 * 60 * 60);
                          $sunsetIcon = "<i class='fal fa-sunset''></i>";
                          $sunriseIcon ="<i class='fal fa-sunrise'></i>"?>
                          <p class="wheater-windspeed"><?php echo "Sunrise:". $sunriseIcon. (date_sunrise($currenttime,SUNFUNCS_RET_STRING,$latitude,$longitude)); ?></p>
                          <p class="wheater-rain"><?php echo "Sundown:".$sunsetIcon.(date_sunset($currenttime,SUNFUNCS_RET_STRING,$latitude,$longitude)); ?></p>
                        </div>
                      </div>
                        <?php
                          echo"</br>";
                          $j++;
                    }
                }
                else {
                  {
                    echo "No results, enter a new city";
                  }
                }
            }
        ?>
      </main>
    </div>

</body>
</html>
