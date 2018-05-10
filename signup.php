<?php
session_start();
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
include ('testRabbitMQClient.php');
$user = $_POST['user'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$response = register($email,$user,$password);
if($response == true)
  {
    echo "Registered";
    header( "Refresh:1; url=login.html", true, 303);
  }
  else
  {
  echo "Unable To Register";
  header( "Refresh:1; url=signup.html", true, 303);
  }
?>
