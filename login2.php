<?php
error_reporting(-1);
ini_set('display_errors', true);
include ('client.php');
$user = mysqli_real_escape_string($db, $_POST['user']);
$password = mysqli_real_escape_string($db, $_POST['password']);
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
