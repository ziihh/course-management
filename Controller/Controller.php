<?php

include "./Model/Data.php";
include "./View/View.php";

class Controller{ 
    
  	private $data;
  	private $view;

  	function __construct(){
  		$this->data = new Data("./upload/uploaded_file.txt");
  		$this->view = new View();
    }
    
    function invoke(){ 
   		$this->view->createTable();
   		$temp = $this->data->getStudentArray();
        $this->view->showStudentData($temp);  
   		$studentArray = $this->data->getStudentArray();
   		$grade = $this->data->getGrade();

   	}  
   		

   		
   
   
}




?>
