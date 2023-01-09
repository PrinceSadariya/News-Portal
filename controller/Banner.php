<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/CRUD.php';

class Banner extends CRUD
{
    private $crudObject;
    private $bannerTitle;
    private $bannerImage;
    private $bannerStatus;

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
     * function setBannerVariables() set the all variable of Banner class
     * 
     * @param array $POST contain all the value of insert Banner form 
     * @param string $bannerImage contain name of bannerImage 
     */
    public function setBannerVariables($POST, $bannerImage)
    {
        $this->bannerTitle = htmlspecialchars(trim($POST["bannerTitle"]));
        $this->bannerImage = htmlspecialchars(trim($bannerImage));
        $this->bannerStatus = htmlspecialchars(trim($POST["bannerStatus"]));
    }


    /**
     * function validate()
     * 
     * @return true if all values is not empty , else false
     */
    private function validate()
    {
        if ($this->bannerTitle == '') {
            return false;
        }
        if ($this->bannerImage == '') {
            return false;
        }
        return true;
    }


    /**
     * function fetchBanner() fetch users data from the tags table
     * 
     * @param string $fields contains value of table column , by default it is '*' , It contains coma seperated string like 'user_name,user_email'
     * @param array $condition contains condition which you want to apply , It is array like array("user_name"=>"Prince Sadariya","city"=>"Ahmedabad")
     * @param string $conditionOperator contains 'AND' or 'OR' which one you want to apply between conditions , by default it is 'AND' 
     * @param string $sortOrder contains value of sorting , by default it is empty , if $sortOrder = "ASC" then It is sort in ascending order , and "DESC" then viceversa
     * 
     * @return $data , $data is array of information which is fetch by given arguments
     */
    public function fetchBanner($fields = '*', $condition = array(), $conditionOperator = 'AND', $sortOrder = '')
    {
        $data = array();
        $data = $this->crudObject->fetchData("banners", $fields, $condition, $conditionOperator, $sortOrder);
        return $data;
    }




    /**
     * function insertBanner() insert data in banner table
     * 
     * @return true if tagData is inserted , else false
     */
    public function insertBanner()
    {
        $isValid = $this->validate();

        if ($isValid) {
            $insertData = array(
                "banner_title" => $this->bannerTitle,
                "banner_image" => $this->bannerImage,
                "banner_status" => $this->bannerStatus
            );

            $inserted = $this->crudObject->insertData("banners", $insertData);

            return $inserted;
        } else {
            return false;
        }
    }



    /**
     * function updateBanner() update data in banner table
     * 
     * @param string|number $editId is the bannerId where data will be update
     * 
     * @return true if data is successfully updated , else false
     */
    public function updateBanner($editId)
    {
        $isValid = $this->validate();

        if ($isValid) {

            $date = date("Y-m-d h:i:s");

            $updateData  = array(
                "banner_title" => $this->bannerTitle,
                "banner_image" => $this->bannerImage,
                "banner_status" => $this->bannerStatus,
                "updated_date" => $date
            );

            $updated = $this->crudObject->updateData("banners", $updateData, ["banner_id" => $editId]);

            return $updated;
        } else {
            return false;
        }
    }


    /**
     * function deleteBanner() delete record from the banner table
     * 
     * @param string|number $deleteId is the bannerId of bannerData which will be delete
     * 
     * @return true if the data was deleted , else false
     */
    public function deleteBanner($deleteId)
    {
        $deleted = $this->crudObject->deleteData("banners", ["banner_id" => $deleteId]);

        return $deleted;
    }
}
