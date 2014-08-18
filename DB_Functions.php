<?php
class DB_Functions {
	private $db;
	public function storeBookmarks($name, $type, $icon, $latLng) {
		// setup query
		$q = "INSERT INTO `places_search` (`place_name`, `place_type`, `place_icon`, `place_latLng`) VALUES('$name', '$type', '$icon', '$latLng')";
		
		// Run Query
		$result = mysql_query ( $q ) or die ( mysql_error () );
	}
	public function getBookmarks() {
		$result = mysql_query ( "SELECT * from places_search" ) or die ( mysql_error () );
		
		// check for result
		$no_of_rows = mysql_num_rows ( $result );
		if ($no_of_rows > 0) {
			// $result = mysql_fetch_array($result);
			return $result;
		} else {
			return false;
		}
	}
}

?>
