<?php

include "./Model/Data.php";
include "./View/View.php";

class Controller{

	private $data;
	private $view;

	function __construct(){
		session_start();
		$this->view = new View();
		$this->data = new Data(glob("./upload/*"));

	}


	function invoke(){

		if(isset($_GET["studentTables"])){
			if($this->data != null){ // error handle, if the data is not null show student tables.
				$studentArray = $this->data->getStudentArray();

				$this->data->setStudentStatus();
				$sortedStudentArray = $this->data->sortDescendingOrder($studentArray);

				$this->view->createPage("View/StudentView.php", $sortedStudentArray);

			} else { // if data is null, echo upload file.
				echo ("upload the file, before view.");
			}
		} else if (isset($_GET["courseTables"])){
			if($this->data != null){// error handle, if the data is not null show student tables.
	  			$courseArray = $this->data->getCourseArray();

	  			$sortedCourseArray = $this->data->sortAscendingOrder($courseArray);
	  			$this->view->createPage("View/CourseView.php", $sortedCourseArray);
			}else { // if data is null, echo upload file.
				echo ("upload the file, before view.");

			}

		} else if(isset($_POST['submit'])){ // check if file is uploaded.
			if(isset($_FILES['file'])){
				//if there is an error uploading the file.
				if ($_FILES['file']['error'] > 0 ){

					echo 'Error uploading the file! <br />';
				} else {
					//if file already exists
					if (file_exists('upload/' . $_FILES['file']['name'])){
						echo $_FILES['files']['name'] . ' already exists';
					} else {
							//Store file in directory "upload" with the name of "uploaded_file.csv"
					$storagename = "uploaded_file_". time() .".csv";
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
					echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
					}
				}
			}
			//header("Location: index.php");
			$this->view->createPage("View/HomePageView.php", []);
		} else {
			$this->view->createPage("View/HomePageView.php", []);
		}
	  //$this->data->sortDescendingOrder();

	 /*  $this->view->createTable();
	  $NrofUniqueStudent = $this->data->getNrOfUniqueStud();
	  $this->view->showUniqueStudent($NrofUniqueStudent);

	  $temp = $this->data->getStudentArray();
	  $this->view->showStudentData($temp);

	  // courses function
	  $this->view->createCourseTable();
	  $courseTemp = $this->data->getCourseArray();
	  $this->view->showCourseData($courseTemp);
	  $nrOfUniqueCourses = $this->data->getNrOfUniqueCourses();
	  $this->view->showUniqueCourses($nrOfUniqueCourses);
	 //var_dump($GPA); */
	}





}




?>
