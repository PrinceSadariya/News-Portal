<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Database.php';

class CRUD extends Database
{
    private $databaseObject;

    /**
     * function __construct is automatically called when CRUD object is define
     * 
     * this function make object of Databse 
     */
    public function __construct()
    {
        $this->databaseObject = new Database();
    }

    /**
     * The function fetchData() fetch data from the databse
     * 
     * @param string $tableName contains tablename of which you want to fetch data from
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchData($tableName, $fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $sql = "SELECT $fields FROM $tableName";
        if (!empty($condition)) {
            $sql .= " WHERE";

            foreach ($condition as $key => $val) {
                $sql .= " $key='$val' $conditionOperator";
            }

            $sql = rtrim($sql, " $conditionOperator");
        }

        if ($sortOrder != '') {
            if ($sortOrder == "ASC") {
                $sql .= " ORDER BY sort_order ASC";
            } elseif ($sortOrder == "DESC") {
                $sql .= " ORDER BY soer_order DESC";
            }
        }

        $result = $this->databaseObject->connect()->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function fetchDataSql($sql)
    {
        $result = $this->databaseObject->connect()->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * function insertData() insert Data in given table
     * 
     * @param string $tableName contains value of tablename in which you want to insert data
     * @param array $insertData contain key => value pair of data
     * 
     * @return true if data was successfully inserted , else false
     */
    public function insertData($tableName, $insertData = array())
    {
        $fields = '';
        $values = '';
        foreach ($insertData as $key => $val) {
            $fields .= "$key , ";
            $values .= "'$val' , ";
        }

        $fields = rtrim($fields, ' , ');
        $values = rtrim($values, ' , ');

        $sql = "INSERT INTO $tableName ($fields) VALUES ($values)";
        $result = $this->databaseObject->connect()->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * function updateData update given values in database in given table
     * 
     * @param string $tableName contains tablename in which you want to update data
     * @param array $updateData contains value which will be update
     * @param array $condition contains condition where data will be update
     * 
     * @return true if data successfully updated , else false
     */
    public function updateData($tableName, $updateData = array(), $condition = array())
    {
        $sql = "UPDATE $tableName SET";

        foreach ($updateData as $key => $val) {
            $sql .= " $key = '$val' ,";
        }

        $sql = rtrim($sql, " ,");
        $sql .= " WHERE";

        foreach ($condition as $key => $val) {
            $sql .= " $key = '$val' AND";
        }

        $sql = rtrim($sql, " AND");
        $result = $this->databaseObject->connect()->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * function deleteData() delete the record from the given table
     * 
     * @param string $tableName contains tablename 
     * @param array $condition contains condition in which basis data will be deleted
     * 
     * @return true if data deleted successfully , else false 
     */
    public function deleteData($tableName, $condition = array())
    {
        $sql = "DELETE FROM $tableName WHERE";

        foreach ($condition as $key => $val) {
            $sql .= " $key = '$val' AND";
        }

        $sql = rtrim($sql, " AND");

        $result = $this->databaseObject->connect()->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
