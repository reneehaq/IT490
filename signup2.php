<?php
error_reporting(-1);
ini_set('display_errors', true);
include ('client.php');
$email = mysqli_real_escape_string($db, $_POST['email']);
$user = mysqli_real_escape_string($db, $_POST['user']);
$password = mysqli_real_escape_string($db, $_POST['password']);
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
