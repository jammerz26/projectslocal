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



 
 

$memberfield1 = "View";
$memberfield2 = "First Name";
$memberfield3 = "Last Name";
$memberfield4 = "Date Joined";




//--------------------------------------

   echo "<html>
     	  <head>
       	   <title>MyBlog view</title>
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
      	    <font size='5' color='magenta'> &nbsp;</font> <br />
           
   	   
    
   <table bgcolor='#777777' border='1' width='50%' align='center'>
      <tr>
         <td align='center' colspan='4' > <font size='5' color='green'>MyBLOG MEMBERS </font> </td>
      </tr> 
      <tr>
      <th nowrap><center><font size='2' color='$txtcolor'> $memberfield1 </font></center> </th>
      <th nowrap><center><font size='2' color='$txtcolor'> $memberfield2 </font></center> </th>
      <th nowrap><center><font size='2' color='$txtcolor'> $memberfield3 </font></center> </th>
      <th nowrap><center><font size='2' color='$txtcolor'> $memberfield4 </font></center> </th>
     </tr> ";
  

 
   
    
    
  	$sql = "SELECT * FROM blogname WHERE email!='$bloggeremail' ORDER BY registrationdate DESC ";

	$res = mysql_query($sql);

	while ($field = mysql_fetch_array($res))
	{
         
         $usernamefirst = $field['usernamefirst'];
         $usernamelast = $field['usernamelast'];
         $registrationdate = $field['registrationdate'];
         $email = $field['email'];
 


	 echo "
         <tr>	
        
         <td bgcolor='$tdbgcolor' >
           <center>    
           <a href='membersview.php?&action=MEMBERSVIEW&memberfname=" . $usernamefirst . "&memberlname=" . $usernamelast . "&radiobx=" . $email . "' title='view'><img border='0' src='images/view.png'   width='30' height='30' ></a>
           </center>
         </td> 

	 <td bgcolor='$tdbgcolor' ><center><font size='1' color='$fieldcolor' > $usernamefirst      </font></center> </td> 
	 <td bgcolor='$tdbgcolor' ><center><font size='1' color='$fieldcolor' >  $usernamelast     </font></center> </td> 
	 <td bgcolor='$tdbgcolor' ><center><font size='1' color='$fieldcolor' >  $registrationdate      </font></center> </td> 
 
	 </tr> ";
       
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