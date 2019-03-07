<?php

class Student{

    private $studentNo;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $coursesCompleted;
    private $coursesFailed;
    private $GPA;
    private $status; 
    
    function __construct($studentNo, $firstName, $lastName, $birthDate){
        $this->studentNo = $studentNo;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        
    }
        
    function displayData(){ 
         echo '<tr>
             <td>' . $this->studentNo . '</td>
             <td>' . $this->firstName . '</td>
             <td>' . $this->lastName . '</td>
             <td>' . $this->birthDate . '</td>
             <td>' . $this->coursesCompleted . '</td>
             <td>' . $this->coursesFailed . '</td>
             <td>' . $this->GPA . '</td>
             <td>' . $this->status . '</td>
        </tr>';
    }

    function coursesCompleted(){
        
    }
    
    function coursesFailed(){
        
    }
          
    function calculateGPA(){
        
    }


    function findStatus(){
        
    }
    
    function getName(){
        return $this->firstName;
    }
   
}
?>