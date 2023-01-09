<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/College.php';

extract($_POST);

if (!empty($collegeName) && !empty($collegeCity) && !empty($collegeState)) {
    $collegeObject = new College();

    if ($collegeId == '') {
        //FOR INSERTING DATA
        $collegeObject->setCollegeVariables($_POST);

        $inserted = $collegeObject->insertCollege();

        if ($inserted) {
            echo "College has been inserted";
        } else {
            echo "Error in insertinf college";
        }
    } else {
        //FOR UPDATING DATA

        $collegeObject->setCollegeVariables($_POST);

        $updated = $collegeObject->updateCollege($collegeId);

        if ($updated) {
            echo "College has been updated";
        } else {
            echo "Error in updating college";
        }
    }
} else {
    echo "Fields can not be empty";
}
