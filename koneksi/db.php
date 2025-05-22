<?php 

$host = "localhost";
$username = "root"; 
$password = "";
$db = "kuisweb2";

$conn = mysqli_connect($host, $username, $password, $db);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

?>