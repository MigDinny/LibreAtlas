<?php
/**
 * RequestHandler.class.php
 *
 * This class will handle requests and routes.
 * When getting into index.php (for example), this handler decides if the request is default or other kind of request (ie. REST Api)
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

class RequestHandler {

	// Static Constants
	const INDEX = 0; // where handler is called

	// areas
	const MAP_AREA = 'map';
	const DASHBOARD_AREA = 'dashboard';
	const API_AREA = 'rest-api';

	// DASHBOARD actions
	const LOGIN_ACTION = 'login';
	const LOGOUT_ACTION = 'logout';
	const ADD_API_KEY = 'add_api_key';
	const EDIT_API_KEY = 'edit_api_key';
	const ENABLE_MARKER = 'enable_marker';
	const DISABLE_MARKER = 'disable_marker';

	// DASHBOARD tabs
	const API_KEYS_TAB = 'api-keys';
	const MARKERS_TAB = 'markers';

	// Object variables
	private $postData;
	private $getData;
	private $handlerPage;

	// Constructor, ex >> new RequestHandler(RequestHandler::INDEX, $_GET, $_POST);
	function __construct($handlerPage, $getData, $postData) {
		$this->handlerPage = $handlerPage;
		$this->getData = $getData;
		$this->postData = $postData;
	}

	// Init >> Initializes the handler. Identifies the page which is being worked on and executes the required conditionals
	/*
	 * ?area=map
	 * 		includes map
	 *
	 * ?area=dashboard
	 * 		?action=login
	 *			includes login page for dashboard
	 *		<default behavior>
	 *			includes dashboard page
	 *
	 * ?area=api
	 *		includes api
	 *
	 * ?area=*
	 *		includes map
	 *
	 * <default behavior>
	 * 		includes map
	 */
	public function init() {
		switch ($this->handlerPage) {
			case self::INDEX:
				if (isset($this->getData['area'])) {
					switch ($this->getData['area']) {
						case self::MAP_AREA:
							include $GLOBALS['contents'] . '/map/map.php';
							break;

						case self::API_AREA:
							include $GLOBALS['contents'] . '/rest-api/api.php';
							break;

						case self::DASHBOARD_AREA:

							// switches ACTION in APIKeys tab
							switch ($this->getData['action']) {
								case self::LOGIN_ACTION:
									if (Session::login($this->postData))
										header('Location: ?area=' . self::DASHBOARD_AREA);
									else
										header('Location: ?area=' . self::DASHBOARD_AREA . '&error=login');

									break;

								case self::LOGOUT_ACTION:
									Session::logout();
									include $GLOBALS['contents'] . '/dashboard/login.php';

									break;

								case self::ADD_API_KEY:
									Dashboard::addAPIKey($this->postData['key_owner']);
									header('Location: ?area=' . self::DASHBOARD_AREA . '&tab=' . self::API_KEYS_TAB);

									break;

								case self::EDIT_API_KEY:
									if (isset($this->postData['submit_regen_key'])) Dashboard::regenerateAPIKey($this->postData['id']);
									elseif (isset($this->postData['submit_edit_owner'])) Dashboard::editAPIKeyOwner($this->postData['id'], $this->postData['key_owner']);
									elseif (isset($this->postData['submit_remove_key'])) Dashboard::removeAPIKey($this->postData['id']);

									header('Location: ?area=' . self::DASHBOARD_AREA . '&tab=' . self::API_KEYS_TAB);

									break;

								case self::DISABLE_MARKER:

									if (isset($this->getData['id'])) Dashboard::disableMarker($this->getData['id']);

									header('Location: ?area=' . self::DASHBOARD_AREA);

									break;

								case self::ENABLE_MARKER:

									if (isset($this->getData['id'])) Dashboard::enableMarker($this->getData['id']);

									header('Location: ?area=' . self::DASHBOARD_AREA);

									break;

								default:
									if (Session::hasPermission())
										include $GLOBALS['contents'] . '/dashboard/dashboard.php';
									else
										include $GLOBALS['contents'] . '/dashboard/login.php';

									break;

							}
							break;
					}
				} else {
					include $GLOBALS['contents'] . '/map/map.php';
				}
				break;
			default:
				include $GLOBALS['contents'] . '/map/map.php';
				break;
		}
	}
}

?>
