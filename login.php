<?php
session_start();
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
include ('testRabbitMQClient.php');


$user = $_POST['user'];
$password = sha1($_POST['password']);
$response = login($user,$password);
if($response == false)
  {
    echo "Unauthorized";
    header( "Refresh:1; url=login.html", true, 303);
  }
  else
  {
  echo "Authorized";
  $_SESSION['user'] = $user;
  header( "Refresh:1; url=generator.php", true, 303);
  }



?>
