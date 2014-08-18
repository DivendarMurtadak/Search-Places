<?php
if (isset ( $_REQUEST ['saveData'] ) && $_REQUEST ['saveData'] != '') {
	require_once 'DB_Functions.php';
	$db = new DB_Functions ();
	
	$con = mysql_connect ( 'omega.uta.edu', 'ajm6025', 't6GTLR76' );
	
	// heck connection
	if (mysql_errno ()) {
		echo 'Database connection error: ' . mysql_error ();
		exit ();
	}
	
	// selecting database
	mysql_select_db ( 'ajm6025' );
	
	$db->storeBookmarks ( $_GET ['name'], $_GET ['type'], $_GET ['icon'], $_GET ['latLng'] );
	echo '<script type="text/javascript">addMarker("' . $_GET ['latLng'] . '"); </script>';
	mysql_close ();
}
function do_alert($msg) {
	echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}

$cssFile = "style.css";
echo '<html><head><title>Googe Place API</title> <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADA6USx4CghpsJcZQD-1WuYadhbgLnZyQ&sensor=true">';
echo '</script>';
echo '<link  href=' . $cssFile . ' rel="stylesheet">';
echo '<link  href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">';
echo '<link  href="bootstrap/css/bootstrap.css" rel="stylesheet">';
echo ' <script type="text/javascript" src="searchPlaces.js"></script>';
echo ' <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>';

echo ' <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script></head>';

echo '<body text-align="center" onload="initialize();">';
function savePlace() {
	require_once 'DB_Functions.php';
	$db = new DB_Functions ();
	$con = mysql_connect ( 'omega.uta.edu', 'test', 'test' );
	
	// heck connection
	if (mysql_errno ()) {
		echo 'Database connection error: ' . mysql_error ();
		exit ();
	}
	
	// selecting database
	mysql_select_db ( 'ajm6025' );
	
	$db->storeBookmarks ( $_GET ['name'], $_GET ['type'], $_GET ['icon'], $_GET ['latLng'] );
	
	$tag = $_POST ['tag'];
}
function req($key, $default = null) {
	return isset ( $_REQUEST [$key] ) ? trim ( $_REQUEST [$key] ) : $default;
}
function searchRequest($key) {
	$trimStr = $key;
	$conCatTrimStr = str_replace ( " ", "+", $trimStr );
	
	$xmlstr = file_get_contents ( 'https://maps.googleapis.com/maps/api/place/textsearch/xml?query=' . $conCatTrimStr . '&key=AIzaSyAK4sOw9_-IvUTpKrQuGYajfIeUDHjuMsU' );
	$xml = new SimpleXMLElement ( $xmlstr );
	echo '<table class="table" border="1" style="width:700px" bgcolor="#FFFFFF">';
	foreach ( $xml as $place ) {
		$name = $place->name;
		$type = $place->type;
		$icon = $place->icon;
		$latLng = $place->geometry->location->lat . "," . $place->geometry->location->lng;
		if (! empty ( $name ) && ! empty ( $type ))
			echo nl2br ( '<tr><td>' . $name . '</td><td>' . $type . '</td><td> <img class="img-circle" src="' . $icon . '"/></td><td><a class="btn btn-info" onclick="addMarker(' . $latLng . ')">Map Location</a></td><td><a class="btn btn-small" href="searchPlaces.php?saveData=true&name=' . $name . '&type=' . $type . '&icon=' . $icon . '&latLng=' . $latLng . '" ><i class="icon-star"></i>Bookmark</a></td></tr>' );
	}
	echo '</table>';
}

echo '<form method="GET">';
echo '<fieldset>';
echo '<label style=" float: left; margin-top: 20px; "><input  class="input-large search-query" name="search" type="text" placeholder="Search Places…"><input class="btn" value="Search" type="submit">';
echo '</label></fieldset>';
echo '<div id="googleMap" style="width: 500px; height: 400px; float: right; margin-top: 35px; border: 1px inset; border-radius: 5px; position: relative; background-color: rgb(255, 255, 255); font-family: Palatino Linotype; overflow: hidden;"></div>';
echo '<div style="float: left; margin-top: 35px; " id="output">';
echo '</form>';
echo '<form action="bookmarked.php" method="get">';
echo '<input class="btn btn-success" type="submit" value="Bookmarked"></form>';

if (isset ( $_REQUEST ['search'] )) {
	$searchStr = req ( 'search' );
	searchRequest ( $searchStr );
}

?>
