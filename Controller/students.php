<?php


include './Model/studentClass.php'; // including the student class php file. 
/*

function existStudent($name, $studentArray){
   
    // foreach Loop through studentArray.
    foreach ($studentArray as $student){
      
        // check if student->getName() is same name.
        if($student->getName() == $name){

            return true; 
        }
        
     }
    return false; 
}


function getCourse($studentArray){
    
    foreach($studentArray as $student){
                
     echo $student->coursesCompleted() .'<br>';
    }

} 
getCourse($studentArray);


// loops through objectArray and set value in their colums.
foreach ($studentArray as $stud){
    $stud -> createTable(); // calling createTable() from studentClass.php file. 
}
echo "</table>";



$students = array("zain", "simon", "vegard", "zain", "eirik"); 
$uStudents = count(array_unique($students));
//$properArray = array_merge(array_flip(array('student', 'grade' )), $students);
//$properArray = array_replace(array_flip(array('student', 'grade' )), $grades);


$importFile = array_map('str_getcsv', file('test.csv'));
//print_r($importFile);
$grades = array("F", "E", "D", "C", "B", "A");
$courseCredit = array();


 foreach ($importFile as $grade){
    switch($grade[9]){
        case "A": 
        case "B": 
        case "C": 
        case "D": 
        case "E":
            $courseCredit += $grade[8]
            
            
    }
    
    $studentGrade = array_search($grade[9], $grades);
    echo ($tempPoint.'<br>');
}






// arsort($students);

/*$sum = 0;
$average = 0;
for($i=0; $i > $students.length; $i++){
    if($grades < 0){
        echo 'invalid grade, try again';
    }
    $sum = $sum + $grades;
    $average = $sum/$i;
}
echo 'the average is '. $average;
*/
/* foreach($students as $x => $x_Value){
    echo "Student name " . $x . ", Grade = " . $x_Value;
    echo "<br>";    
}      

echo "<h1>Course managment system</h1>";
echo "<h2> Number of Students</h2>";
echo "<p> - There are ". $uStudents ." students </p>";

*/

    
  
?>
