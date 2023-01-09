<?php

require_once 'CRUD.php';

class Department extends CRUD
{
    private $crudObject;
    private $departmentName;

    /**
     * function __construct is automatically called when Department object is define
     * 
     * this function make object of CRUD 
     */
    public function __construct()
    {
        $this->crudObject = new CRUD();
    }


    /**
     * function setDepartmentVariables() set the all variable of Departments class
     * 
     * @param array $POST contain all the value of Department registration form 
     */
    public function setDepartmentVariables($POST)
    {
        $this->departmentName = htmlspecialchars(trim($POST["departmentName"]));
    }

   
    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->departmentName == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchDepartments() fetch department data from the departments table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string$sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchDepartments($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("departments", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }


    /**
     * function insertDepartment() insert data in departments table
     * 
     * @return true if departmentData is inserted , else false
     */
    public function insertDepartment()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "department_name" => $this->departmentName
            );

            $inserted = $this->crudObject->insertData("departments", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }


    /**
     * function updateDepartments() update data in departments table
     * 
     * @param string|number $editId is the userId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateDepartment($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData  = array(
                "department_name" => $this->departmentName,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("departments", $updateData, ["department_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }

    /**
     * function deleteDepartment() delete record from the departments table
     * 
     * @param string|number $deleteId is the departmentId of departmentData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteDepartment($deleteId)
    {
        $deleted = $this->crudObject->deleteData("departments", ["department_id" => $deleteId]);

        return $deleted;
    }
}
