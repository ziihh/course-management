<?php 

include './Controller/students.php';
include './Controller/courses.php';

class Data {

	private $studentArray;


	function __construct($file){
		$this->studentArray = array();
		$this->readCSVFile($file);
	}

	function readCSVFile($fileName){

		$file = array_map('str_getcsv', file($fileName));

		foreach ($file as $row){
			$newStudent = new Student($row[0],$row[1],$row[2],$row[3]);
			array_push($this->studentArray, $newStudent);
		}
	}

	function getStudentArray(){
		return $this->studentArray;
	}
	
	function getGrade(){
       	return $this->studentArray[8];
    }
}


    
?>