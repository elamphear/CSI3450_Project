<?php
   include('session.php');
      
   	$result = mysqli_query($db, "SELECT userid,adminflag FROM users WHERE username = '$login_session' ");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$userid = $row['userid'];
	$adminflag = $row['adminflag'];

   
   $error = "\t";

   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {

      	$myaddsong = mysqli_real_escape_string($db,$_POST['addsong']);
		$myremovesong = mysqli_real_escape_string($db,$_POST['removesong']);

      
      	if($myaddsong == "" && $myremovesong == "")
		{
		         $error = "ERROR: No selection made";		
		}

		elseif($myaddsong != "" && $myremovesong != "")
		{
		         $error = "ERROR: Please only select one option at a time.";		
		}
		            		
      	elseif($myaddsong != "")
      	{
      
		    $sql = "INSERT INTO `songs`(`songid`,`title`,`album`,`artist`,`genre`,`songfilepath`,`albumartfilepath`,`premiumflag`) VALUES ('','$mytitle','myalbum','myartist','mygenre','mysongfilepath','myalbumartpath','mypremiumflag')";
	      	$result = mysqli_query($db,$sql);
      
	        $error = "Song Added";
        }
        
        elseif($myremovesong != "")
        {
		    $sql = "DELETE FROM `songs` where songid = '$mysongid'";
	      	$result = mysqli_query($db,$sql);
	      
	        $error = "Song Removed";  
      	}      		
   }
 
/*      else 
      {
         $error = "ERROR: All fields required";
      }

   }

*/

?>
<html>
   
   <head>
      <title>myMusic - Add Playlist</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      .auto-style1 {
		  text-align: center;
	  }
	  
	  a { color: inherit; } 
	  a:link { text-decoration: none;}

      </style>
      
   </head>
   
   <body bgcolor = "#B2B1B1">
	
      <div align = "center">
 
		<img alt="myMusic" src="header.jpg" width="600px" height="280px">
		<br>

        <div style = "width:600px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;" align="center">
            <b>
       			myMusic -- <a href = "welcome.php">Home Page</a> -- <a href = "logout.php">Sign Out</a>	
            </b>
            </div>
			
			<?php
			if($adminflag == '1')
			{
				echo "<div style = 'width:594x;background-color:#2F4F4F; color:#FFFFFF; padding:3px;' align='center'>";
				echo "<b>";		
					echo "Admin Options -- <a href = 'song_manage.php'>Add/Remove Song from DB</a> -- <a href = 'user_manage.php'>Add/Remove User from DB</a>";
				echo "</b>";
				echo "<br></div>";
			}
			?>

			
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                   <div class="auto-style1">
                  <label>Playlist Name  : </label><input type = "text" name = "playlistname" class = "box"/><br /><br />

				  <label>Availablity : </label>

					<form>
  						<select name="globalflag">
    					<option selected="selected" value="0">Personal</option>
    					<option value="1">Global</option>
 					</select>
					</form> <br /><br />

                  <input type = "submit" value = " Add Playlist "/><br />
               	</div>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>