<?php

 

// Create MySQL login values and 
// set them to your login information.
$username = "root";
$password = "jammerz";
$host = "localhost";
$database = "blogusers";

// connect to MySQL or die

$link = mysql_connect($host, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
// select database
mysql_select_db ($database);


// Assigning of Var


$userfield1 = "ID";
$userfield2 = "*FIRST NAME";
$userfield3 = "*LAST NAME";
$userfield4 = "*PHONE No";
$userfield5 = "*EMAIL";
$userfield6 = "*PASSWORD";
// $userfield7 = "PRIVILEDGE";
$userfield8 = "REGISTRATION DATE";


// for entry

 $unamefirst=$_POST['usernamefirst'];
 $unamelast=$_POST['usernamelast'];
 $uphone=$_POST['phone'];
 $uname=$_POST['email'];
 $upass=$_POST['pass'];
 $uprivi=$_POST['privi'];
 $uregister=$_POST['registrationdate'];


// to prevent mysql injection
if (get_magic_quotes_gpc()) 
{
 $unamefirst = stripslashes($unamefirst);
 $unamelast = stripslashes($unamelast);
 $uphone = stripslashes($uphone);
 $uname= stripslashes($uname);
 $upass = stripslashes($upass);
 $uprivi = stripslashes($uprivi);
 $uregister = stripslashes($uregister);
}


// date and time

$timezone = "Asia/Singapore";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

$alttime=getdate();


$tuig=$alttime["year"];
$bulan=$alttime["mon"];
if ($bulan<"10"){ $bulan="0$bulan"; }
$adlaw=$alttime["mday"];
if ($adlaw<"10"){ $adlaw="0$adlaw"; }
$oras=$alttime["hours"];
if ($oras<"10"){ $oras="0$oras"; }
$minuto=$alttime["minutes"];
if ($minuto<"10"){ $minuto="0$minuto"; }
$secondo=$alttime["seconds"];

$userentrydate="$tuig/$bulan/$adlaw";



  echo "<html>
     	  <head>
       	   <title>blog user register</title>
	     <link href='jamzblog.css' rel='stylesheet' type='text/css' />
           <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    	  </head>
   	  <body bgcolor='FFEBCD'>
             
  
        <center> 
      <br /> <br /> <br /> <br />
    
  


<table bgcolor='#777777' border='1' width='30%' align='center'>
 <form method='post' action='blogregister.php'>

   <TR>
     <TD colspan='2' align='right' ><a href='jamzbloglogin.html' title='EXIT'><img border='0' src='images/exit.png'   width='20' height='20'></a>   </TD>
   </TR>
   <TR>
     <TD colspan='2' ><center><font size=5 color='RED'> MyBLOG USER ENTRY</font></center> </TD>
   </TR>
  
   <TR>
     <TD align='right'> <font size='3' color='black'> $userfield2 </font></TD> <TD><input name='usernamefirst' type='text' tabindex='1' maxlength='30' size='20'/>  </TD>
   </TR>

   <TR>
     <TD align='right'><font size='3' color='black'> $userfield3 </font> </TD> <TD> <input name='usernamelast' type='text' tabindex='2' maxlength='30' size='20'/> </TD>
   </TR>

   <TR>
     <TD align='right'><font size='3' color='black'> $userfield4 </font> </TD> <TD> <input name='phone' type='text' tabindex='3' maxlength='30' size='20'/> </TD>
   </TR>

   <TR>
     <TD align='right'> <font size='3' color='black'> $userfield5 </font></TD> <TD> <input name='email' type='text' tabindex='4' maxlength='30' size='20'/> </TD>
   </TR>

   <TR>
     <TD align='right'><font size='3' color='black'> $userfield6 </font> </TD> <TD><input name='pass' type='text' tabindex='6' maxlength='30' size='20'/>  </TD>
   </TR>

   <TR>
     <TD align='right'><font size='3' color='black'> $userfield8 </font>  </TD> <TD><font size='2' color='$txtcolor'>$userentrydate</font>  </TD>
   </TR>

   <TR>
     <TD align='right'><input type='reset' value='CLEAR' style='height: 25px; width: 70px; font-size:80%' /> </TD> <TD><input type='submit' value='SUBMIT'  style='height: 25px; width: 70px; font-size:80%' />   </TD>
   </TR>

  
  </form> 


    ";
   




    if (!$uname && !$upass && !$unamefirst && !$unamelast && !$uphone ) 
  	{
        
   	echo "
          <TR>
           <TD colspan='2' > <center> <font color='cyan'>Please Enter the required * Fields!</font> </center></TD>
          </TR>
        ";
    	 exit;
  	}

    else
	{



 	 $sql2 = "SELECT * FROM blogname WHERE email='$uname' ";
 	 $res2 = mysql_query($sql2);
 	 $count=mysql_num_rows($res2);

 	 if($count!=0) 
 	  { 
           echo "
          <TR>
           <TD colspan='2' > <center> <font color='red'>FAIL!!!  Username already exists</font> </center></TD>
          </TR>
          "; 
          }

 	 else
 	  { 
	   $sqlinsert="INSERT INTO blogname (usernamefirst, usernamelast, phone, email, pass, privi, registrationdate) values('$unamefirst', '$unamelast', '$uphone', '$uname', '$upass', '$uprivi', '$userentrydate')";
           $res=mysql_query($sqlinsert,$link);
           if(!$res )
  	    {
   	    die('Could not enter data, maybe server down please try again later ' . mysql_error());
 	    }

       $sqlcreate="CREATE TABLE `$uname` ( ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), usernamefirst text(20), usernamelast text(20), email text(20), blogdate text(20), blogtitle text(30), blogdescription text(50), blogcontent text(300) )";
           $res2=mysql_query($sqlcreate,$link);
             if(!$res2 )
  	    {
   	    die('Could not create table, maybe server down please try again later ' . mysql_error());
 	    }


 
           else 
	    { 
              header('Location: userentrysuccess.php');
              
             echo "
             <TR>
              <TD colspan='2' > <center> <font color='$echcolor'>Entered data successfully</font> </center></TD>
             </TR>
     

           "; }

           }
         }

  

  echo "  </table>
  	 </center>
 	 </body>
 	</html>";




?>



<?php

// Close our MySQL Link
mysql_close($link);

?>