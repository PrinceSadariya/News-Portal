<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Student.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

extract($_POST);

$studentObject = new Student();

if (!empty($userName) &&  !empty($userPassword) && !empty($firstName) && !empty($lastName) && !empty($middleName) && !empty($gender) && !empty($email) && !empty($mobile) && !empty($department) && !empty($college) && !empty($university)) {

    $studentData = $studentObject->fetchStudents('*', ["email" => $email]);
    $currentData = $studentObject->fetchStudents('*', ["student_id" => $studentId]);

    $currentEmail = $currentData[0]["email"];

    if (empty($studentData) || $email == $currentEmail) {
        $crudeObject = new CRUD();
        $date = date("Y-m-d h:i:s");
        $updatedArr = array(
            "user_name" => $userName,
            "user_password" => $userPassword,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "middle_name" => $middleName,
            "gender" => $gender,
            "email" => $email,
            "mobile" => $mobile,
            "department" => $department,
            "college" => $college,
            "university" => $university,
            "updated_date" => $date
        );

        $updated = $crudeObject->updateData('students', $updatedArr, ["student_id" => $studentId]);
        if ($updated) {
            echo "Profile updated succesfully";
        } else {
            echo "Error in profile updating";
        }
    } else {
        echo "Email already exists , please use different one";
    }
} else {
    echo "Fields can not be empty";
}
