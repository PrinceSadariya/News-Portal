<?php

require_once 'CRUD.php';

class University extends CRUD
{
    private $crudObject;
    private $universityName;
    private $universityCity;
    private $universityState;

    /**
     * function __construct is automatically called when university object is define
     * 
     * this function make object of CRUD 
     */
    public function __construct()
    {
        $this->crudObject = new CRUD();
    }


    /**
     * function setuniversityVariables() set the all variable of universitys class
     * 
     * @param array $POST contain all the value of university registration form 
     */
    public function setUniversityVariables($POST)
    {
        $this->universityName = htmlspecialchars(trim($POST["universityName"]));
        $this->universityCity = htmlspecialchars(trim($POST["universityCity"]));
        $this->universityState = htmlspecialchars(trim($POST["universityState"]));
    }

    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->universityName == '') {
            return false;
        }
        if ($this->universityCity == '') {
            return false;
        }
        if ($this->universityState == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchUniversities() fetch users data from the universities table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchUniversities($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("universities", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }


    /**
     * function insertUniversity() insert data in universitys table
     * 
     * @return true if universityData is inserted , else false
     */
    public function insertUniversity()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "university_name" => $this->universityName,
                "university_city" => $this->universityCity,
                "university_state" => $this->universityState,
            );

            $inserted = $this->crudObject->insertData("universities", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }


    /**
     * function updateUniversity() update data in universities table
     * 
     * @param string|number $editId is the userId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateUniversity($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData = array(
                "university_name" => $this->universityName,
                "university_city" => $this->universityCity,
                "university_state" => $this->universityState,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("universities", $updateData, ["university_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }

    /**
     * function deleteUniversity() delete record from the universitys table
     * 
     * @param string|number $deleteId is the universityId of universityData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteUniversity($deleteId)
    {
        $deleted = $this->crudObject->deleteData("universities", ["university_id" => $deleteId]);

        return $deleted;
    }
}
