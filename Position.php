<?php

Class Position implements JsonSerializable {

	private $title;
	private $description;
	private $company;
	private $city;
	private $state;
	private $startYear;
	private $endYear;
 
	function __construct( $title, $description, $company, $city, $state, $startYear, $endYear ) {
		$this->title = $title;
		$this->description = $description;
		$this->company = $company;
		$this->city = $city;
		$this->state = $state;
		$this->startYear = $startYear;
		$this->endYear = $endYear;
	}

	public	function getTitle() {
		return $this->title;
	}
	
	public	function getDescription() {
		return $this->description;
	}

	public	function getCompany() {
		return $this->company;
	}

	public	function getCity() {
		return $this->city;
	}

	public	function getState() {
		return $this->state;
	}

	public	function getStartYear() {
		return $this->startYear;
	}

	public	function getEndYear() {
		return $this->endYear;
	}
 
    public function jsonSerialize() {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'company' => $this->company,
            'city' => $this->city,
            'state'=> $this->state,
            'startYear' => $this->startYear,
            'endYear' => $this->endYear
        ];
    }
}
?>