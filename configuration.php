<?php
 

header("Access-Control-Allow-Origin: *");
$pwrd = 'password123';

$db = 'proposals';

$host = 'localhost';

$usn = 'admin';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usn, $pwrd);
?>