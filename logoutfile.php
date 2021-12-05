<?php 
include('configuration.php');
session_start();
unset($_SESSION["user"]);
session_destroy();
header("Location : loginInterface.php");
exit()
?>