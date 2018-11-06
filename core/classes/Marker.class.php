<?php
/**
 *  Marker.class.php
 *
 *  This handles all Markers tasks.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */


class Marker {
    /* Object Declaration */
    private $markerArray;
    private $markerId;

	/* Constructor */
	public function __construct($markerArray = null, $markerId = null) {

        $this->markerArray = $markerArray;
        $this->markerId = $markerId;

    }

    /* Sets marker array */
    /* key-value pair. keys must be the columns' names. */
    public function setMarkerArray($markerArray) {
        $this->markerArray = $markerArray;
    }

    /* Sets marker ID */
    public function setMarkerId($markerId) {
        $this->markerId = $markerId;
    }

    /* Adds the marker to the database */
    public function addMarker() {
        if ($this->markerArray != null) return DB::insert('markers', $this->markerArray);
        else return false;
    }

    /* Disables marker */
    public function disableMarker() {
        if ($this->markerId != null) {
            return DB::update('markers', array(
                'disabled' => 1
                ), 'id=%s', $this->markerId);
        } else return false;
    }

    /* Enables marker */
    public function enableMarker() {
        if ($this->markerId != null) {
            return DB::update('markers', array(
                'disabled' => 0
                ), 'id=%s', $this->markerId);
        } else return false;
    }

    /* Returns a JavaScript array containing all markers. Used in mapScript.php */
    static function getMarkersArray() {
        // query all active markers
		$markersQuery = DB::query('SELECT * FROM markers WHERE disabled=0 AND latlng IS NOT NULL');

		$markersArrayString = "var markers = [";

		foreach ($markersQuery as $marker) {
			// explode latlng string into lat and lng AND check if data isnt set or empty. display "N/D" (not defined) if something is null on DB
			$lat = trim(explode(',', $marker['latlng'])[0]);
			$lng = trim(explode(',', $marker['latlng'])[1]);
			$facility = trim((!isset($marker['facility']) || empty($marker['facility'])) ? 'N/D' : $marker['facility']);
			$distribution = trim((!isset($marker['distribution']) || empty($marker['distribution'])) ? 'N/D' : $marker['distribution']);
			$event = trim((!isset($marker['event']) || empty($marker['event'])) ? 'N/D' : $marker['event']);
			$number_patients = trim((!isset($marker['number_patients']) || empty($marker['number_patients'])) ? 'N/D' : $marker['number_patients']);
			$website = trim((!isset($marker['website']) || empty($marker['website'])) ? 'N/D' : $marker['website']);
			$contacts = trim((!isset($marker['contacts']) || empty($marker['contacts'])) ? 'N/D' : $marker['contacts']);
			$last_updated = trim((!isset($marker['last_updated']) || empty($marker['last_updated'])) ? 'N/D' : $marker['last_updated']);

			$markersArrayString .= '{latlng: {lat: ' . $lat . ', lng: ' . $lng . '}, ' .
				'id: "' . $marker['id'] . '", ' .
				'facility: "' . $facility . '", ' .
				'distribution: "' . $distribution . '", ' .
				'event: "' . $event . '", ' .
				'number_patients: "' . $number_patients . '", ' .
				'website: "' . $website . '", ' .
				'contacts: "' . $contacts . '", ' .
				'last_updated: "' . $last_updated . '"},';
		}

		$markersArrayString .= "];";
		/*return "var markers = [
			{latlng: {lat: -25.363, lng: 131.044}, id: 152, facility: 'Africa', distribution: 'LibreEHR v2.0.0', event: 'ebola', number_patients: '10', website: 'www.google.com', contacts: 'email@suport.com', last_updated: '2018-01-13 00:19:10'},
			{latlng: {lat: -20.412, lng: 137.044}, id: 174, facility: 'Australia', distribution: 'Toolkit v3.0.0', event: 'flu', number_patients: '2', website: 'www.flu.com', contacts: 'email@flu.com', last_updated: '2018-01-13 00:20:10'}
		];";*/

		return $markersArrayString;
    }

}
?>
