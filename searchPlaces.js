var geocoder;
var map;
var markers = [];
var strLatLng;
var southWest;
var northEast;
var bounds;

document.write('<');
document.write('script ');
document.write('src="');
//next line is the path to jquery file
document.write('/javascripts/jquery-2.1.1.min.js');
document.write('" type="text/javascript"></');
document.write('script');
document.write('>');
function initialize() {
	var mapOptions = {
		zoom : 16
	};
	map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

	// Try HTML5 geolocation
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = new google.maps.LatLng(position.coords.latitude,
					position.coords.longitude);

			var infowindow = new google.maps.InfoWindow({
				map : map,
				position : pos,
				content : 'Your current Location.'
			});

			map.setCenter(pos);
		}, function() {
			handleNoGeolocation(true);
		});
	} else {
		// Browser doesn't support Geolocation
		handleNoGeolocation(false);
	}
}

function addMarker(latitude, longitude) {

	var map = new google.maps.Map(document.getElementById('googleMap'), {
		mapTypeId : google.maps.MapTypeId.TERRAIN
	});

	var markerBounds = new google.maps.LatLngBounds();

	var randomPoint, i;

	randomPoint = new google.maps.LatLng(latitude, longitude);
	new google.maps.Marker({
		position : randomPoint,
		map : map
	});

	markerBounds.extend(randomPoint);
	map.fitBounds(markerBounds);
}

function callDB(name, type, icon, latLang) {

}
