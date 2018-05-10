<?php
session_start();
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
//if (!isset($_SESSION["user"])){
 //header( "Refresh:1; url=login.html", true, 303);
 //}
include ('testRabbitMQClient.php');
$quote=$_GET['quote'];
$response =save($quote,$_SESSION["user"]);
if($response == true ){
header( "Refresh:1; url=favourite.php", true, 303);
}
?>
