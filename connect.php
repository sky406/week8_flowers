<?php

$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "week8_flowers"; 

//this should be chanages when being copied the rest can remain the same

// if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
//     die("failed to connect");
// }

// 

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// check connection
if(!$conn) {
    die("connection failed:".mysqli_connect_error());
}

echo "connected successfuly";

?>