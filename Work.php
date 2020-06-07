<?php
require_once("Position.php");
/* 
A domain Class to represent my work positions.
*/
Class Work implements JsonSerializable {
	/*Default constructor. Generates the array of positions*/
	function __construct() {
		array_push($this->positions, new Position('Bookseller', $this->booksellerDesc, 'Barnes & Noble', 'Monaca', 'PA', '2007', '2012'));
		
		array_push($this->positions, new Position('Software Developer', $this->softwareDeveloperDesc, 'creehan & company', 'Canonsburg', 'PA', '2012', '2013'));

		array_push($this->positions, new Position('Software Designer', $this->softwareDesignDesc, 'creehan & company', 'Canonsburg', 'PA', '2013', '2015'));

		array_push($this->positions, new Position('Software Design Lead', $this->designLeadDesc, 'creehan & company', 'Canonsburg', 'PA', '2015', '2017'));

		array_push($this->positions, new Position('Systems Analyst', $this->systemAnalystDesc, 'Geneva College', 'Beaver Falls', 'PA', '2017', '2020'));
	}

	/*positions private array field*/
	private $positions = array();

	/*descriptions*/
	private $booksellerDesc = 'When I worked at the CCBC Bookstore I learned how to help people with technical issues. Students came to me to ask which laptop the store sold that they would need for their courses. I also helped students if they had trouble accessing their electronic books that they purchased.';
	private $softwareDeveloperDesc = 'As a software developer I honed my skills in SQL and C#. Working in an agile SCRUM methodology, I worked on many different parts of application development from scripting stored procedures in the database to creating the front end forms for data entry.'; 
	private $softwareDesignDesc = 'In the software design team I created the user experience. I wrote technical specifications and layed out user interfaces while managing the needs of the user, the company, and the development team. I designed software that makes business sense, is easy to use, and is easy to fix issues and add new features.';
	private $designLeadDesc = 'Being the lead in the software design team opened up many oppertunities to work with clients. I was able to visit clients and speak with them about their needs for web services and APIs. I especially enjoyed being on the web service review board, where new web service aritectures and schemas were discussed.';
	private $systemAnalystDesc = 'At Geneva College I bring together all of the skills I have learned from my previous positions. I help faculty and staff with technical issues in software; I develop data integrations between the systems in use by the college; I write technical specifications and user guides so that anyone can use and maintain what I develop.';

	/* public property function to return the positions*/
	public function getPositions() {
		return $this->positions;
	}

	/*Returns a json string based on the array of positions. */
	public function jsonSerialize() {
        return [
            'positions' => $this->positions
        ];
    }
		

    /*called from rest URL aotoole.net/work/list/  Returns entire list of positions.*/
	public function getAllPositions(){
		return $this;
	}
	
	/*called from rest URL aotoole.net/work/list/#/ where # will be the year. */
	/* TO DO: Implement filter by year*/
	public function getPosition($year){
		
		$positionsInYear = array();

		foreach ($this->positions as $checkPosition) {
			if($checkPosition->getStartYear() <= $year && $checkPosition->getEndYear() >= $year)
			{
				array_push($positionsInYear, $checkPosition);
			}
		}


		return $positionsInYear;
	}	
}
?>