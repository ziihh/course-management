# Assignment 1

## Code structure 
I have used MVC pattern in this assignment to have structure code and separate logic from displaying. 

Folder structure looks like this: 

- Assignment-1
    - Controller
        - Controller.php
    - Modell
        - Data.php
        - CourseModel.php
        - StudentModel.php
    - View
        - View.php
        - CourseView.php
        - HomePageView.php
        - StudentView.php
        - html
        - css
            - index.css
        - includes
            - footer.php
            - header.php
	- index.php
	- README.md

In controller the controller.php is responsible of saving the uploaded csv files in upload folder, along with controlling the routing of web application. 
Uploaded file is then used as an input to data.php for reading the file and making course and student arrays. 
These arrays contains objects of type Student and Course.
data.php also contain all validation functionalities, along with calculation of meta data for each student and course.
View.php is responsible of view a specified page with table and data. This is based on user interact and commanded by controller.php.
After single/multiple file(s) uploaded users     can press on student or course button to         view either students or courses tables.

## How to run the web application?
### Windows
- Install XAMPP
- Navigate to htdocs folder under ``` C:\xampp\htdocs ```
- Open git bash in htdocs folder
- Clone the repository in htdocs.
- Open browser & navigate to ``` localhost/assignment-1/index.php ```

## Validations
- In the homepage user can upload files multiple times and all files will be visualized.
- Birth Date validation - The user must have DD/MM/YY format on birthdate in csv file before uploading otherwise app will alert an error message saying so. 
- Course code can’t be on two different courses in two different semesters. course code is  the unique id for each course. 
- Info Mismatch - If the student is assigned to same course twice app will alert an error message. Course grade given to student, can’t be given twice. Mitigation against identical rows.

## Explaination
I have created the test.csv with all the data about students and courses. 
In the assignment description it says that user can upload multiple files such as students.csv or instructor.csv, 
which i have approved from my lecturer that if i could have only have a single file which contains all data about instructor/course/student. 
Users can upload same formatted csv files multiple times. 

.csv file format:
```
<studentNo>,<studentFirstName>,<studentLastName>,<BirthDate "DD/MM/YYYY">,<courseCode>,<courseTitle>,<year>,<semester>,<instructor>,<courseCredits>,<studentGrade> 
``` 
Example .csv file row:
```
181922,zain,Foss,18/01/1992,IMT2424,database,2018,Spring,Anders Per,10.0,B
```

There are 2 test files that can be used as an example or to even furthur understand the structure of csv file to create own csv files.

## Sources
There is some php code taken/inspired from different sources and all taken code is referenced as comment of the functionality. 
Functionalities such as regex for birthdate validation and sorting algorithm.
