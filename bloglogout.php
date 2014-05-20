<?php

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

session_start(); 
if (!isset($_SESSION['email']))
   {
   // echo "no SESSION CREATED GO TO LOGIN";
   header('Location: jamzbloglogin.html'); 
   exit();
   }
$_SESION = array();  // clear the variables
session_destroy();  // destroy the session

header('Location: jamzbloglogin.html');


?>

 