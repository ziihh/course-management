<?php 

include './Model/courseClass.php'; // including the courseClass php file. 
/*
$courseFile = array_map('str_getcsv', file('course.csv')); // fetch course from csv file and making array for course. 

$courseArray = array();

// make object of courseFile and echo table headers.
foreach($courseFile as $course){
 
    $newCourse = new Course ($course[0],$course[1],$course[2],$course[3],$course[4],$course[5],$course[6],$course[7],$course[8],$course[9]);
    array_push($courseArray, $newCourse);
    
}
echo '<table>';
echo "<tr>";
echo "<th>Course Code</th>";
echo "<th>Course Name</th>";
echo "<th>year</th>";
echo "<th>semester</th>";
echo "<th>instructor</th>";
echo "<th>credits</th>";
echo "<th>numOfStuds</th>";
echo "<th>numStudPassed</th>";
echo "<th>numStudFailed</th>";
echo "<th>averageGradeTaken</th>";
echo "</tr>";

// loops through courseArray and set value in their colums.
foreach ($courseArray as $course){
    $course -> createCourseTable(); // calling createCourseTable() from courseClass.php file. 
}
echo "</table>";
*/





?>