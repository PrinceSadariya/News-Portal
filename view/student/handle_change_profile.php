<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Student.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

extract($_POST);

$crudObject = new CRUD();
$studentObject = new Student();

//RETRIVING OLD DATA OF STUDENT
$studentData = $studentObject->fetchStudents('*', ["student_id" => $studentId]);
$oldProfileImage = $studentData[0]["profile_picture"];

//IMAGE HANDLING
$profilePicture = $_FILES["profilePicture"]["name"];
$profileTmpName = $_FILES["profilePicture"]["tmp_name"];
$profileSize = $_FILES["profilePicture"]["size"];
$imageExtension = strtolower(end(explode(".", $profilePicture)));
$validExtensions = ["jpg", "jpeg"];

$profilePictureName = date("mdyhis") . '.' . $imageExtension;

if (in_array($imageExtension, $validExtensions)) {
    if ($profileSize < 10000000) {

        $updated = $crudObject->updateData('students', ["profile_picture" => $profilePictureName], ["student_id" => $studentId]);
        if ($updated) {
            $studentData = $studentObject->fetchStudents('*', ["email" => $email]);

            $studentId = $studentData[0]["student_id"];

            list($uplodWidth, $uplodHeight) = getimagesize($profileTmpName);

            //FOR SMALL IMAGE
            $sWidth = 150;
            $sHeight = 150;
            //FOR MEDIUM IMAGE
            $mWidth = 400;
            $mHeight = 400;
            //FOR LARGE IMAGE
            $lWidth = 800;
            $lHeight = 800;

            $sImage = imagecreatetruecolor($sWidth, $sHeight);
            $mImage = imagecreatetruecolor($mWidth, $mHeight);
            $lImage = imagecreatetruecolor($lWidth, $lHeight);

            $sorceFile = imagecreatefromjpeg($profileTmpName);

            imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);
            imagecopyresized($mImage, $sorceFile, 0, 0, 0, 0, $mWidth, $mHeight, $uplodWidth, $uplodHeight);
            imagecopyresized($lImage, $sorceFile, 0, 0, 0, 0, $lWidth, $lHeight, $uplodWidth, $uplodHeight);

            imagejpeg($sImage, "../../lib/images/student_profile/small/" . $profilePictureName,100);
            imagejpeg($mImage, "../../lib/images/student_profile/medium/" . $profilePictureName,100);
            imagejpeg($lImage, "../../lib/images/student_profile/large/" . $profilePictureName,100);

            unlink("../../lib/images/student_profile/small/" . $oldProfileImage);
            unlink("../../lib/images/student_profile/medium/" . $oldProfileImage);
            unlink("../../lib/images/student_profile/large/" . $oldProfileImage);

            echo "Student Profile Picture has been Changed";
        } else {
            echo "Something went wrong please try again";
        }
    } else {
        echo "Image size must be less than 2mb";
    }
} else {
    echo "Only .jpg or .jpeg files are allowed";
}
