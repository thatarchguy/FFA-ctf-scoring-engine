<html>
<body>
  <h1>CTF SCORING ENGINE v.0001</h1>
	<h2>Scoreboard</h2>
<table>
<tr>
<td>User</td>
<td>Points</td>
</tr>
 <?php

$con = mysql_connect("localhost","ctf","ctfengine","ctfengine")
	or die("unable to connect to MYSQL");
$database = mysql_select_db("ctfengine",$con)
  or die("Could not select ctfengine");


$query = "SELECT user, SUM(points) as total FROM completed GROUP BY user ORDER BY total DESC;";
	$result = mysql_query($query) or die("whaaat");

	while ($row = mysql_fetch_array($result)) {
			$user 	= $row['user'];
			$points = $row['total'];
			echo "<tr><td>$user</td><td>$points</td></tr>";
		}



mysql_close($con);
?> 
</table>
<h2><a href='log.php'>Wanna see the log? </a></h2>
<h2><a href="index.html">Submit your flags</a></h2>

</body>
</html>
