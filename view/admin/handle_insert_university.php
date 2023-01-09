<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/University.php';

extract($_POST);

if (!empty($universityName) && !empty($universityCity) && !empty($universityState)) {
    $universityObject = new University();

    if ($universityId == '') {
        //FOR INSERTING DATA
        $universityObject->setUniversityVariables($_POST);

        $inserted = $universityObject->insertUniversity();

        if ($inserted) {
            echo "University has been inserted";
        } else {
            echo "Error in inserting university";
        }
    } else {
        //FOR UPDATING DATA

        $universityObject->setUniversityVariables($_POST);

        $updated = $universityObject->updateUniversity($universityId);

        if ($updated) {
            echo "University has been updated";
        } else {
            echo "Error in updating university";
        }
    }
} else {
    echo "Fields can not be empty";
}
