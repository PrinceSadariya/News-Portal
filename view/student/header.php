<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../model/Constant.php';
require '../../controller/user_defined_functions.php';

//CHECKING FOR LOGIN
session_start();
if (!isset($_SESSION["studentloggedin"]) || !$_SESSION["studentloggedin"] === true) {
    header("Location: " . SITE_URL . "/view/student/login.php");
    exit;
}

// CLASS AUTOLOADER
spl_autoload_register(function ($class_name) {
    require '../../controller/' . $class_name . '.php';
});

//FOR SHOWING ACTIVE NAV
$uri = explode('/', $_SERVER["REQUEST_URI"]);
$fileName = end($uri);
$tabs = ["index.php", "latest_news.php", "aboutus.php", "contactus.php"];

if (in_array($fileName, $tabs)) {
    $_SESSION["activeNav"] = $fileName;
}

//RETRIVING STUDENTS DATA
$crudObject = new CRUD();

$studentId = $_SESSION["student_id"];

$studentData = fetchStudentData($studentId);

//FIRSTNAME AND LASTNAME FOR SHOWING IN HEADER
$firstName = $studentData[0]["first_name"];
$lastName = $studentData[0]["last_name"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Protal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../lib/css/style.css">
</head>

<body>
    <div class="height-100vh">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php"> <span class="fas fa-user-graduate fs-3"></span> StudentPortal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($_SESSION['activeNav'] == "index.php") {
                                                    echo "active";
                                                } ?>" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($_SESSION['activeNav'] == "latest_news.php") {
                                                    echo "active";
                                                } ?>" aria-current="page" href="./latest_news.php">Latest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($_SESSION['activeNav'] == "aboutus.php") {
                                                    echo "active";
                                                } ?>" aria-current="page" href="./aboutus.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($_SESSION['activeNav'] == "contactus.php") {
                                                    echo "active";
                                                } ?>" aria-current="page" href="./contactus.php">Contact us</a>
                        </li>
                    </ul>
                    <span class="text-light">Welcome , </span>
                    <div class="ms-2 dropdown d-inline-block d-sm-block">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $firstName . ' ' . $lastName; ?></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./student_profile.php">Profile</a></li>
                            <li><a id="studentLogoutBtn" class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>