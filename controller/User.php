<?php

require_once 'CRUD.php';

class User extends CRUD
{
    private $crudObject;
    private $userName;
    private $userEmail;
    private $userPassword;
    private $userRole;

    /**
     * function __construct is automatically called when User object is define
     * 
     * this function make object of CRUD 
     */
    public function __construct()
    {
        $this->crudObject = new CRUD();
    }


    /**
     * function setUserVariables() set the all variable of User class
     * 
     * @param array $POST contain all the value of user registration form 
     */
    public function setUserVariables($POST)
    {
        $this->userName = htmlspecialchars(trim($POST["userName"]));
        $this->userEmail = htmlspecialchars(trim($POST["userEmail"]));
        $this->userPassword = htmlspecialchars(trim($POST["userPassword"]));
        $this->userRole = htmlspecialchars(trim($POST["userRole"]));
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
        if ($this->userEmail == '') {
            return false;
        }
        if ($this->userPassword == '') {
            return false;
        }
        if ($this->userRole == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchUsers() fetch users data from the users table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchUsers($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("users", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }


    /**
     * function insertUser() insert data in users table
     * 
     * @return true if userData is inserted , else false
     */
    public function insertUser()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "user_name" => $this->userName,
                "user_email" => $this->userEmail,
                "user_password" => $this->userPassword,
                "user_role" => $this->userRole
            );

            $inserted = $this->crudObject->insertData("users", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }


    /**
     * function updateUser() update data in users table
     * 
     * @param string|number $editId is the userId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateUser($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData  = array(
                "user_name" => $this->userName,
                "user_email" => $this->userEmail,
                "user_password" => $this->userPassword,
                "user_password" => $this->userRole,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("users", $updateData, ["user_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }

    /**
     * function deleteUser() delete record from the users table
     * 
     * @param string|number $deleteId is the userId of userData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteUser($deleteId)
    {
        $deleted = $this->crudObject->deleteData("users", ["user_id" => $deleteId]);

        return $deleted;
    }
}