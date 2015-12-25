
var map;
var infowindown;
var map_marker;

function init_map(){
	
	var location =  new google.maps.LatLng(60.220830, 24.805271);

	var map_options = {
		center:  location,
		zoom: 16
	};

	map = new google.maps.Map(document.getElementById("map-container"), map_options);

	map_marker = new google.maps.Marker({
		position: location,
		map: map,
		icon: {
			url: "assets/img/logo.png",
			size: new google.maps.Size(32, 32),
		},
		title: "THL Oy"
	});

	infowindown = new google.maps.InfoWindow({
		content: "THL Oy",
	});

	map_marker.setMap(map);
	infowindown.open(map, map_marker);
}

$(document).ready(function() {

	init_map();

});
