<?php

class studentInCourse{ 
    
    
  function __construct($studentNo, $courseCode, $year, $semester, $grade){
    
    $this ->studentNo = $studentNo;
    $this ->courseCode = $courseCode;
    $this ->year = $year;
    $this ->semester = $semester;
    $this ->grade = $grade;
    
    
    }
    
   function studInCourseTable(){ 
         echo "<tr>".
             '<td>' . $this -> studentNo . '</td>'
             '<td>' . $this -> courseCode . '</td>'
             '<td>' . $this -> year . '</td>'
             '<td>' . $this -> semester . '</td>'
             '<td>' . $this -> grade . '</td>'.
        '</tr';
    }
}




?>
