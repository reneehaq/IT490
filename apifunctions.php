
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
session_start();
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
function searchByCriteria($criteria){
  ini_set("allow_url_fopen", 1);

  $url = "http://quotes.rest/qod.json?category=$criteria";

  $data = file_get_contents($url);
  echo $data;

  return $data;
}
function qoD(){
  ini_set("allow_url_fopen", 1);

  $url = "http://quotes.rest/qod.json";

  $data = file_get_contents($url);
  echo $data;

  return $data;
}
function submitQ($quote, $category, $author){
  ini_set("allow_url_fopen", 1);

  $url = "http://quotes.rest/quote.json?quote=$quote&author=$author&tags=$category";

  $data = file_get_contents($url);
  echo $data;

  return $data;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "criteria":
      return searchByCriteria($request['criteria']);
    case "qod":
      return qoD();
    case "submitq":
      return submitQ($request['quote'],$request['category'],$request['author']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("testRabbitMQ.ini","apiServer");
$server->process_requests('requestProcessor');
exit();
?>
