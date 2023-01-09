<?php

require_once 'CRUD.php';

class College extends CRUD
{
    private $crudObject;
    private $collegeName;
    private $collegeCity;
    private $collegeState;

    /**
     * function __construct is automatically called when College object is define
     * 
     * this function make object of CRUD 
     */
    public function __construct()
    {
        $this->crudObject = new CRUD();
    }


    /**
     * function setCollegeVariables() set the all variable of Colleges class
     * 
     * @param array $POST contain all the value of College registration form 
     */
    public function setCollegeVariables($POST)
    {
        $this->collegeName = htmlspecialchars(trim($POST["collegeName"]));
        $this->collegeCity = htmlspecialchars(trim($POST["collegeCity"]));
        $this->collegeState = htmlspecialchars(trim($POST["collegeState"]));
    }

    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->collegeName == '') {
            return false;
        }
        if ($this->collegeCity == '') {
            return false;
        }
        if ($this->collegeState == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchColleges() fetch users data from the Colleges table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchColleges($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("colleges", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }


    /**
     * function insertCollege() insert data in Colleges table
     * 
     * @return true if collegeData is inserted , else false
     */
    public function insertCollege()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "college_name" => $this->collegeName,
                "college_city" => $this->collegeCity,
                "college_state" => $this->collegeState,
            );

            $inserted = $this->crudObject->insertData("colleges", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }


    /**
     * function updateCollege() update data in Colleges table
     * 
     * @param strinf|number $editId is the userId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateCollege($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData = array(
                "college_name" => $this->collegeName,
                "college_city" => $this->collegeCity,
                "college_state" => $this->collegeState,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("colleges", $updateData, ["college_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }

    /**
     * function deleteCollege() delete record from the Colleges table
     * 
     * @param string|number $deleteId is the collegeId of collegeData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteCollege($deleteId)
    {
        $deleted = $this->crudObject->deleteData("colleges", ["college_id" => $deleteId]);

        return $deleted;
    }
}
