<?php
/**
 * Wizard.class.php
 *
 * This is the app's wizard. He does everything, you just need to say the spell. This wizard static class contains a lot of useful tools like:
 * 	- Libraries Inclusion
 *	- Some pattern definition (like website title)
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

class Wizard {
	/* Constant Declaration */
	/* Started with:
	 * 1 -> library
	 * 2 -> any kind of style
	 * 3 -> app area
	 * (preferred order: | 28, 29, 210, 211, 212 | so the first digit indicates the kind of inclusion)
	 */

	const LIBRARY_JQUERY 	 	= 10;
	const LIBRARY_SEMANTIC_UI 	= 11;
	const DARK_MAP_STYLE 		= 20;
	const LOGIN_STYLE 			= 21;
	const DASHBOARD_STYLE 		= 22;
	const MAP_AREA       		= 30;
	const DASHBOARD_AREA 		= 31;
	const LOGIN_AREA     		= 32;

	/* Returns App Title */
	public static function getAppTitle() {
		return $GLOBALS['appname'];
	}

	/* Returns head titles (for the pages) */
	public static function getHeadTitle($area) {
		switch ($area) {
			case self::DASHBOARD_AREA:
				return $GLOBALS['appname'] . ' Dashboard';
				break;
			case self::LOGIN_AREA:
				return $GLOBALS['appname'] . ' Dashboard Login';
				break;
			case self::MAP_AREA:
				return self::getAppTitle();
				break;
			default:
				return self::getAppTitle();
				break;
		}
	}

	/* Returns Maps API Key */
	public static function getMapsAPIKey() {
		return $GLOBALS['maps_api_key'];
	}

	/* Includes libraries */
	public static function callAssets($assetArray) {
		$returnAssetString = "";

		foreach ($assetArray as $asset) {
			switch ($asset) {
				case self::LIBRARY_JQUERY:
					$returnAssetString .= '
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
					';

					break;

				case self::DARK_MAP_STYLE:
					$returnAssetString .= '
					<script src="' . $GLOBALS['client_contents'] . '/map/darkMapStyle.js' . '"></script>
					';

					break;

				case self::LIBRARY_SEMANTIC_UI:
					$returnAssetString .= self::callAssets(array(self::LIBRARY_JQUERY));
					$returnAssetString .= '
					<link rel="stylesheet" type="text/css" href="' . $GLOBALS['client_sources'] . '/semantic-ui/semantic.min.css">
					<script src="' . $GLOBALS['client_sources'] . '/semantic-ui/semantic.min.js"></script>
					';

					break;

				case self::LOGIN_STYLE:
					$returnAssetString .= '
					<link rel="stylesheet" type="text/css" href="' . $GLOBALS['client_sources'] . '/css/login.css" >
					';

					break;

				case self::DASHBOARD_STYLE:
					$returnAssetString .= '
					<link rel="stylesheet" type="text/css" href="' . $GLOBALS['client_sources'] . '/css/dashboard.css">
					';

					break;

				default:
					break;
			}
		}

		return $returnAssetString;
	}

	/* Includes map script */
	public static function callMapScript() {
		include $GLOBALS['contents'] . '/map/mapScript.php';
	}

	/* Returns all markers available to be displayed on the map */
	public static function callMarkersArray() {
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
