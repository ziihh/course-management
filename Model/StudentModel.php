<?php

// Student Class with student properties saved in their array. i

class Student{

    private $studentNo;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $passGrades;
    private $passCredits;
    private $failGrades;
    private $failCredits;
    private $GPA;
    private $status;

    function __construct($studentNo, $firstName, $lastName, $birthDate){
        $this->studentNo = $studentNo;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->passGrades = array();
        $this->passCredits = array();
        $this->failGrades = array();
        $this->failCredits = array();
    }

    function displayData(){
         echo '<tr>
             <td>' . $this->studentNo . '</td>
             <td>' . $this->firstName . '</td>
             <td>' . $this->lastName . '</td>
             <td>' . $this->birthDate . '</td>
             <td>' . count($this->passGrades) . '</td>
             <td>' . count($this->failGrades) . '</td>
             <td>' . $this->GPA . '</td>
             <td>' . $this->status . '</td>
        </tr>';
    }

    function hasGivenGrade($course){
        if(array_key_exists($course, $this->passGrades) == true || array_key_exists($course, $this->failGrades) == true){
            return true;
        }
        return false;
    }

    function hasPassedCourse($courseName){
        if(array_key_exists($courseName, $this->passGrades)){
            return true;
        }
        return false;
    }

    function hasFailedCourse($courseName){
        if(array_key_exists($courseName, $this->failGrades)){
            return true;
        }
        return false;
    }

    function addPassGrade($course, $grade){
        $this->passGrades[$course] = $grade;
    }

    function addPassCredit($course, $credit){
        $this->passCredits[$course] = $credit;
    }

    function addFailGrade($course, $grade){
        $this->failGrades[$course] = $grade;
    }

    function addFailCredit($course, $credit){
        $this->failCredits[$course] = $credit;
    }

    function coursesCompleted(){

    }

    function coursesFailed(){

    }

    function calculateGPA(){

    }

    function setGPA($studentGPA){
        $this->GPA = $studentGPA;
    }

    function setStatus($status){
        $this->status = $status;
    }

    function getStudentNo(){
        return $this->studentNo;
    }

    function getName(){
        return $this->firstName;
    }

    function getBirthDate(){
        return $this->birthDate;
    }

    function getLastName(){
        return $this->lastName;
    }

    function getPassCredit(){
        return $this->passCredits;
    }

    function getFailCredit(){
        return $this->failCredits;
    }
    function getPassGrade(){
       return $this->passGrades;
    }
    function getFailGrade(){
        return $this->failGrades;
    }

    function getStudentGPA(){
        return $this->GPA;
    }

    function getCourseGrade($courseName){
        if($this->hasPassedCourse($courseName)){
            return $this->passGrades[$courseName];
        } else if($this->hasFailedCourse($courseName)){
            return $this->failGrades[$courseName];
        }
    }
    /*
    function getCourseCode(){
        return $this->courseCode;
    } */

}
?>