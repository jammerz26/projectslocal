<?php



// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");


// ---- USING SESSION ----

session_start(); 
if (!isset($_SESSION['email']))
   {
  // echo "no SESSION CREATED GO TO LOGIN";
    header('Location: jamzbloglogin.html'); 

   exit();
 }


$bloggerfname = $_SESSION['fname'];
$bloggerlname = $_SESSION['lname'];
$bloggeremail = $_SESSION['email'];





$username = "root";
$password = "jammerz";
$host = "localhost";
$database = "blogusers";



$link = mysql_connect($host, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
	     }

mysql_select_db ($database);



// date and time
/*
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

$userentrydate="$tuig/$bulan/$adlaw-$oras:$minuto";
*/

$range=50;
 

$textfield1 = "ID";
$textfield2 = "DATE POSTED";
$textfield3 = "TITLE";
$textfield4 = "DESCRIPTION";
$textfield5 = "BLOG";
$textfield6 = "POSTED BY";


$varblogid = $_POST['id']; 
$varblogdate=$_POST['blogdate'];
$varblogtitle=mysql_real_escape_string($_POST['blogtitle']);
$varblogdescription=mysql_real_escape_string($_POST['blogdescription']);
$varblogcontent=mysql_real_escape_string($_POST['blogcontent']);
$varusernamefirst=$bloggerfname;
$varusernamelast=$bloggerlname;
$varemail=$bloggeremail;

if (get_magic_quotes_gpc()) 
{
 $blogid = stripslashes($blogid);
 $blogdate = stripslashes($blogdate);

}


$action=$_REQUEST["action"];
$MEMBERSBLOGID=$_REQUEST['MEMBERSBLOGID'];
$MEMBERSACCOUNT=$_REQUEST['MEMBERSACCOUNT'];
$memberfname=$_REQUEST['memberfname'];
$memberlname=$_REQUEST['memberlname'];

if ($action=="MEMBERSBLOGVIEW")
 {
  // echo "$action $MEMBERSBLOGID $MEMBERSACCOUNT $memberfname $memberlname ";
  
	$sql = "SELECT * FROM `$MEMBERSACCOUNT` WHERE ID='$MEMBERSBLOGID' ";

	$res = mysql_query($sql);

	while ($field = mysql_fetch_array($res))
	{
	 $blogid = $field['ID'];
         $blogdate = $field['blogdate'];
	 $blogtitle = $field['blogtitle'];
	 $blogdescription = $field['blogdescription'];
	 $blogcontent = $field['blogcontent'];
	 $usernamefirst = $field['usernamefirst'];
	 $usernamelast = $field['usernamelast'];
	 $email = $field['email'];
        }

 


//--------------------------------------

   echo "<html>
     	  <head>
       	   <title>MyBlog Edit</title>
	     <link href='jamzblog.css' rel='stylesheet' type='text/css' />
	     <link rel='shortcut icon' href='lco.png'>
    	  </head>
   	  <body bgcolor='FFEBCD'>
             
       <table>
        <tr>
         <td>  <img border='0' src='images/supercyan.jpg'   width='65' height='70'>  </td> <td><font size=3 color='blue'>Welcome $bloggerfname  </font>   <br />  </td>
        </tr>
       </table>

       
   
      <table bgcolor='#777777' border='1' width='20%' align='left'>
      <tr>
     
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='mainblogentry.php' title='POST a Blog'>  POST   </a>  </font>  </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='mainblogedit.php' title='EDIT DELETE a Blog'> EDIT  </a> </font> </td> 
       <td align='center' bgcolor='#00FF00'> <font size=3 color='yellow'><a href='blogmembers.php' title='Members List'> MEMBERS  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'> <a href='bloglogout.php' title='EXIT'> Logout </a> </font> </td>
      </tr>
  
  
     </table>
   
   
      <center> 
      	    <font size='5' color='magenta'>&nbsp;  </font> <br />
             
   	   

       <table bgcolor='#777777' border='0' width='45%' align='center'>
         <tr>
           <td align='right' >  <a href='membersview.php?&action=MEMBERSVIEW&memberfname=$memberfname&memberlname=$memberlname&radiobx=" . $MEMBERSACCOUNT . "' title='EXIT'><img border='0' src='images/exit.png'    width='20' height='20'></a> </td>
         </tr> 
         <tr>
           <td align='center' > <font size='5' color='green'> $memberfname $memberlname BLOG </font> </td>
         </tr> 

         <tr>
           <td><font size='2' color='$txtcolor'> $textfield2 : </font>  </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $blogdate </font> </td>
         </tr> 
         <tr>
           <td>&nbsp; </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield3 : </font>  </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'>  $blogtitle  </font> </td>
         </tr> 
         <tr>
           <td>&nbsp; </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield4 : </font>  </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'>  $blogdescription </font> </td>
         </tr> 
         <tr>
           <td> &nbsp;</td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield5 : </font> </td>
         </tr> 
         <tr>
           <td><font size='2' color='black' ><center><TEXTAREA  COLS=50 ROWS=10 style='background:white' style='border: 0' style='color:black' wrap='SOFT' readonly='readonly'>$blogcontent  </TEXTAREA></center></font> </td>
         </tr> 
         <tr>
           <td> &nbsp;</td>
         </tr> 

          <tr>
           <td> <font size='2' color='$txtcolor'> $textfield6 : </font></td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'>  $usernamefirst &nbsp; $usernamelast &nbsp; $email</font> </td>
         </tr> 
         <tr>
           <td>&nbsp; </td>
         </tr>
      </center>
       </table>
   

   </body>
  </html>

        ";

 
 
   
    




}







//----------------------------------------



?>


<?php

// Close our MySQL Link
mysql_close($link);

?>