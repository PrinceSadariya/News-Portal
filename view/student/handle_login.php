<?php

require_once '../../controller/Student.php';

extract($_POST);

if (!empty($userEmail) && !empty($userPassword)) {
    $studentObject = new Student();

    $studentData = $studentObject->fetchStudents('student_id,user_password', ["email" => $userEmail]);

    if (!empty($studentData)) {
        if ($studentData[0]["user_password"] == $userPassword) {
            session_start();
            $_SESSION["studentloggedin"] = true;
            $_SESSION["student_id"] = $studentData[0]["student_id"];
            echo "student loggedin";
        } else {
            echo "Password is wrong, Please enter valid password";
        }
    } else {
        echo "Email id does not exists";
    }
} else {
    echo "Fields can not be empty";
}
