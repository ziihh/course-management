<?php

include 'StudentModel.php';
include 'CourseModel.php';


class Data {

	private $studentArray;
	private $courseArray;

	function __construct($files){
		$this->studentArray = array();
		$this->courseArray = array();
		$this->readCSVFile($files);
	}

	/**
	 * Reads a csv file.
	 *
	 * @param      $fileName  The file to parse.
	 */
	function readCSVFile($filesName){

		foreach ($filesName as $fileName) {
			$file = array_map('str_getcsv', file($fileName));
			// loops in file as row and makes new student and course object.
			foreach ($file as $row){
				if($this->validateStudentBirthDate($row[3]) == false){
					echo "<script type='text/javascript'>alert('Birth date must be written in DD/MM/YYYY');</script>";
					unlink($fileName);
					break;
				}

				$newStudent = new Student($row[0], $row[1], $row[2], date('Y-m-d',strtotime($row[3])));
				$newCourse = new Course($row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);

				$studentNo = $this->existStudent($row[1], $row[2]);

				$courseCode = $this->existCourse($row[4]);


				// Validation of courses having a unique course code.
				if($this->courseInfoMismatch($newCourse) == true){
					echo "<script type='text/javascript'>alert('Course info mismatch');</script>";
					unlink($fileName);
					break;
				}

				if($studentNo == -1){
					$credits = $this->validateGrade($row[10]);
					if($credits != false){

						$newStudent->addPassCredit($row[5], $row[9]);
						$newStudent->addPassGrade($row[5], $row[10]);

					} else {
						$newStudent->addFailCredit($row[5], $row[9]);
						$newStudent->addFailGrade($row[5], $row[10]);
					}

					$this->studentArray[ $newStudent->getStudentNo() ] = $newStudent;
				} else {
					$credits = $this->validateGrade($row[10]);
					if($credits != false){

						if($this->studentArray[$studentNo]->hasGivenGrade($row[5]) == false && $this->studentInfoMismatch($newStudent) == false){

							$this->studentArray[$studentNo]->addPassCredit($row[5], $row[9]);
							$this->studentArray[$studentNo]->addPassGrade($row[5], $row[10]);

						} else {
							echo "<script type='text/javascript'>alert('Student info mismatch, please check duplicate records or mismatch info.');</script>";
							unlink($fileName);
							break;
						}
					} else { // Fail grade and credit
						if($this->studentArray[$studentNo]->hasGivenGrade($row[5]) == false && $this->studentInfoMismatch($newStudent) == false){
							$this->studentArray[$studentNo]->addFailCredit($row[5], $row[9]);
							$this->studentArray[$studentNo]->addFailGrade($row[5], $row[10]);
						} else {
							echo "<script type='text/javascript'>alert('Student info mismatch, please check duplicate records or mismatch info.');</script>";
							unlink($fileName);
							break;
						}
					}
				}


				if($courseCode == -1){
					array_push($this->courseArray, $newCourse);
				}
			}
		}
		$this->setCourseMetaData();
	}

	function setCourseMetaData(){
		foreach ($this->courseArray as $course) {
			$course->setNumofStuds($this->studentsRegistedToCourse($course->getCourseName()));
			$course->setNumStudPassed($this->studentPassInCourse($course->getCourseName()));
			$course->setNumStudFailed($this->studentFailInCourse($course->getCourseName()));
			$course->setAverageGrade($this->averageGradeInCourse($course->getCourseName()));
		}
	}

	function getStudentArray(){
		return $this->studentArray;
	}

	function getCourseArray(){
		return $this->courseArray;
	}

