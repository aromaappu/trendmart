<?php

$hostname = "localhost";
$username = "root";
$password = "aromal0497h";
$db_name = "trend";

$conn = mysqli_connect($hostname,$username,$password,$db_name); 

if(!$conn){
    echo"connection succes";
}
?>