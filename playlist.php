<?php
   include('session.php');

	$id = $_GET['id'];
	$song = $_GET['song'];

	$result = mysqli_query($db, "SELECT userfname, userlname, username FROM users WHERE username = '$login_session' ");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $userfname = $row['userfname'];
    $userlname = $row['userlname'];

	$result = mysqli_query($db, "SELECT name from playlists where playlistid = $id");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$playlistname = $row['name'];

?>


<html>

   <head>
      <title>myMusic - Playlist</title>
      
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

		<div style = "width:594px;background-color:#333333; color:#FFFFFF; padding:3px;" align="center">
		<b>			
			myMusic -- <a href = "welcome.php">Home Page</a> -- <a href = "logout.php">Sign Out</a>	
		</b>
		</div>

		<div style = "margin:30px">

      
      <table>
      <tr>
      <td valign="top">
      
   	  <?php

		$sql = "SELECT songid,title,artist FROM SONGS where exists (select * from playlistsongs where playlistsongs.playlistid = $id and songs.songid = playlistsongs.songid)";
		$result = $db->query($sql);

		echo "<table><tr><th><u>$playlistname</u><br><br></th></tr>";

 		while($row = $result->fetch_assoc()) 
 		{
			$songid = $row['songid'];
			$title = $row['title'];
			$artist = $row['artist'];
			echo "<tr><td><font size='2'><a href = 'playlist.php?id=$id&song=$songid'>$title</a></font></td><td><font size='2'>$artist</font></td></tr>";			
 		}

 	   	echo "</table></td><td>";

		$sql = "SELECT songid,title,artist,songfilepath,albumartfilepath FROM SONGS where songid = '$song'";
		$result = $db->query($sql);

		echo "<b><table>";

		while($row = $result->fetch_assoc()) 
 		{
			$title = $row['title'];
			$artist = $row['artist'];
			$songfile = $row['songfilepath'];
			$albumart = $row['albumartfilepath'];
			
			echo "<tr><th>$title - $artist<br><br></th></tr><tr><td><img alt='$title' src='$albumart' height='300' width='300'></td></tr><tr><td><audio autoplay src='$songfile' style='width: 300px;' controls='controls'></audio></td></tr>";			
 		}

 	   	echo "</table></b>";

		?>

		</td>
		</tr>
		</table>

   </body>

</html>

