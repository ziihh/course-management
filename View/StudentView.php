<?php
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

	function showStudentData($studentData){

		foreach ($studentData as $student) {
			$student->displayData();
		}
			echo "</table>";
	}


	function showNrOfStudent($students){
		echo "Nr of unique students:  " . sizeof($students);
	}

	showNrOfStudent($data);
	createTable();
	showStudentData($data);

?>