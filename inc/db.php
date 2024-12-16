<?php 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "foody";


$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die('Connection failed'); 
} 