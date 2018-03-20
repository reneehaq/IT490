<?php
error_reporting(-1);
ini_set('display_errors', true);
include ('client.php');
$user = $_POST['user'];
$password = $_POST['password'];
$response = login($user,$pass);
if($response == false)
  {
    echo "Unauthorized";
  }
  else
  {
  echo "Authorized";
  }
?>
