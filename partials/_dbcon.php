<?php
$host="localhost";
$r="root";
$password="";
$database="forum";

$con=mysqli_connect($host,$r,$password,$database);
if(!$con){
    die("Error");
}
?>