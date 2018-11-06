<?php
/**
 * api.php
 *
 * This is the API file. The REST API is handled here.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */
$api = new RestApi($_GET, $_POST);
$api->init();
?>
