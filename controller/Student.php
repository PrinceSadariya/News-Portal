<?php

require_once 'CRUD.php';

class Student extends CRUD
{
    private $crudObject;
    private $userName;
    private $userPassword;
    private $firstName;
    private $lastName;
    private $middleName;
    private $gender;
    private $email;
    private $mobile;
    private $university;
    private $college;
    private $department;
    private $profilePicture;

    /**
     * function __construct is automatically called when Tag object is define
     * 
     * this function make object of CRUD 
     */
    public function __construct()
    {
        $this->crudObject = new CRUD();
    }


    /**
     * function setStudentVariables() set all the data of Student class
     * 
     * @param array $POST contain all value of user form
     * @param string $profilePicture contain name of profilePicture of student
     */
    public function setStudentVariables($POST, $profilePicture)
    {
        $this->userName = htmlspecialchars(trim($POST["userName"]));
        $this->userPassword = htmlspecialchars(trim($POST["userPassword"]));
        $this->firstName = htmlspecialchars(trim($POST["firstName"]));
        $this->lastName = htmlspecialchars(trim($POST["lastName"]));
        $this->middleName = htmlspecialchars(trim($POST["middleName"]));
        $this->gender = htmlspecialchars(trim($POST["gender"]));
        $this->email = htmlspecialchars(trim($POST["email"]));
        $this->mobile = htmlspecialchars(trim($POST["mobile"]));
        $this->department = htmlspecialchars(trim($POST["department"]));
        $this->college = htmlspecialchars(trim($POST["college"]));
        $this->university = htmlspecialchars(trim($POST["university"]));
        $this->profilePicture = htmlspecialchars(trim($profilePicture));
    }


    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->userName == '') {
            return false;
        }
        if ($this->userPassword == '') {
            return false;
        }
        if ($this->firstName == '') {
            return false;
        }
        if ($this->lastName == '') {
            return false;
        }
        if ($this->middleName == '') {
            return false;
        }
        if ($this->gender == '') {
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (strlen($this->mobile) != 10) {
            return false;
        }
        if ($this->department == '') {
            return false;
        }
        if ($this->college == '') {
            return false;
        }
        if ($this->university == '') {
            return false;
        }
        if ($this->profilePicture == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchStudents() fetch students data from the students table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchStudents($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("students", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }



    /**
     * function insertStudent() insert Student data into students table
     * 
     * @return true if data is inserted , else false
     */
    public function insertStudent($POST, $profilePicture)
    {
        $this->setStudentVariables($POST, $profilePicture);

        $isValid = $this->validate();
        if ($isValid) {
            $insertData = array(
                "user_name" => $this->userName,
                "user_password" => $this->userPassword,
                "first_name" => $this->firstName,
                "last_name" => $this->lastName,
                "middle_name" => $this->middleName,
                "gender" => $this->gender,
                "email" => $this->email,
                "mobile" => $this->mobile,
                "department" => $this->department,
                "college" => $this->college,
                "university" => $this->university,
                "profile_picture" => $this->profilePicture,
            );

            $inserted = $this->crudObject->insertData('students', $insertData);

            if ($inserted) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }



    /**
     * function updateStudent() update Student data into students table
     * 
     * @param string|number $editId is the student id , which you want to edit
     * 
     * @return true if data is updated , else false
     */
    public function updateStudent($POST, $profilePicture, $editId)
    {
        $this->setStudentVariables($POST, $profilePicture);

        $isValid = $this->validate();
        if ($isValid) {
            $date = date('Y-m-d h:i:s');
            $updateData = array(
                "user_name" => $this->userName,
                "user_password" => $this->userPassword,
                "first_name" => $this->firstName,
                "last_name" => $this->lastName,
                "middle_name" => $this->middleName,
                "gender" => $this->gender,
                "email" => $this->email,
                "mobile" => $this->mobile,
                "department" => $this->department,
                "college" => $this->college,
                "university" => $this->university,
                "profile_picture" => $this->profilePicture,
                "updated_date" => $date,
            );

            $updated = $this->crudObject->updateData('students', $updateData, ["student_id" => $editId]);

            if ($updated) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }


    /**
     * function deleteStudent() delete record from the students table
     * 
     * @param string|number $deleteId is the studentId of studentData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteStudent($deleteId)
    {
        $deleted = $this->crudObject->deleteData("students", ["student_id" => $deleteId]);

        return $deleted;
    }
}
