<?php
 


$pwrd = 'password123';

$db = 'bugme';

$host = 'localhost';

$usn = 'admin';


$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usn, $pwrd);
?>

    <!-- THIS IS USED TO GRANT PRIVELLEGES TO USER IN DATABASE  -->
<!-- GRANT ALL PRIVILEGES ON bugme.* TO 'admin'@'localhost' 
IDENTIFIED BY 'password123'; -->