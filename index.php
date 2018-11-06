<?php
/**
 * index.php
 *
 * This is the index file. Here is the base of the software and everything will happen here.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

require_once('settings.php');

$handler = new RequestHandler(RequestHandler::INDEX, $_GET, $_POST);
$handler->init();

?>
