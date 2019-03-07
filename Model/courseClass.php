<?php 


class Course {
    
    function __construct($courseCode, $courseName, $year, $semester, $instructor, $credits, 
                         $numOfStuds, $numStudPassed, $numStudFailed, $averageGradeTaken){
        $this ->courseCode = $courseCode;
        $this ->courseName = $courseName;
        $this ->year = $year;
        $this ->semester = $semester;
        $this ->instructor = $instructor;
        $this ->credits = $credits;
        $this ->numOfStuds = $numOfStuds;
        $this ->numStudPassed = $numStudPassed;
        $this ->numStudFailed = $numStudFailed;
        $this ->averageGradeTaken = $averageGradeTaken;
    }
    
     function createCourseTable(){ 
         echo '<tr> 
             <td>' . $this -> courseCode . '</td>
             <td>' . $this -> courseName . '</td>
             <td>' . $this -> year . '</td>
             <td>' . $this -> semester . '</td>
             <td>' . $this -> instructor . '</td>
             <td>' . $this -> credits . '</td>
             <td>' . $this -> numOfStuds . '</td>
             <td>' . $this -> numStudPassed . '</td>
             <td>' . $this -> numStudFailed . '</td>
             <td>' . $this -> averageGradeTaken . '</td>
        </tr>';
    }
    
    
    function numOfStuds(){

    }
    
    function numStudPassed(){
        
    }
    
    function numStudFailed(){
        
    }
    
    function averageGrade(){
        
    }
}


?>
