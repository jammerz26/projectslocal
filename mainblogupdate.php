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


function blogmessage($messagevar,$bloggerfname) 
  {
 
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
       <td align='center' bgcolor='#00FF00'> <font size=3 color='yellow'><a href='mainblogedit.php' title='EDIT DELETE a Blog'> EDIT  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='blogmembers.php' title='Members List'> MEMBERS  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'> <a href='bloglogout.php' title='EXIT'> Logout </a> </font> </td>
      </tr>
     </table>

         <center> 
      	    <font size='5' color='magenta'> &nbsp; </font> <br />
         </center>    
   	   

       <table bgcolor='#777777' border='0' width='45%' align='center'>
         <tr>
           <td align='right' >  <a href='mainblogedit.php' title='EXIT'><img border='0' src='images/exit.png'    width='20' height='20'></a> </td>
         </tr> 
         <tr>
           <td>&nbsp;</td>
         </tr> 
         <tr>
           <td><center><font size='2' color='black'> $messagevar </font></center> </td>
         </tr> 
         <tr>
           <td>&nbsp;</td>
         </tr>  
         <tr>
           <td>&nbsp;</td>
         </tr>      
       </table>";

  }



$range=50;
 

$textfield1 = "ID";
$textfield2 = "DATE POSTED";
$textfield3 = "TITLE";
$textfield4 = "DESCRIPTION";
$textfield5 = "BLOG";
$textfield6 = "POSTED BY";




if (get_magic_quotes_gpc()) 
{
 $blogid = stripslashes($blogid);
 $blogdate = stripslashes($blogdate);

}


$action=$_REQUEST["action"];
$radiobx=$_REQUEST["radiobx"];
$modify=$_REQUEST["MODIFY"];

if ($modify=="CHANGE")
 {
  // echo " Ready to $modify $radiobx <br /><br />";

$varblogid = $_POST['id']; 
$varblogdate=mysql_real_escape_string($_POST['blogdate']);
$varblogtitle=mysql_real_escape_string($_POST['blogtitle']);
$varblogdescription=mysql_real_escape_string($_POST['blogdescription']);
$varblogcontent=mysql_real_escape_string($_POST['blogcontent']);
$varusernamefirst=$bloggerfname;
$varusernamelast=$bloggerlname;
$varemail=$bloggeremail;

// echo "$varblogid $varblogdate $varblogtitle $varblogdescription $varblogcontent $varusernamefirst $varusernamelast $varemail ";





    $blogupdate="UPDATE `$bloggeremail` SET blogdate='$varblogdate', blogtitle='$varblogtitle', blogdescription='$varblogdescription', blogcontent='$varblogcontent' WHERE ID='$varblogid'";
    $resultupdate=mysql_query($blogupdate);
      if(!resultupdate) 
        {   die(mysql_error()); 
        echo nl2br("<font color='red'>\n Updating Unsuccessfull!!! Please Try again \N </font>");
         blogmessage("<font color='BLUE'>UPDATE FAIL!!!!! Pls Try Again</font>");
       }
      else 
        { 
 
       blogmessage("<font color='BLUE'>Blog Record $varblogid UPDATED successfully</font>","$bloggerfname");


       }


 }

if ($action=="UPDATE")
 {
  // echo "$action $radiobx";
  
	$sql = "SELECT * FROM `$bloggeremail` WHERE ID='$radiobx' ";

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
       <td align='center' bgcolor='#00FF00'> <font size=3 color='yellow'><a href='mainblogedit.php' title='EDIT DELETE a Blog'> EDIT  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='blogmembers.php' title='Members List'> MEMBERS  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'> <a href='bloglogout.php' title='EXIT'> Logout </a> </font> </td>
      </tr>
  
  
     </table>
   
   
        <center> 
      	    <font size='5' color='magenta'>  &nbsp; </font> <br />
         </center>    
   	  
      <form method='post' action='mainblogupdate.php'> 
        <input name='id' type='hidden' value='$radiobx '> 
     
       <table bgcolor='#777777' border='0' width='45%' align='center'>
         <tr>
           <td align='right' >  <a href='mainblogedit.php' title='EXIT'><img border='0' src='images/exit.png'    width='20' height='20'></a> </td>
         </tr> 
         <tr>
           <td align='center' > <font size='5' color='green'> MyBLOG UPDATE </font> </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield2 : </font>  </td>
         </tr> 
         <tr>
           <td><input name='blogdate' type='text' value='$userentrydate' maxlength='15' size='15' readonly='readonly' /> </td>
         </tr> 
         <tr>
           <td>&nbsp; </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield3 : </font>  </td>
         </tr> 
         <tr>
           <td><input name='blogtitle' type='text' value='$blogtitle' maxlength='20' size='20'/></td>
         </tr> 
         <tr>
           <td>&nbsp; </td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield4 : </font>  </td>
         </tr> 
         <tr>
           <td><input name='blogdescription' type='text' value='$blogdescription'  maxlength='20' size='20'/></td>
         </tr> 
         <tr>
           <td> &nbsp;</td>
         </tr> 
         <tr>
           <td><font size='2' color='$txtcolor'> $textfield5 : </font> </td>
         </tr> 
         <tr>
           <td><center><TEXTAREA NAME='blogcontent'  COLS=50 ROWS=10 >$blogcontent </TEXTAREA></center></td>
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
           <td><center><input type='submit' name='MODIFY' value='CHANGE'  style='height: 40px; width: 80px; font-size:80%' onClick=\"return confirm('Are you sure you want Update BLOG $radiobx  ?')\" /> </center></td>
         </tr>

        </table>
       </form> 
      <br /> <br /> <br />

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