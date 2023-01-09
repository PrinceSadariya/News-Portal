<?php
require '../../model/Constant.php';

session_start();
session_unset($_SESSION["studentloggedin"]);
$_SESSION["studentloggedin"] = false;
// session_destroy();

header("Location: " . SITE_URL . "/view/student/login.php");
exit;
