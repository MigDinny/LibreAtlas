<?php
/**
 * settings.php
 *
 * This is the settings file of this project. This file must be required in index.php in order to be included everywhere in this software.
 * Globals and project settings will be declared here.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

/* Settings >> SETUP */


// >>>>>>>>>>>>>>>>>>> CUSTOMIZABLE BELOW!

// Switch on/off ERROR REPORTING (1 = on, 0 = off) (can be overridden by php.ini)
error_reporting(1);

// App Folder >> folder in which this app is
$appFolder = 'LibreAtlas';

// App Name >> which will appear everywhere
$appname = 'LibreAtlas';

// Google Maps API KEY >> get your own at https://developers.google.com/maps/documentation/javascript/adding-a-google-map#key
$maps_api_key = '';

// Database credentials
$username = 'root';
$password = 'root';
$databaseName = 'libreatlas';
$host = 'localhost';
$encoding = 'utf8';

// Dashboard access
$dashboardUsername = 'admin';
$dashboardPassword = 'admin';

// >>>>>>>>>>>>>>>>>>> DO NOT CHANGE BELOW!

session_start();

/* Constants & Globals Declaration */
// Constants for internal use ONLY
$GLOBALS['dashboard_username'] = $dashboardUsername;
$GLOBALS['dashboard_password'] = $dashboardPassword;
$GLOBALS['appname']            = $appname;
$GLOBALS['maps_api_key']       = $maps_api_key;
$GLOBALS['root']               = $_SERVER['DOCUMENT_ROOT'] . '/' . $appFolder; // ex: C:/wamp64/www/LibreAtlas
$GLOBALS['core']               = $GLOBALS['root'] . '/core'; // ex: C:/wamp64/www/LibreAtlas/core
$GLOBALS['classes']            = $GLOBALS['core'] . '/classes'; // ex: C:/wamp64/www/LibreAtlas/core/classes
$GLOBALS['contents']           = $GLOBALS['core'] . '/contents'; // ex: C:/wamp64/www/LibreAtlas/core/contents
$GLOBALS['sources']            = $GLOBALS['core'] . '/sources'; // ex: C:/wamp64/www/LibreAtlas/core/sources

// These client_ constants are used in client-sided assets like scripts/styles. We cannot use the above. All paths are relative to index.php.
// If a / is added (like: /contents) the the paths are relative to root folder instead index.php
$GLOBALS['client_core']     = 'core'; // ex: atlas.librehealth.io/core
$GLOBALS['client_contents'] = $GLOBALS['client_core'] . '/' . 'contents'; // ex: atlas.librehealth.io/core/contents
$GLOBALS['client_sources']  = $GLOBALS['client_core'] . '/' . 'sources'; // ex: atlas.librehealth.io/core/sources

/* Loading all libraries needed for the program to run */
require_once($GLOBALS['classes'] . '/meekrodb.2.3.class.php');
require_once($GLOBALS['classes'] . '/Session.class.php');
require_once($GLOBALS['classes'] . '/RequestHandler.class.php');
require_once($GLOBALS['classes'] . '/Wizard.class.php');
require_once($GLOBALS['classes'] . '/Marker.class.php');
require_once($GLOBALS['classes'] . '/RestApi.class.php');
require_once($GLOBALS['classes'] . '/Dashboard.class.php');


/* Setting up the Database Handler */
DB::$user = $username;
DB::$password = $password;
DB::$dbName = $databaseName;
DB::$host = $host;
DB::$encoding = $encoding;
?>
