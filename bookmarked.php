<?php
echo '<html><head><title>Googe Place API Bookmarked</title>';
echo '<link  href=style.css rel="stylesheet">';
echo '<link  href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">';
echo '<link  href="bootstrap/css/bootstrap.css" rel="stylesheet">';
// echo ' <script type="text/javascript" src="jquery-2.1.1.min.js"></script>';
echo ' <script type="text/javascript" src="searchPlaces.js"></script>';
echo ' <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>';

echo ' <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script></head>';
require_once 'DB_Functions.php';
$db = new DB_Functions ();
$con = mysql_connect ( 'omega.uta.edu', 'test', 'test' );

// heck connection
if (mysql_errno ()) {
	echo 'Database connection error: ' . mysql_error ();
	exit ();
}

mysql_select_db ( 'ajm6025' );

$results = mysql_query ( "SELECT * from places_search" ) or die ( mysql_error () );
function mysql_fetch_all($res) {
	while ( $row = mysql_fetch_array ( $res ) ) {
		$return [] = $row;
	}
	return $return;
}
function create_table($dataArr) {
	echo "<tr>";
	for($j = 0; $j < count ( $dataArr ); $j ++) {
		if (isset ( $dataArr [$j] )) {
			if ($j == 3) {
				echo "<td><img class='img-circle' src=" . $dataArr [$j] . "/></td>";//
			} else {
				echo "<td>" . $dataArr [$j] . "</td>";
			}
		}
	}
	echo "</tr>";
}

$all = mysql_fetch_all ( $results );

echo '<table class="table table-condensed">';
echo '<tr><th>Sr No.</th><th> Name</th><th>Type</th><th>Icon</th><th>Location</th></tr>';

for($i = 0; $i < count ( $all ); $i ++) {
	create_table ( $all [$i] );
}

echo "</table>";

echo '<a class="btn btn-large btn-primary" type="button" href="searchPlaces.php">Return to Search</a>';
mysql_close ();
?>
