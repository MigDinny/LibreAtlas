<?php
/**
 * RestApi.class.php
 *
 * This is the app's REST API. This will handle external requests with an API KEY authentication. This allows:
 * 	- Marker addition/removal
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

class RestApi {
	/* Constant & Variable Declaration */
	const STATUS_ERROR   = 0;
	const STATUS_SUCCESS = 1;

	/* Object Variables */
	private $postData;
	private $getData;
	private $APIKey;
	private $APIAction;

	/* Constructor >> GET and POST data is stored so we can deal with them */
	function __construct($getData, $postData) {
		$this->postData = $postData;
		$this->getData = $getData;

		$this->APIKey = $this->getData['api_key'];
		$this->APIAction = $this->getData['action'];
	}

	/* Init >> Initializes the API. All work must be done here! */
	function init() {
		// API Key validation. Throw error if key is not valid
		if (!$this->checkAPIKey()) $this->response(self::STATUS_ERROR);
		else {
			// handle the action of the user (add or remove markers for example) and creates response
			$this->actionHandler();
		}
	}

	/* CheckAPIKey >> this will check if the key is valid */
	function checkAPIKey() {
		$valid = false;

		$query = DB::queryFirstRow("SELECT * FROM api_keys WHERE key_string=%s", $this->APIKey);

		// API KEYS CURRENTLY DISABLED FOR TESTING PURPOSES
		return isset($this->APIKey) && !empty($this->APIKey) && $query != null;
		//return true;
	}

	/* This handles all possible requests from the user (like add a marker, remove, etc) */
	function actionHandler() {

		if (!isset($this->APIAction) || empty($this->APIAction)) {
			// return false and create error response
			$this->response(self::STATUS_ERROR);
			return false;
		} else {
			switch (strtolower($this->APIAction)) {
				case 'addmarker':
					if ($this->addMarker()) {
						$this->response(self::STATUS_SUCCESS);
						return true;
					} else {
						$this->response(self::STATUS_ERROR);
						return false;
					}
					break;
				case 'disablemarker':
					if ($this->disableMarker()) {
						$this->response(self::STATUS_SUCCESS);
						return true;
					} else {
						$this->response(self::STATUS_ERROR);
						return false;
					}
					break;
				case 'enablemarker':
					if ($this->enableMarker()) {
						$this->response(self::STATUS_SUCCESS);
						return true;
					} else {
						$this->response(self::STATUS_ERROR);
						return false;
					}
					break;
				default:
					$this->response(self::STATUS_ERROR);
					return false;
			}
		}
	}

	/* Add Marker >> adds a marker using POST Data given by user */
	function addMarker() {
		$latlng = (!isset($_POST['latlng']) || empty($_POST['latlng']))  ? null : trim($_POST['latlng']);
		$facility = (!isset($_POST['facility']) || empty($_POST['facility']))  ? null : trim($_POST['facility']);
		$distribution = (!isset($_POST['distribution']) || empty($_POST['distribution']))  ? null : trim($_POST['distribution']);
		$event = (!isset($_POST['event']) || empty($_POST['event']))  ? null : trim($_POST['event']);
		$numberPatients = (!isset($_POST['number_patients']) || empty($_POST['number_patients']))  ? null : trim($_POST['number_patients']);
		$website = (!isset($_POST['website']) || empty($_POST['website']))  ? null : trim($_POST['website']);
		$contacts = (!isset($_POST['contacts']) || empty($_POST['contacts']))  ? null : trim($_POST['contacts']);

		$markerArray = array(
			'latlng' => $latlng,
			'facility' => $facility,
			'distribution' => $distribution,
			'event' => $event,
			'number_patients' => $numberPatients,
			'website' => $website,
			'contacts' => $contacts
		);

		$marker = new Marker($markerArray);
		return $marker->addMarker();
	}

	/* Disable Marker >> disables a marker using POST Data given by user */
	function disableMarker() {
		// if marker id wasn't given, return false because it's impossible to do anything without an id
		if (!isset($_POST['marker_id'])) return false;

		$marker_id = $_POST['marker_id'];

		$marker = new Marker(null, $marker_id);
		return $marker->disableMarker();
	}

	/* Enable Marker >> enables a disabled marker using POST Data given by user */
	function enableMarker() {
		// if marker ID wasn't given, return false because it's impossible to identify it
		if (!isset($_POST['marker_id'])) return false;

		$marker_id = trim($_POST['marker_id']);

		$marker = new Marker(null, $marker_id);
		return $marker->enableMarker();
	}

	/* Response >> echoes the JSON response into the page (WIP) */
	function response($status=false, $responseArray=null) {
		$responseArray = array_filter($responseArray);
		$response = "";

		/*if ($responseArray == null || empty($responseArray)) $response .= "no array ";
		if ($responseArray != null && !empty($responseArray)) $response .= "array ";*/
		if ($status) $response .= "success";
		if (!$status) $response .= "error";

		echo $response;
	}
}
?>
