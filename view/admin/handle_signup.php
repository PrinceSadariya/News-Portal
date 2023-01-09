<?php

require_once '../../controller/User.php';

extract($_POST);

if (!empty($userRole) && !empty($userName) && !empty($userEmail) && !empty($userPassword)) {
    $userObject = new User();

    $userData = $userObject->fetchUsers('*', ["user_email" => $userEmail]);

    if (empty($userData)) {
        $userObject->setUserVariables($_POST);

        $inserted = $userObject->insertUser();

        if ($inserted) {
            echo "Account created successfully";
        } else {
            echo "Something went wrong please try again";
        }
    } else {
        echo "Email id already exists , please use different one";
    }
} else {
    echo "Fields can not be empty";
}
