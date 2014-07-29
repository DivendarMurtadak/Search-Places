<?php
echo '<html><head><title>Googe Place API Bookmarked</title>'; 
echo '<link  href=style.css rel="stylesheet"></head>';
require_once 'DB_Functions.php';
$db = new DB_Functions();

$con = mysql_connect('localhost', 'root', 'deven143@deven');

#Check connection
if (mysql_errno()) {
echo 'Database connection error: ' . mysql_error();
exit();
}

mysql_select_db('places');

$results = mysql_query("SELECT * from places_search")  or die(mysql_error());

function mysql_fetch_all($res) {
	while($row=mysql_fetch_array($res)) {
		$return[] = $row;
	}
	return $return;
}

function create_table($dataArr) {
	echo "<tr>";
	for($j = 0; $j < count($dataArr); $j++) {
		if (isset($dataArr[$j]))
		echo "<td>".$dataArr[$j]."</td>";
	}
	echo "</tr>";
}

$all = mysql_fetch_all($results);

echo "<table class='data_table'>";

for($i = 0; $i < count($all); $i++) {
	create_table($all[$i]);
}

echo "</table>";
mysql_close();
?>
