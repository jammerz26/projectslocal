<?php


// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");


// MySQL login values 
$username = "root";
$password = "jammerz";
$host = "localhost";
$database = "blogusers";


$mail=$_POST['email'];
$passwrd=$_POST['pass'];




if (!$mail || !$passwrd) 
{
// echo "You have not entered all the required details.<br />"
// ."Please go back and try again.";

 ?> 

 <html>
   <head>
       <title>jamz Blog Login</title>
      <link href="jamzblog.css" rel="stylesheet" type="text/css" />
  
   </head>
   <body >
     <br /><BR /><BR />      

     <form method="post" action="jamzbloglogin.php">
  <center>
  
<table >
   <TR >
     <TD colspan="2" > <CENTER><font size=6 color="blue"> MyBLOG </font></CENTER> </TD>
   </TR>
   <TR >
     <TD colspan="2" >&nbsp;&nbsp;  </TD>
   </TR>
   <TR>
     <TD align="right"><font size=4 color="BLACK">eMAIL: </font>   </TD> <TD><input name="email" type="text" maxlength="25" size=25 /></td>  </TD>
   </TR>
   <TR>
     <TD align="right"> <font size=4 color="BLACK"> PASSWORD: </font> </TD> <TD> <input name="pass" type="PASSWORD" maxlength="40" size=25 /> </TD>
   </TR>
   <TR>
     <TD colspan="2"> <CENTER><input type="submit" value="Login" style="height: 30px; width: 100px; font-size:100%" /> </CENTER> </TD>
   </TR>
   <TR >
     <TD colspan="2" >&nbsp;&nbsp;  </TD>
   </TR>
   <TR>
     <TD colspan="2"> <CENTER><font size=4 color="black"> <a href="blogregister.php?&flag=0">REGISTER</a></font> </CENTER> </TD>
   </TR>

 </table><BR />
 


  
  </center>

 </form>


   </body>
 </html>




<?php

exit;
}





// Make the connection to MySQL or die

$connect = mysql_connect($host, $username, $password);
if (!$connect) { die('Could not connect: ' . mysql_error()); }

// Select your database
mysql_select_db ($database); 


 
 $sql="SELECT * FROM blogname WHERE email='$mail' and pass='$passwrd'";
 $res=mysql_query($sql);
 $count=mysql_num_rows($res);


 if($count==1) 
   { 
 while ($field = mysql_fetch_array($res))
 {
 $id = $field['userid'];
 $name = $field['usernamefirst'];
 $last = $field['usernamelast'];
 $email = $field['email'];
 $passwrd = $field['pass'];
 $date = $field['registrationdate'];
 $priviledge = $field['privi'];
 }
   // ---- using cookie-------
   //  setcookie("email", $email);
   // setcookie("name", $name);

   // ---- using session ------
   session_start();
   $_SESSION['email']=$email;
   $_SESSION['fname']=$name;
   $_SESSION['lname']=$last;
   $_SESSION['privi']=$priviledge;


mysql_close($connect);

   header('Location: mainblogentry.php'); 

   }

 else 
  { 
   // echo "wrong password"; 

  ?> 

  <html>
   <head>
       <title>NED Login</title>
      <link href="jamzblog.css" rel="stylesheet" type="text/css" />
  
   </head>
   <body >
      <br /><BR /><BR />     

     <form method="post" action="jamzbloglogin.php">
  <center>

<table >
   <TR >
     <TD colspan="2" > <CENTER><font size=6 color="blue"> MyBLOG </font></CENTER> </TD>
   </TR>
   <TR >
     <TD colspan="2" >  <font size=4 color="red">Your Email or Password is incorrect! Please try again  </font>   </TD>
   </TR>
   <TR>
     <TD align="right"><font size=4 color="BLACK">eMAIL: </font>   </TD> <TD><input name="email" type="text" maxlength="25" size=25 /></td>  </TD>
   </TR>
   <TR>
     <TD align="right"> <font size=4 color="BLACK"> PASSWORD: </font> </TD> <TD> <input name="pass" type="PASSWORD" maxlength="40" size=25 /> </TD>
   </TR>
   <TR>
     <TD colspan="2"> <CENTER><input type="submit" value="Login" style="height: 30px; width: 100px; font-size:100%" /> </CENTER> </TD>
   </TR>
   <TR >
     <TD colspan="2" >&nbsp;&nbsp;  </TD>
   </TR>
   <TR>
     <TD colspan="2"> <CENTER><font size=4 color="red"> <a href="blogregister.php">REGISTER</a></font> </CENTER> </TD>
   </TR>

 </table><BR />


  </center>

 </form>


   </body>
 </html>


<?php
exit;


  }


?> 

