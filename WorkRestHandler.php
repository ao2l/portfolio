<?php
require_once("SimpleRest.php");
require_once("Work.php");
require_once("Position.php");

		
class WorkRestHandler extends SimpleRest {

	//Get all of the positions
	//supports json and html
	//called from aotoole.net/work/list/
	function getAllPositions() {	

		$position = new Work();
		$rawData = $position->getAllPositions();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No positions found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER["CONTENT_TYPE"]; //$_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response .=  $this->encodeHtml($rawData->getPositions());	
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		} else{
			$response .=  $this->encodeHtml($rawData->getPositions());	
			echo $response;
		}
	}

	//Get the positions for each year. 
	//Supports json and HTML
	//called from aotoole.net/work/list/####/ where #### is the year. 
	public function getPosition($year) {

		$position = new Work();
		$rawData = $position->getPosition($year);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No positions found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER["CONTENT_TYPE"]; //$_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = '{ "positions": ' . $this->encodeJson($rawData) . '}';
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response .=  $this->encodeHtml($rawData);	
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		} else{
			$response .=  $this->encodeHtml($rawData);	
			echo $response;
		}
	}

	
	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $data)
		{
			$htmlResponse .= "<tr><td>". $data->getTitle() . "</td><td>" . $data->getStartYear(). "</td><td>". $data->getEndYear(). "</td><td>";
    		$htmlResponse .= $data->getDescription() . "</td><td>" . $data->getCompany(). "</td><td>". $data->getCity(). ", " . $data->getState();
    		$htmlResponse .= "</td></tr>";
		} 
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	//takes an $xml and the position
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><position></position>');
		$xml->addChild("error", "Xml Not Supported");
		return $xml->asXML();
	}
	
}
?>