<?php

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

session_start(); 
if (!isset($_SESSION['email']))
   {
   // echo "no SESSION CREATED GO TO LOGIN";
   header('Location: sitfailurelogin.php'); 
   exit();
   }
$_SESION = array();  // clear the variables
session_destroy();  // destroy the session

?>

 <html>
   <head>
       <title>Jammerz Login</title>
      <link href="sitfailureroot.css" rel="stylesheet" type="text/css" />
  
   </head>
   <body bgcolor="black">
          <br />   <BR /> <BR /> 

     <form method="post" action="sitfailurelogin.php">
  <center>

  <font size=6 color="cyan">SIT Failures<br /> <br /></font> </td>
 
  <font size=4 color="red">You have successfully Logged out <br /> <br /></font> </td>
           
 <a href="../../index.php"><font size=3 >|MAIN| </font> </a><br /> <br />

 <table>
    <tr>
          <td>  
    </tr>
    <tr><td> </td></tr>
    <tr>
      <td>  <font size=6 color="yellow">User: </font> </td><td> <input name="email" type="text" maxlength="25" size=25 /></td>
    </tr>
 
    <tr>
    <td> <font size=6 color="yellow"> Password: </font> </td><td> <input name="pass" type="password" maxlength="40" size=25 />
    <br />
    </td>
    </tr>
     
    <tr><td></td>  <td><br />
  <input type="submit" value="Login" style="height: 30px; width: 100px; font-size:100%" /> <br />
  </td></tr> 
   </table><BR />


  </center>

<BR />
<BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />
<font size=2 color="green">created by: meloyski@hotmail.com </font><br />
<table >
<tr><td>
<!--
<img src="apache_pb.gif" height=30 width=100 >&nbsp<img src="Mysql Icon1.gif" height=30 width=45 >&nbsp<img src="icon-php.jpg" height=30 width=45 >
/-->
</td></tr>
</table>
 </form>


   </body>
 </html>

