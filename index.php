<?php

include './Controller/Controller.php';


// check if file is uploaded. 
if(isset($_POST['submit'])){ 
    if(isset($_FILES['file'])){
        //if there is an error uploading the file. 
        if ($_FILES['file']['error'] > 0 ){
            
            echo 'return code: ' . $_FILES['file']['error'] . '<br />';
        } else {                                        
            echo "file upload";
            //if file already exists
            if (file_exists('upload/' . $_FILES['file']['name'])){
                echo $_FILES['files']['name'] . ' already exists';
            } else {
                    //Store file in directory "upload" with the name of "uploaded_file.txt"
            $storagename = "uploaded_file.txt";
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
            echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
            }
        }
    }else {
             echo "No file selected <br />";
    }
}


$controller = new Controller();
$controller->invoke();

?>
