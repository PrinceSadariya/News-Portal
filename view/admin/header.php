<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../model/Constant.php';
require '../../controller/user_defined_functions.php';

//CLASS AUTOLOADER
spl_autoload_register(function ($class_name) {
    require '../../controller/' . $class_name . '.php';
});

//CHECKING FOR LOGIN
session_start();
if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true) {
    header("Location: " . SITE_URL . "view/admin/login.php?access_msg=true");
}

//FOR SHOWING ACTIVE TAB
$uri = explode('/', $_SERVER["REQUEST_URI"]);
$fileName = end($uri);
$tabs = ["index.php", "manage_students.php", "manage_departments.php", "manage_colleges.php", "manage_universities.php",   "manage_banners.php", "manage_news.php"];

if (in_array($fileName, $tabs)) {
    $_SESSION["activeTab"] = $fileName;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../lib/css/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- NAVBAR START-->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-4 border-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="./index.php">Student Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <div>
                    <button id="adminLogoutBtn" class="btn btn-outline-danger">Logout</button>
                </div>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END-->

    <div class="row g-0">

        <!-- SIDEBAR START -->
        <div id="sidebar" class="bg-dark col-2 p-2 fixed-top">
            <div class="container rounded p-2 px-2 <?php if ($_SESSION["activeTab"] == "index.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href="./index.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-gauge-high"></span> Dashboard</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_students.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_students.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-user-group"></span> Manage Students</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_departments.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_departments.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-list"></span> Manage Departments</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_colleges.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_colleges.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-building-circle-exclamation"></span> Manage Colleges</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_universities.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_universities.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-building-un"></span> Manage Universities</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_banners.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_banners.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-images"></span> Manage Banners</span></a>
            </div>
            <div class="container p-2 px-2 rounded <?php if ($_SESSION["activeTab"] == "manage_news.php") {
                                                        echo "bg-primary";
                                                    } ?>">
                <a href=" ./manage_news.php" class="text-decoration-none text-white"><span class="fs-5 nav-link side-link"> <span class="fas side-icon fa-newspaper"></span> Manage News</span></a>
            </div>
        </div>
        <!-- SIDEBAR END -->

        <!-- MAIN CONTAINER START -->
        <div id="main-container">