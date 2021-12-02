<?php
 

header("Access-Control-Allow-Origin: *");
$pwrd = 'password123';

$db = 'bugme';

$host = 'localhost';

$usn = 'admin';


$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usn, $pwrd);
?>