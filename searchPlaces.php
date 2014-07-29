<?php
if(isset($_REQUEST['saveData']) && $_REQUEST['saveData'] != ''){
	//savePlace();
	//do_alert("Hello");
	require_once 'DB_Functions.php';
	$db = new DB_Functions();
	
	$con = mysql_connect('localhost', 'root', 'deven143@deven');
	
	#Check connection
	if (mysql_errno()) {
	echo 'Database connection error: ' . mysql_error();
	exit();
	}
	
	// selecting database
	mysql_select_db('places');
	
	
	$db->storeBookmarks($_GET['name'],$_GET['type'],$_GET['icon'],$_GET['latLng']);
	echo '<script type="text/javascript">addMarker("' . $_GET['latLng'] . '"); </script>';
	
	mysql_close();
}
// test alerts for debugging
function do_alert($msg)
{
	echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}
// include JS and css
$cssFile = "style.css";
	echo '<html><head><title>Googe Place API</title> <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADA6USx4CghpsJcZQD-1WuYadhbgLnZyQ&sensor=true">';
	echo '</script>';
    echo '<link  href=' . $cssFile . ' rel="stylesheet"></head>';
	echo ' <script type="text/javascript" src="searchPlaces.js"></script>';
	echo '<body text-align="center" onload="initialize();">';

	
	
	function savePlace(){
		require_once 'DB_Functions.php';
		$db = new DB_Functions();
		$con = mysql_connect('localhost', 'root', 'root');
		
		#Check connection
		if (mysql_errno()) {
		echo 'Database connection error: ' . mysql_error();
		exit();
		}
		
		// selecting database
		mysql_select_db('places');
		
		
		$db->storeBookmarks($_GET['name'],$_GET['type'],$_GET['icon'],$_GET['latLng']);
		
		$tag = $_POST['tag'];
		
	}
	// check and trim search request
	function req($key, $default = null) {
		return isset($_REQUEST[$key]) ? trim($_REQUEST[$key]) : $default;
	}
// Search results and parse XML response
	function searchRequest($key)
	{
		//do_alert("Hello1");
		$trimStr = $key;
		$conCatTrimStr = str_replace(" ", "+", $trimStr);
		error_reporting(E_ALL);
		ini_set('display_errors','On');
		
		$xmlstr = file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/xml?query='.$conCatTrimStr.'&key=AIzaSyAK4sOw9_-IvUTpKrQuGYajfIeUDHjuMsU');
		$xml = new SimpleXMLElement($xmlstr);	
		echo '<table border="1" style="width:700px" bgcolor="#FFFFFF">';
				foreach($xml as $place){
					$name = $place->name;
					$type = $place->type;
					$icon = $place->icon;
						$latLng =$place->geometry->location->lat.",".$place->geometry->location->lng;
			    echo nl2br('<tr><td>'.$name.'</td><td>'.$type.'</td><td> <img src="'.$icon.'"/></td><td><a onclick="addMarker('.$latLng.')">Map Location</a></td><td><a href="searchPlaces.php?saveData=true&name='.$name.'&type='.$type.'&icon='.$icon.'&latLng='.$latLng.'" >Bookmark</a></td></tr>');
			 }
		echo '</table>';
	}
	
	echo '<form method="GET">';
	echo '<fieldset><legend>Find Places:</legend>';
	echo '<label>Search for Places: <input name="search" type="text"><label>';
	echo '<input value="Search" type="submit">';
	echo '</label></label></fieldset>';
	echo '<div id="googleMap" style="width: 500px; height: 400px; float: right; margin-top: 35px; border: 1px inset; border-radius: 5px; position: relative; background-color: rgb(255, 255, 255); font-family: Palatino Linotype; overflow: hidden;"></div>';
	echo '<div style="float: right; margin-top: 35px; " id="output">';//<input value="Bookmarked" name ="bookmarked" type="button"></div>';
	echo '</form>';
	echo '<form action="bookmarked.php" method="get">';
	echo '<input type="submit" value="Bookmarked"></form>';
	//get request
	if(isset($_REQUEST['search'])) {
		$searchStr = req('search');
		searchRequest($searchStr);
		
		
	}
	
	

?>
