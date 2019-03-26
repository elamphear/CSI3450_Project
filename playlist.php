<?php
   include('session.php');

	$result = mysqli_query($db, "SELECT userfname, userlname, username FROM users WHERE username = '$login_session' ");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $userfname = $row['userfname'];
    $userlname = $row['userlname'];
    
    
	$id = $_GET['id'];
	$song = $_GET['song'];
?>


<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>

      <h1>Welcome <?php echo $userfname; ?></h1> 

      <h2><a href = "logout.php">Sign Out</a></h2>
      
      <h2><a href = "welcome.php">Home Page</a></h2>
      
      <table>
      <tr>
      <td>
      
   	  <?php		

		$sql = "SELECT songid,title,artist FROM SONGS where exists (select * from playlistsongs where playlistsongs.playlistid = $id and songs.songid = playlistsongs.songid)";
		$result = $db->query($sql);

		echo "<table><tr><th>Songs</th></tr>";

 		while($row = $result->fetch_assoc()) 
 		{
			$songid = $row['songid'];
			$title = $row['title'];
			$artist = $row['artist'];
			echo "<tr><td><a href = 'playlist.php?id=$id&song=$songid'>$title</a></td><td>$artist</td></tr>";			
 		}

 	   	echo "</table></td><td>";

		$sql = "SELECT songid,title,artist,songfilepath,albumartfilepath FROM SONGS where songid = '$song'";
		$result = $db->query($sql);

		echo "<table>";

		while($row = $result->fetch_assoc()) 
 		{
			$title = $row['title'];
			$artist = $row['artist'];
			$songfile = $row['songfilepath'];
			$albumart = $row['albumartfilepath'];
			echo "<tr><th>$title - $artist</th></tr><tr><td><img alt='$title' src='$albumart' height='400' width='400'></td></tr><tr><td><audio src='$songfile' style='width: 400px;' controls='controls'></audio></td></tr>";			
 		}

 	   	echo "</table>";

		?>

		</td>
		</tr>
		</table>

   </body>
   
</html>

