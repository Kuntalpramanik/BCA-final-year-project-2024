<?php
session_start();
$host='localhost';
$user='root';
$pass='';
$db='';

$con=mysqli_connect($host, $user, $pass);
mysqli_select_db($con,$db)or die(mysqli_error($con));

?>