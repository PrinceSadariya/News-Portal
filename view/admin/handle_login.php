<?php

require_once '../../controller/User.php';

extract($_POST);


if (trim($userEmail) != '' && trim($userPassword) != '') {
    $userObject = new User();
    if ($userRole == "1") {
        //ADMIN LOGIN
        $userData = $userObject->fetchUsers('user_id,user_name,user_password', ["user_role" => "1", "user_email" => $userEmail]);
        if (!empty($userData)) {
            if ($userData[0]["user_password"] == $userPassword) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $userData[0]["user_id"];
                $_SESSION["user_name"] = $userData[0]["user_name"];
                echo "admin loggedin";
            } else {
                echo "Password is wrong, Please enter valid password";
            }
        } else {
            echo "Email id does not exists";
        }
    } elseif ($userRole == "2") {
        //SUPERADMIN LOGIN
        $userData = $userObject->fetchUsers('user_id,user_name,user_password', ["user_role" => "2", "user_email" => $userEmail]);
        if (!empty($userData)) {
            if ($userData[0]["user_password"] == $userPassword) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["superAdmin"] = true;
                $_SESSION["user_name"] = $userData[0]["user_name"];
                $_SESSION["user_id"] = $userData[0]["user_id"];
                echo "admin loggedin";
            } else {
                echo "Password is wrong, Please enter valid password";
            }
        } else {
            echo "Email id does not exists";
        }
    } else {
        echo "Please select your role";
    }
} else {
    echo "Fields can not be empty";
}
