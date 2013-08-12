<html>
<body>
  <h1>CTF SCORING ENGINE v.0001</h1>
	<h2>Log</h2>
<table>
<tr>
<td>User</td>
<td>Points</td>
<td>Time</td>
</tr>
 <?php

$con = mysql_connect("localhost","ctf","ctfengine","ctfengine")
	or die("unable to connect to MYSQL");
$database = mysql_select_db("ctfengine",$con)
  or die("Could not select ctfengine");


$query = "SELECT * FROM completed;";
	$result = mysql_query($query) or die("whaaat");

	while ($row = mysql_fetch_array($result)) {
			$user 	= $row['user'];
			$points = $row['points'];
			$time 	= $row['time'];
			echo "<tr><td>$user</td><td>$points</td><td>$time</td></tr>";
		}



mysql_close($con);
?> 
</table>
<h2>check the <a href='scoreboard.php'>scoreboard</a> to see how bad you are doing</h2>
<h2><a href="index.html">Submit your flags</a></h2>
</body>
</html>
