 <html>
<body>
	<h1>CTF SCORING ENGINE v.0001</h1>

 <?php
//CREATE TABLE IF NOT EXISTS `flags` ( `ID` int(255) NOT NULL, `flag` varchar(255) NOT NULL, `points` varchar(255) NOT NULL, KEY `ID` (`ID`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
//CREATE TABLE IF NOT EXISTS `completed` ( `ID` int(255) NOT NULL AUTO_INCREMENT, `user` varchar(255) NOT NULL, `flag` varchar(255) NOT NULL, `points` varchar(255) NOT NULL, PRIMARY KEY (ID) ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

$con = mysql_connect("localhost","ctf","ctfengine","ctfengine")
	or die("unable to connect to MYSQL");
$database = mysql_select_db("ctfengine",$con)
  or die("Could not select YOUR MOM HAHAHAHAHAA");

$user		= mysql_real_escape_string($_POST[user]);
$submitted	= mysql_real_escape_string($_POST[flag]);


echo "<h4>$user submitted $submitted</h4>";
//check to see if it's a flag
$query = "SELECT * FROM flags WHERE flag='$submitted';";
$result = mysql_query($query);

if (!$result) {
    $message  = '<h4>Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query . "</h4>";
    die($message);
}


$row = mysql_fetch_array($result) or die("Ain't no flag matching $submitted <a href='index.html'>Try again</a>");
	
    $points = $row['points'];
	echo "<h4>Flag $submitted is worth points: " . $points . "</h4>";
		
	//check to see if they cheating
	$query = "SELECT flag FROM completed WHERE user='$user';";
	$result = mysql_query($query) or die("whaaat");

	while ($row = mysql_fetch_array($result)) {
			$check = $row['flag'];
		if ($check == $submitted) {
				echo "<h4>YOU ALREADY SUBMITTED THIS FLAG</h4>";
				echo "<h3><a href='index.html'>Try again</a></h3>";
				$cheater = 1;
			}
		}

	if ($cheater != 1) {

		//give them points
		$query = mysql_query("INSERT INTO completed(user, flag, points, time)
		VALUES ('$user','$submitted','$points', NOW());") or die("An error occured somewherez inserting to a certain special table.");

		echo "<h4>$user just recieved $points points!</h4>";
	}


		//get total
		$result = mysql_query("SELECT SUM(points) AS value_sum FROM completed WHERE user = '$user'") or die("An error occured somewherez getting dat sum.");
		$row = mysql_fetch_assoc($result); 
		$sum = $row['value_sum'];
		echo "<h4>$user has $sum points!</h4>";
		echo "<h2>check the <a href='scoreboard.php'>scoreboard</a> to see how bad you are doing</h2>";

	



mysql_close($con);
?> 


</body>
</html>
