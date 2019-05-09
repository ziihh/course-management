<?php

	function createCourseTable(){
		echo '<table>';
		echo "<tr>";
		echo "<th>Course number</th>";
		echo "<th>Course name</th>";
		echo "<th>Year</th>";
		echo "<th>Semester</th>";
		echo "<th>Instructor</th>";
		echo "<th>Credits</th>";
		echo "<th>Nr students registered</th>";
		echo "<th>Nr students passed</th>";
		echo "<th>Nr students failed</th>";
		echo "<th>Average grade</th>";
		echo "</tr>";
	}

	function showCourseData($courseArray){
		foreach ($courseArray as $course) {
			$course -> displayCourseData();
		}
		echo "</table>";
	}

	function showNrOfCourses($courses){
		echo "Nr of unique courses:  " . sizeof($courses);
	}

	showNrOfCourses($data);
	createCourseTable();
	showCourseData($data);

?>