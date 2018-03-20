<?php
error_reporting(-1);
ini_set('display_errors', true);
include ('client.php');
$email = $_POST['email'];
$user = $_POST['user'];
$password = $_POST['password'];
$response = register($email,$user,$password);
if($response == true)
  {
    echo "Registered";
  }
  else
  {
  echo "Unable To Register";
  }
?>
