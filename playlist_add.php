<?php
   include('session.php');
      
   	$result = mysqli_query($db, "SELECT userid FROM users WHERE username = '$login_session' ");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$userid = $row['userid'];
   
   $error = "\t";
   //$globalflag = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      
      $myplaylistname = mysqli_real_escape_string($db,$_POST['playlistname']);
      $myglobalflag = mysqli_real_escape_string($db,$_POST['globalflag']);
      
      if($myplaylistname != "")
      
            		
      if($myglobalflag == 1) 
      {
	    $sql = "INSERT INTO `playlists`(`playlistid`, `name`, `globalflag`, `userid`) VALUES ('','$myplaylistname',1,NULL)";
      	$result = mysqli_query($db,$sql);

        $error = "Playlist Added";         
        header("location: playlist_add.php");
      }
 
	  elseif($myglobalflag == 0)
      {      
	    $sql = "INSERT INTO `playlists`(`playlistid`, `name`, `globalflag`, `userid`) VALUES ('','$myplaylistname',0,$userid)";
      	$result = mysqli_query($db,$sql);

        $error = "Playlist Added";
        header("location: playlist_add.php");
      }
      
      else 
      {
         $error = "ERROR: All fields required";
      }
      
      else 
      {
         $error = "ERROR: All fields required";
      }

   }
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
 
		<img alt="myMusic" src="header.jpg" width="600px" height="300px">
		<br>

        <div style = "width:600px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;" align="center">
            <b>
       			myMusic -- <a href = "welcome.php">Home Page</a> -- <a href = "logout.php">Sign Out</a>	
            </b>
            </div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                   <div class="auto-style1">
                  <label>Playlist Name  : </label><input type = "text" name = "playlistname" class = "box"/><br /><br />

				  <label>Availablity : </label>

					<form>
  						<select name="globalflag">
  						<option disabled selected value>
    					<option value="0">Personal</option>
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