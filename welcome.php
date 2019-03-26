<?php
   include('session.php');

	$result = mysqli_query($db, "SELECT userid, userfname, userlname, username FROM users WHERE username = '$login_session' ");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$userid = $row['userid'];
    $userfname = $row['userfname'];
    $userlname = $row['userlname'];

?>

<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>

      <h1>Welcome <?php echo $userfname; ?></h1> 

      <h2><a href = "logout.php">Sign Out</a></h2>

	  <?php		

		$sql = "SELECT playlistid,name FROM Playlists where GlobalFlag = '1' or Userid = '$userid'";
		$result = $db->query($sql);

		echo "<table><tr><th>Playlists</th></tr>";

 		while($row = $result->fetch_assoc()) 
 		{
			$id = $row['playlistid'];
			$song = "";
			$name = $row['name'];
			echo "<tr><td><a href = 'playlist.php?id=$id&song=$song'>$name</a></td></tr>";			
 		}

 	   echo "</table>";

		?>

   </body>
   
</html>