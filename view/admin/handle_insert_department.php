<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Department.php';

extract($_POST);

if (isset($departmentName)) {
    if (trim($departmentName) != '') {
        $departmentObject = new Department();

        if ($departmentId == '') {
            //FOR INSERTING DATA
            $departmentObject->setDepartmentVariables($_POST);
            $inserted = $departmentObject->insertDepartment();

            if ($inserted) {
                echo "Department has been inserted";
            } else {
                echo "Error in inserting department";
            }
        } else {
            //FOR UPDATING DATA
            $departmentObject->setDepartmentVariables($_POST);
            $updated = $departmentObject->updateDepartment($departmentId);

            if ($updated) {
                echo "Department has been updated";
            } else {
                echo "Error in updating department";
            }
        }
    } else {
        echo "fields can not be empty";
    }
}
