<?php

require_once '../../model/Constant.php';
session_start();
session_unset($_SESSION["loggedin"]);
$_SESSION["loggedin"] = false;
session_unset($_SESSION["superAdmin"]);
$_SESSION["superAdmin"] = false;
session_unset($_SESSION["user_id"]);
// session_destroy();

header("Location: " . SITE_URL . "view/admin/login.php");
