<?php
require_once("WorkRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url /Work/list/
		$mobileRestHandler = new WorkRestHandler();
		$mobileRestHandler->getAllPositions();
		break;
		
	case "time":
		// to handle REST Url /Work/list/<year>/
		$mobileRestHandler = new WorkRestHandler();
		$mobileRestHandler->getPosition($_GET["year"]);
		break;

	case "" :
		//404 - not found;
		break;
}
?>