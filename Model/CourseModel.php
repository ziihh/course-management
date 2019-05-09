<?php


class Course {
    private $courseCode;
    private $courseName;
    private $year;
    private $semester;
    private $instructor;
    private $credits;
    private $numOfStuds;
    private $numStudPassed;
    private $numStudFailed;
    private $averageGradeTaken;

    function __construct($courseCode, $courseName, $year, $semester, $instructor, $credits){
        $this ->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this ->year = $year;
        $this ->semester = $semester;
        $this ->instructor = $instructor;
        $this ->credits = $credits;
    }

     function displayCourseData(){
         echo '<tr>
             <td>' . $this ->courseCode . '</td>
             <td>' . $this ->courseName . '</td>
             <td>' . $this ->year . '</td>
             <td>' . $this ->semester . '</td>
             <td>' . $this ->instructor . '</td>
             <td>' . $this ->credits . '</td>
             <td>' . $this ->numOfStuds . '</td>
             <td>' . $this ->numStudPassed . '</td>
             <td>' . $this ->numStudFailed . '</td>
             <td>' . $this ->averageGradeTaken . '</td>
        </tr>';
    }

    function getCourseCode(){
        return $this->courseCode;
    }

    function getCourseYear(){
        return $this->year;
    }

    function getCourseSemester(){
        return $this->instructor;
    }

    function getCourseName(){
        return $this->courseName;
    }

    function getCourseCredits(){
        return $this->credits;
    }

    function getNrOfStuds(){
        return $this->numOfStuds;
    }

    function setNumOfStuds($registeredStudents){
        $this->numOfStuds = $registeredStudents;
    }

    function setNumStudPassed($passedStudents){
        $this->numStudPassed = $passedStudents;
    }

    function setNumStudFailed($failedStudents){
        $this->numStudFailed = $failedStudents;
    }

    function setAverageGrade($avgGrade){
        $this->averageGradeTaken = $avgGrade;
    }
}


?>
