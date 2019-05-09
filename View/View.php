<?php

class View{


	function __construct(){

	}

	function createPage($contentFilePath, $data){
		include 'View/includes/header.php';
		include $contentFilePath;
		include 'View/includes/footer.php';
	}
/*
	function createTable(){
		// echo table headers.
		echo '<table>';
		echo "<tr>";
		echo "<th>Student number</th>";
		echo "<th>name</th>";
		echo "<th>surname</th>";
		echo "<th>birthday</th>";
		echo "<th>course completed</th>";
		echo "<th>course failed</th>";
		echo "<th>GPA</th>";
		echo "<th>status</th>";
		echo "</tr>";
	}


	function showStudentData($studentArray){
		foreach ($studentArray as $student) {
			$student -> displayData();
		}
		echo "</table>";

	}
*/
	function showUniqueStudent($NrofUniqueStudent){
		echo "Number of unique students " . $NrofUniqueStudent;
	}

/*	function createCourseTable(){
		echo '<table>';
		echo "<tr>";
		echo "<th>Course number</th>";
		echo "<th>Year</th>";
		echo "<th>semester</th>";
		echo "<th>instructor</th>";
		echo "<th>credits</th>";
		echo "<th>course failed</th>";
		echo "<th>GPA</th>";
		echo "<th>status</th>";
		echo "</tr>";
	}
	function showCourseData($courseArray){
		foreach ($courseArray as $course) {
			$course -> displayCourseData();
		}
		echo "</table>";
	} */

	 function showUniqueCourses($nrOfUniqueCourses){
        echo "Number of unique courses " . $nrOfUniqueCourses;
    }
}


?>