#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include ('credentials.php');
function auth($user, $password) {
    ( $db = mysqli_connect ( 'localhost', 'root', 'Subhank1', 'credentials' ) );
    if (mysqli_connect_errno())
    {
      echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL<br><br>";
    mysqli_select_db($db, 'credentials' );
    $s = "select * from users where username = '$user' and password = '$password'";
    //echo "The SQL statement is $s";
    ($t = mysqli_query ($db,$s)) or die(mysqli_error());
    $num = mysqli_num_rows($t);
    if ($num == 0){
      return false;
    }else
    {
      print "<br>Authorized";
      return true;
    }
}
function register($email,$user,$password) {
    ( $db = mysqli_connect ( 'localhost', 'root', 'Subhank1', 'credentials' ) );
    if (mysqli_connect_errno())
    {
      echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL<br><br>";
    mysqli_select_db($db, 'userLogin' );
    $s = "insert into users(email,username,password) values('$email','$user','$password')";
    //echo "The SQL statement is $s";
    ($t = mysqli_query ($db,$s)) or die(mysqli_error());
    print "Registered";
    return true;

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
        case "login":
          return auth($request['username'],$request['password']);
        case "validate_session":
          return doValidate($request['sessionId']);
        case "register":
          return register($request['email'],$request['username'],$request['password']);

      }
      return array("returnCode" => '0', 'message'=>"Server received request and processed");
    }
    $server = new rabbitMQServer("testRabbitMQ.ini","testServer");
    $server->process_requests('requestProcessor');
    exit();
 }
?>
