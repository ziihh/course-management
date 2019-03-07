<?php

class View{


	function __construct(){

	}

	function createTable(){
		// echo table headers.
		echo '<table>';
		echo "<tr>";
		echo "<th>Student number</th>";
		echo "<th>name</th>";
		echo "<th>surname</th>";
		echo "<th>birthday</th>";
		echo "<th>course code</th>";
		echo "<th>course year</th>";
		echo "<th>course semester</th>";
		echo "<th>credits</th>";
		echo "<th>grade</th>";
		echo "</tr>";
	}

	function showStudentData($studentArray){
		foreach ($studentArray as $student) {
			$student -> displayData();
		}
		echo "</table>";

	}
}


?>