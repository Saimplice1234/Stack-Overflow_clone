<?php

session_start();
$_SESSION['login']="false";
$_SESSION['userEmail']="";
header("Location:./home.php");

?>