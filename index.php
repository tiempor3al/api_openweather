<?php  
require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

//El APPID de OpenWeather se debe definir como una variable de entorno en Windows.
//Le pusimos appid, y la leemos
$appid = getenv("appid");

$app->get('/', function() use($app,$appid) {
 return "API v1.0 using APPID: $appid";
});

$app->get('/clima', function() use($app,$appid) {
  
  
  $client = new \GuzzleHttp\Client();
  $url = "https://api.openweathermap.org/data/2.5/weather?id=3530597&APPID=$appid&units=metric";
  $res = $client->request('GET',$url);
  return $res->getBody();
});


//Recibe como parámetros la latitud y longitud de la aplicación en Android
$app->get('/clima/{lat}/{lon}', function($lat, $lon) use($app,$appid) {
  
  
  $client = new \GuzzleHttp\Client();
  $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&APPID=$appid&units=metric";
  $res = $client->request('GET',$url);
  return $res->getBody();
});
 
$app->run();
?>