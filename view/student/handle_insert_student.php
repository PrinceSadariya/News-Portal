<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Student.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

extract($_POST);

$studentObject = new Student();

if (!empty($userName) && !empty($firstName) && !empty($lastName) && !empty($middleName) && !empty($gender) && !empty($email) && !empty($mobile) && !empty($department) && !empty($college) && !empty($university)) {

    if ($studentId != '') {
        //FOR UPDATING DATA

        $studentData = $studentObject->fetchStudents('*', ["email" => $email]);
        $currentData = $studentObject->fetchStudents('*', ["student_id" => $studentId]);

        $currentEmail = $currentData[0]["email"];

        if (empty($studentData) || $email == $currentEmail) {
            $crudeObject = new CRUD();
            $date = date("Y-m-d h:i:s");
            $updatedArr = array(
                "user_name" => $userName,
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
        // FOR INSERTING DATA

        if ($userPassword === $userConfirmPassword) {
            $studentData = $studentObject->fetchStudents('*', ["email" => $email]);

            if (empty($studentData)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $profilePicture = $_FILES["profilePicture"]["name"];
                    $profileTmpName = $_FILES["profilePicture"]["tmp_name"];
                    $profileSize = $_FILES["profilePicture"]["size"];
                    $imageExtension = strtolower(end(explode(".", $profilePicture)));
                    $validExtensions = ["jpg", "jpeg"];

                    $profilePictureName = date("mdyhis") . '.' . $imageExtension;

                    if (in_array($imageExtension, $validExtensions)) {
                        if ($profileSize < 10000000) {
                            $inserted = $studentObject->insertStudent($_POST, $profilePictureName);

                            if ($inserted) {
                                $studentData = $studentObject->fetchStudents('*', ["email" => $email]);

                                $studentId = $studentData[0]["student_id"];

                                list($uplodWidth, $uplodHeight) = getimagesize($profileTmpName);

                                $sWidth = 150;
                                $sHeight = 150;
                                $mWidth = 400;
                                $mHeight = 400;
                                $lWidth = 800;
                                $lHeight = 800;

                                $sImage = imagecreatetruecolor($sWidth, $sHeight);
                                $mImage = imagecreatetruecolor($mWidth, $mHeight);
                                $lImage = imagecreatetruecolor($lWidth, $lHeight);

                                $sorceFile = imagecreatefromjpeg($profileTmpName);

                                imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);
                                imagecopyresized($mImage, $sorceFile, 0, 0, 0, 0, $mWidth, $mHeight, $uplodWidth, $uplodHeight);
                                imagecopyresized($lImage, $sorceFile, 0, 0, 0, 0, $lWidth, $lHeight, $uplodWidth, $uplodHeight);

                                imagejpeg($sImage, "../../lib/images/student_profile/small/" . $profilePictureName, 100);
                                imagejpeg($mImage, "../../lib/images/student_profile/medium/" . $profilePictureName, 100);
                                imagejpeg($lImage, "../../lib/images/student_profile/large/" . $profilePictureName, 100);
                                // move_uploaded_file($profileTmpName, "../../lib/images/student_profile/" . $profilePictureName);

                                //SESSION SET FOR LOGIN
                                session_start();

                                $_SESSION["studentloggedin"] = true;
                                $_SESSION["student_id"] = $studentId;
                                echo "Student data has been inserted";
                            } else {
                                echo "Error in inserting data";
                            }
                        } else {
                            echo "Image size must be less than 2mb";
                        }
                    } else {
                        echo "Only .jpg or .jpeg or .png files are allowed";
                    }
                } else {
                    echo "Invalid email format";
                }
            } else {
                echo "Email already exists , please use different one";
            }
        } else {
            echo "Both password does not match";
        }
    }
} else {
    echo "Fields can not be empty";
}
