<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "spk-toyota";

$connection = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($connection));
  // $connection = mysqli_connect($server, $user, $pass, $database);

  // if (!$connection) {
  //     die("Connection failed: " . mysqli_connect_error());
  // }
  // echo "Connected successfully";
  // mysqli_close($connection);
?>