	// regex is taken from stackoverflow.com: https://stackoverflow.com/questions/3720977/preg-match-check-birthday-format-dd-mm-yyyy/3721023#3721023
	function validateStudentBirthDate($birthDate){
		if(preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $birthDate)){
			return true;
		}
		return false;
	}

	/**
	 * { function_description }
	 *
	 * @param      <type>  $firstName  The first name
	 * @param      <type>  $lastName   The last name
	 *
	 * @return     integar  studentNo for the specified student otherwise -1.
	 */
	function existStudent($firstName, $lastName){

		// foreach Loop through studentArray.
		foreach ($this->studentArray as $student){

			// check if student->getName() is same name.
			if($student->getName() == $firstName && $student->getLastName() == $lastName){

				return $student->getStudentNo();
			}

		}

		// Doesn't exist return -1.
		return -1;
	}
	/**
	 *  validates mismatch of information between duplicated records of students.
	 *
	 * @param      <type>   $newStudent  The new student
	 *
	 * @return     boolean  true or false.
	 */
	function studentInfoMismatch($newStudent){
		// foreach Loop through studentArray.
		foreach ($this->studentArray as $student){

			// Check if new student info is not mismatched.
			if($student->getName() == $newStudent->getName() && $student->getLastName() == $newStudent->getLastName() && $student->getStudentNo() == $newStudent->getStudentNo() && $student->getBirthDate() == $newStudent->getBirthDate()){
				return false;
			}
		}
		return true;
	}
	/**
	 * validates mismatch of information between duplicated records of courses.
	 *
	 * @param      <type>   $newCourse  The new course
	 *
	 * @return     boolean  true or false.
	 */
	function courseInfoMismatch($newCourse){
		foreach ($this->courseArray as $course) {

			// check if new course is not mismatched.
			if($course->getCourseCode() == $newCourse->getCourseCode() && $course->getCourseSemester() == $newCourse->getCourseSemester() && $course->getCourseName() != $newCourse->getCourseName()) {
				return true;
			}

		}
		return false;
	}

	/**
	 *  does course exist
	 *
	 * @param      integar  $courseCode  The course code
	 *
	 * @return     integar  courseCode for the specified course otherwise -1.
	 */
	function existCourse($courseCode){


		foreach ($this->courseArray as $course){

			if ($course->getCourseCode() == $courseCode){

				return $course->getCourseCode();

			}
		}

		return -1;
	}
	/**
	 *  Average grade taken in each course.
	 *
	 * @param      <type>   $courseName  The course name
	 *
	 * @return     integer  average grade.
	 */
	function averageGradeInCourse($courseName){
		$nrOfStudents = 0;
		$sumGrade = 0;
		$averageGrade = 0;
		foreach($this->studentArray as $student) {
			if($student->hasGivenGrade($courseName)){
				$sumGrade += $this->convertToNumericGrade($student->getCourseGrade($courseName));
				$nrOfStudents++;
			}
		}
		return $sumGrade / $nrOfStudents;
	}
	/**
	 *  finds number of students that have failed in specified course.
	 *
	 * @param      <type>   $courseName  The course name
	 *
	 * @return     integer  number of failed students.
	 */
	function studentFailInCourse($courseName){
		$failedStudents = 0;
		foreach ($this->studentArray as $student) {

			// check if student failed the course.
			if($student->hasFailedCourse($courseName)){
				$failedStudents++;
			}
		}
		return $failedStudents;
	}
	/**
	 * finds number of students that have passed in specified course.
	 *
	 * @param      <type>   $courseName  The course name
	 *
	 * @return     integer  number of passed students.
	 */
	function studentPassInCourse($courseName){
		$passedStudents = 0;
		foreach ($this->studentArray as $student) {

			//
			if($student->hasPassedCourse($courseName)){
				$passedStudents++;
			}
		}
		return $passedStudents;
	}
	/**
	 * find the number of students registered in specified course.
	 *
	 * @param      <type>   $courseName  The course name
	 *
	 * @return     integer  number of registered students.
	 */
	function studentsRegistedToCourse($courseName){
		$registedStudents = 0;
		foreach ($this->studentArray as $student) {
			if($student->hasGivenGrade($courseName)) {
				$registedStudents++;
			}
		}
		return $registedStudents;
	}
	/**
	 * converts the single alphabetic grade to numeric.
	 *
	 * @param      <type>   $grade  The grade
	 *
	 * @return     integer  numeric grade.
	 */
	function convertToNumericGrade($grade){
		switch ($grade) {
			case 'A':
				return 5;
			case 'B':
				return 4;
			case 'C':
				return 3;
			case 'D':
				return 2;
			case 'E':
				return 1;
			default:
				return 0;
		}
	}

	/**
	 * Gets the numeric grade.
	 *
	 * @param      <type>  $grade  The grade
	 *
	 * @return     array   The array of numeric grades.
	 */
	function getNumericGrade($grade){
		$numberGrade = array();
		$numericGrades = array(
			'A' => 5,
			'B' => 4,
			'C' => 3,
			'D' => 2,
			'E' => 1,
			'F' => 0,
		);
		// loops throught numericGrade.
		foreach($numericGrades as $gradeKey => $number){
			// loops throught student grades.
			foreach ($grade as $value) {
				// if student grade is same as given gradeKey.
				if($value == $gradeKey) {
					array_push($numberGrade, $number); // if it is push number grade in numberGrade array.

				}
			}

		}
		return $numberGrade;
	}

	/**
	 * { validation of studentgrades if they passed or failed. }
	 *
	 * @param      <type>   $grade  The grade
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	function validateGrade($grade){

		switch($grade){
			case "A":
			case "B":
			case "C":
			case "D":
			case "E":
				return true;
			case "F":
				return false;

		}

	}


	/**
	 * Gets the gpa.
	 *
	 * @return     sumCourseCredits  The gpa.
	 */
	function getGPA(){
		$sumCourseCredit = 0;
		$passCredit = array();
		$failCredit = array();
		$pNumericGrade = array();
		$fNumericGrade = array();
		$studentGPA = array();
		 // loops throught studentArray as student and gets pass and fail credits for each student.
		foreach($this->studentArray as $student){

			$passCredit = $student->getPassCredit();
			$failCredit = $student->getFailCredit();

			//var_dump($passCredit, $failCredit);
			$sumCourseCredit = array_sum($passCredit) + array_sum($failCredit);

			$passGrade = $student->getPassGrade();
			$failGrade = $student->getFailGrade();

			/**
			 * loops throght passCredits and gets numericGrade of a student passCredits.
			 */
			foreach($passCredit as $credits){
				$pNumericGrade = $this->getNumericGrade($passGrade);
			}

			 //loops throght failCredits and get numericGrade of it's failCredit.

			foreach($failCredit as $fCredits){
				$fNumericGrade = $this->getNumericGrade($failGrade);
			}

			$sumResult = $this->sumGradeResults($pNumericGrade, $fNumericGrade, $failCredit, $passCredit);
			// calculate GPA.
			$GPA = $sumResult / $sumCourseCredit;
			// mapping the GPA to the studentNo.
			$studentGPA[$student->getStudentNo()] = $GPA;

		}


		return $studentGPA;
	}


	/**
	 * Calculates the gpa.
	 *
	 * @param      integer  $pNumericGrade  The p numeric grade
	 * @param      integer  $fNumericGrade  The f numeric grade
	 * @param      <type>   $fCredits       The f credits
	 * @param      <type>   $pCredits       The p credits
	 */
	function sumGradeResults($pNumericGrade, $fNumericGrade, $fCredits, $pCredits){
		$passResult = array();
		$failResult = array();
		$count = 0;

		foreach($pCredits as $credit){
			array_push($passResult, $credit * $pNumericGrade[$count]);
			$count++;
		}

		$count = 0;
		foreach($fCredits as $credit){
			array_push($failResult, $credit * $fNumericGrade[$count]);
			$count++;
		}

		$sumResults = array_sum($passResult) + array_sum($failResult);

		//var_dump($sumResults);

		return $sumResults;
	}

	function setStudentStatus(){
		$studentGPA = $this->getGPA();
		foreach($studentGPA as $studentNo => $GPA ){
			$student = $this->getStudentByStudentNo($studentNo);
			if($student == null){
				continue;
			}

			if($GPA >= 0 && $GPA <= 1.99){
				$student->setStatus("unsatisfactory");
			}
			else if ($GPA >= 2 && $GPA <= 2.99){

				$student->setStatus("satisfactory");

			}

			else if ($GPA >= 3 && $GPA <= 3.99){

				$student->setStatus("honour");

			}
			else if ($GPA >= 4 && $GPA <= 5){

				$student->setStatus("high honour");
			}
			else{
				echo("invalid GPA");
			}
			$student->setGPA($GPA);

		}
	}
	/**
	 * Gets the student by student no.
	 *
	 * @param  $studentNo  The student no
	 *
	 * @return The student by student no.
	 */
	function getStudentByStudentNo($studentNo){

		foreach($this->studentArray as $student){
		//	var_dump($student);
			// if student's student number is same ass studentNo return the student.
			if($student->getStudentNo() == $studentNo){
				return $student;
			}
		}

		return null;

	}

	/**
	 * Gets the nr of unique courses.
	 *
	 * @return  The nr of unique courses.
	 */
	function getNrOfUniqueCourses() {
		return sizeof($this->courseArray);
	}


	// http://codecry.com/php/insertion-sort
	// function takes in an array and sort it in descending order respect to GPA.
	function sortDescendingOrder($arrayToSort){
		$tempStudentArray = array_values($arrayToSort);

		for ($i = 0; $i < count($tempStudentArray); $i++) {
			$tempStudent = $tempStudentArray[$i];
			$val = $tempStudentArray[$i]->getStudentGPA();
			$j = $i - 1;

			while($j >= 0 && $tempStudentArray[$j]->getStudentGPA() < $val){
				$tempStudentArray[$j + 1] = $tempStudentArray[$j];
				$j--;
			}

			$tempStudentArray[$j + 1] = $tempStudent;
		}

		return $tempStudentArray;

	}

	function sortAscendingOrder($arrayToSort){
		//$tempCourseArray = array_values($arrayToSort);

		for ($i = 0; $i < count($arrayToSort); $i++) {
			$tempCourse = $arrayToSort[$i];
			$val = $arrayToSort[$i]->getNrOfStuds();
			$j = $i - 1;

			while($j >= 0 && $arrayToSort[$j]->getNrOfStuds() > $val){
				$arrayToSort[$j + 1] = $arrayToSort[$j];
				$j--;
			}

			$arrayToSort[$j + 1] = $tempCourse;
		}

		return $arrayToSort;

	}

}

?>