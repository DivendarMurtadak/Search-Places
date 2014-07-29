var geocoder;
var map;
var markers = [];
  var strLatLng;
  var southWest ;
  var northEast;
  var bounds ;
  
  document.write('<');
  document.write('script ');
  document.write('src="');
  //next line is the path to jquery file
  document.write('/javascripts/jquery-2.1.1.min.js');
  document.write('" type="text/javascript"></');
  document.write('script');
  document.write('>');
  // to set initial Map boundry 
function initialize()
{

	this.lat=32.75;
	this.lng=-97.13;
	geocoder = new google.maps.Geocoder();
this.myCenter=new google.maps.LatLng(this.lat,this.lng);
this.mapProp = {
  center:myCenter,
  zoom:16,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

 map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
 
}

// add markers on click of map location
function addMarker(latitude,longitude) {
	
	 var map = new google.maps.Map(document.getElementById('googleMap'), { 
	     mapTypeId: google.maps.MapTypeId.TERRAIN
	   });

	   var markerBounds = new google.maps.LatLngBounds();

	   var randomPoint, i;

	     randomPoint = new google.maps.LatLng(latitude,longitude);
	     new google.maps.Marker({
	       position: randomPoint, 
	       map: map
	     });

	     markerBounds.extend(randomPoint);
	 	   map.fitBounds(markerBounds);
}


function callDB(name, type, icon, latLang)
{
	
	}
