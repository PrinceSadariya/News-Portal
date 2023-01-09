<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Student.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

extract($_POST);
if (!empty($oldPassword) && !empty($newPassword)) {
    if ($newPassword == $confirmPassword) {

        $studentObject = new Student();

        $studentData = $studentObject->fetchStudents('*', ['student_id' => $studentId]);

        $currentPassword = $studentData[0]["user_password"];

        if ($currentPassword == $oldPassword) {
            $crudObject = new CRUD();

            $updated = $crudObject->updateData('students', ["user_password" => $newPassword], ["student_id" => $studentId]);

            if ($updated) {
                echo "Your password has been changed";
            } else {
                echo "Something went wrong , please try again";
            }
        } else {
            echo "Your current password is wrong";
        }
    } else {
        echo "Both Password does not match";
    }
} else {
    echo "Fields can not be empty";
}
