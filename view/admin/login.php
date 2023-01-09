<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../model/Constant.php';

//CHECKING FOR LOGIN
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: " . SITE_URL . "/view/admin/index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../lib/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-4 border-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="./login.php">Student Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./dashboard.php">Home</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <div class="bg-gradiant">
            <div id="login-container" class="d-flex justify-content-center align-items-center">
                <div class="bg-dark text-white p-3 rounded w-25">
                    <h3 id="loginHeading" class="text-center">Login</h3>

                    <div id="errorMsg" class="alert alert-danger" role="alert">
                        <!-- ALERT FOR ERROR MESSAGES SHOWING OF SREVER SIDE VALIDATION -->
                    </div>

                    <?php
                    if (isset($_GET["access_msg"]) && $_GET["access_msg"] == true) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Please login here
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>

                    <form id="loginForm" method="post">
                        <div class="mb-3">
                            <select name="userRole" id="userRole" class="form-select">
                                <option value="" selected disabled>Select your role</option>
                                <option value="1">Admin</option>
                                <option value="2">SuperAdmin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="text" name="userEmail" id="userEmail" class="form-control">
                            <div id="userEmailErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="text" name="userPassword" id="userPassword" class="form-control">
                            <div id="userPasswordErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" name="loginBtn" id="loginBtn" class="btn btn-outline-primary w-25">Login</button>
                        </div>
                        <div class="text-center mt-2">
                            <a href="./signup_admin.php" class="text-light">Signup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../lib/js/admin_login.js"></script>
</body>

</html>