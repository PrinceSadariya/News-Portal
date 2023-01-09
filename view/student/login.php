<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/model/Constant.php';
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

</head>

<body>
    <div id="student-container">

        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Student Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </div>
            </div>
        </nav>
        <div>
            <div id="login-container" class="d-flex justify-content-center align-items-center">
                <div id="login-box" class="bg-dark rounded">
                    <h2 class="text-center text-white p-2 border-bottom border-4">Student Login</h2>

                    <!-- ERROR MESSAGE SHOWING -->
                    <div class="px-2">
                        <div id="errorMsg" class="alert alert-danger" role="alert"></div>
                    </div>
                    
                    <form id="studentLoginForm" method="POST" class="p-3">
                        <div class="mt-2">
                            <input type="text" name="userEmail" id="userEmail" class="form-control" placeholder="Enter Email">
                            <div id="userEmailErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mt-2">
                            <input type="text" name="userPassword" id="userPassword" class="form-control" placeholder="Enter your password">
                            <div id="userPasswordErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <button id="loginBtn" type="submit" class="btn btn-light w-100">Login</button>
                            <a href="./signup.php" class="btn btn-outline-light w-100 mt-2">Signup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../lib/js/student_login.js"></script>
</body>

</html>