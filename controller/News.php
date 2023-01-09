<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/CRUD.php';

class News extends CRUD
{
    private $crudObject;
    private $newsTitle;
    private $newsImage;
    private $newsDetail;
    private $sortOrder;

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
     * function setnewsVariables() set the all variable of news class
     * 
     * @param array $POST contain all the value of insert news form 
     */
    public function setNewsVariables($POST, $newsImage)
    {
        $this->newsTitle = htmlspecialchars(trim($POST["newsTitle"]));
        $this->newsImage = htmlspecialchars(trim($newsImage));
        $this->newsDetail = htmlspecialchars(trim($POST["newsDetail"]));
        $this->sortOrder = htmlspecialchars(trim($POST["sortOrder"]));
    }


  
    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->newsTitle == '') {
            return false;
        }
        if ($this->newsDetail == '') {
            return false;
        }
        if ($this->newsImage == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchNews() fetch users data from the news table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchNews($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("news", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }




    /**
     * function insertNews() insert data in news table
     * 
     * @return true if newsData is inserted , else false
     */
    public function insertNews()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "news_title" => $this->newsTitle,
                "news_image" => $this->newsImage,
                "news_detail" => $this->newsDetail,
                "sort_order" => $this->sortOrder
            );

            $inserted = $this->crudObject->insertData("news", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }



    /**
     * function updateNews() update data in news table
     * 
     * @param string|number $editId is the newsId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateNews($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData  = array(
                "news_title" => $this->newsTitle,
                "news_image" => $this->newsImage,
                "news_detail" => $this->newsDetail,
                "sort_order" => $this->sortOrder,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("news", $updateData, ["news_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }


    /**
     * function deleteNews() delete record from the news table
     * 
     * @param string|number $deleteId is the newsId of newsData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteNews($deleteId)
    {
        $deleted = $this->crudObject->deleteData("news", ["news_id" => $deleteId]);

        return $deleted;
    }
}
