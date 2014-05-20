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


// echo "Main Blog Page of $bloggerfname $bloggerlname $bloggeremail ";



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

$range=5;
 

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


//--------------------------------------

   echo "<html>
     	  <head>
       	   <title>Myblog Entry</title>
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
       <td align='center' bgcolor='#00FF00'> <font size=3 color='yellow'><a href='mainblogentry.php' title='POST a Blog'>  POST   </a>  </font>  </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='mainblogedit.php' title='EDIT DELETE a Blog'> EDIT  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'><a href='blogmembers.php' title='Members List'> MEMBERS  </a> </font> </td> 
       <td align='center' bgcolor='#777777'> <font size=3 color='yellow'> <a href='bloglogout.php' title='EXIT'> Logout </a> </font> </td>
      </tr>
     </table>
   
      <center> 
      	    <font size='5' color='magenta'> MyBLOG</font> <br />
            
   	   
    
   <table bgcolor='#777777' border='1' width='100%' align='center'>
      <tr>
      <th nowrap><font size='2' color='$txtcolor'> $textfield1 </font> </th>
      <th nowrap><font size='2' color='$txtcolor'> $textfield2 </font> </th>
      <th nowrap><font size='2' color='$txtcolor'> $textfield3 </font> </th>
      <th nowrap><font size='2' color='$txtcolor'> $textfield4 </font> </th>
      <th nowrap><font size='2' color='$txtcolor'> $textfield5 </font> </th>
      <th nowrap><font size='2' color='$txtcolor'> $textfield6 </font> </th>
      </tr> ";
  


   echo "<form method='post' action='mainblogentry.php?&action=ADD'>
   	<tr>
        
   	<th><input type='reset' value='CLEAR' style='height: 25px; width: 70px; font-size:80%' /></th>  
     
  	<th><input name='blogdate' type='text' value='$userentrydate' maxlength='15' size='15' disabled/></th> 
 
   	<th><input name='blogtitle' type='text'  maxlength='20' size='20'/></th>
   	<th><input name='blogdescription' type='text'  maxlength='20' size='20'/></th> 
 
   
 
    

	
  	 <th><TEXTAREA NAME='blogcontent'  COLS=50 ROWS=10 ></TEXTAREA> </th>   
 
  

   	 <th><input type='submit' value='POST' tabindex='8' style='height: 30px; width: 80px; font-size:80%' /></th> 
        </tr>
       </form> 
      <tr>
     
      </tr> ";


if ($action=="ADD")
 {

    if (!$varblogtitle && !$varblogcontent && !varblogdescription ) 
  	{
   	 echo "<font color='$echcolor'>Please Enter all the * required Fields! <br />";
    	 echo "<font color='$echcolor'>$varblogtitle $varblogcontent ";
  
  	}

    else
	{ 



 	 $sql2 = "SELECT * FROM `$bloggeremail` WHERE blogtitle='$varblogtitle' && blogcontent='$varblogcontent' && blogdescription='$varblogdescription' ";
 	 $res2 = mysql_query($sql2);
 	 $count=mysql_num_rows($res2);

 	 if($count!=0) 
 	  {  
            // echo "<font color='$echcolor'>Duplicate Entry"; 
          }
 	 else
 	  { 
	   $sqlinsert="INSERT INTO `$bloggeremail` (blogdate, blogtitle, blogdescription, blogcontent, usernamefirst, usernamelast, email ) values('$userentrydate', '$varblogtitle',  '$varblogdescription', '$varblogcontent', '$varusernamefirst', '$varusernamelast', '$varemail' )";
           $res=mysql_query($sqlinsert,$link);
           if(!$res )
  	    {
              echo "<font color='$echcolor'>Could not enter data, maybe server down please try again!! \n <br /> </font>";
             die(' ' . mysql_error());
   	
 	    }
           else 
	    { 
             // echo "<font color='$echcolor'><br /> Data Entered successfully\n </font>";
            }

           }
         }
    $action="INIT";
   }

	$sql = "SELECT * FROM `$bloggeremail` ORDER BY ID DESC LIMIT 0, $range";

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





	 echo "<tr>	  
	 <td bgcolor='$tdbgcolor' ><font size='1' color='$fieldcolor' >  $blogid </font> </td> 

	 <td bgcolor='$tdbgcolor' ><font size='1' color='$fieldcolor' >  $blogdate      </font> </td> 
	 <td bgcolor='$tdbgcolor' ><font size='1' color='$fieldcolor' >  $blogtitle     </font> </td> 
	 <td bgcolor='$tdbgcolor' ><font size='1' color='$fieldcolor' >  $blogdescription     </font> </td> 
 	 <td bgcolor='$tdbgcolor' ><center><font size='1' color='$fieldcolor' ><TEXTAREA  COLS=50 ROWS=3 style='background:$tdbgcolor' style='border: 0' style='color:$fieldcolor' wrap='SOFT' readonly='readonly'>$blogcontent  </TEXTAREA></font></center> </td> 

	 <td bgcolor='$tdbgcolor' ><font size='1' color='$fieldcolor' >  $usernamefirst &nbsp; $usernamelast &nbsp; $email    </font> </td> 

	 </tr>"; 
    

	} 
    

  echo "  </table>
  	 </center>
 	 </body>
 	</html>";













//----------------------------------------



?>


<?php

// Close our MySQL Link
mysql_close($link);

?>