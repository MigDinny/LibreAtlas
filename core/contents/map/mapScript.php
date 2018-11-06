<script>
	function initMap() {

		/* Initialization of the map */

		// if mapStyle is not defined, use default (but initialize variable to avoid errors)
		if (typeof mapStyle === 'undefined') mapStyle = "";

		// get markers javascript array from the database
		<?= Marker::getMarkersArray(); ?>

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 3,
			minZoom: 2,
			center: {lat: 35.5594439, lng: -5.6859816},
			styles: mapStyle
		});

		function addMarker(marker) {
			console.log(marker);
			var temp_marker = new google.maps.Marker({
				position: marker['latlng'],
				map: map,
				title: 'Australia',
				//draggable: true,
				animation: google.maps.Animation.DROP
			});

			var contentString = '<div id="content">'+
			'<h2>'+ marker['facility'] +'</h1>'+
	  		'<div id="bodyContent">'+
	  			'<p><span style="font-size: 11px">ID: '+ marker['id'] +'</span></p>'+
	  			'<p><span style="font-size: 11px">Last Updated: '+ marker['last_updated'] +'</span></p>'+
	      		'<p><b>Distribution:</b> '+ marker['distribution'] +'</p>'+
	      		'<p><b>Event:</b> '+ marker['event'] +'</p>'+
	      		'<p><b>Number of Patients:</b> '+ marker['number_patients'] +'</p>'+
	      		'<p><b>Website:</b> <a href="http://'+ marker['website'] +'" target="_blank">'+ marker['website'] +'</a></p>'+
	  			'<p><b>Contacts:</b> ' + marker['contacts'] +
	  		'</div>'+
			'</div>';

			var infoWindow = new google.maps.InfoWindow({
				content: contentString
			});

			temp_marker.addListener('click', function() {
				infoWindow.open(map, temp_marker);
			});

			google.maps.event.addListener(map, 'click', function(event) {
				infoWindow.close();
			});
		}

		// this loops through all existing markers and adds them to the map (200ms between each) and creates an info window for it
		for (i=0; i<markers.length; i++) {
			console.log(i + " . " + markers.length);
			setTimeout(addMarker, i * 350, markers[i]);
		}
	}
</script>
