<?php

require $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';
require $_SERVER["DOCUMENT_ROOT"] . '/model/Constant.php';

$crudObject = new CRUD();
//CREATING HTML DATA FOR DEPARTMENT SELECT TAG
$departmentData = $crudObject->fetchDataSql('SELECT * FROM departments ORDER BY department_name');

$departmentSelect = null;
foreach ($departmentData as $department) {
    $departmentSelect .= "<option value='" . $department["department_id"] . "'>" . $department["department_name"] . "</option>";
}

//CREATING HTML DATA FOR COLLEGE SELECT TAG
$collegeSelect = null;

$collegeData = $crudObject->fetchDataSql('SELECT * FROM colleges ORDER BY college_name');
foreach ($collegeData as $college) {
    $collegeSelect .= "<option value='" . $college["college_id"] . "'>" . $college["college_name"] . ' - ' . $college["college_city"] . "</option>";
}

//CREATING HTML DATA FOR UNIVERSITY SELECT TAG
$universitySelect = null;

$universityData = $crudObject->fetchDataSql('SELECT * FROM universities ORDER BY university_name');
foreach ($universityData as $university) {
    $universitySelect .= "<option value='" . $university["university_id"] . "'>" . $university["university_name"] . "</option>";
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
    <style>

    </style>
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

                </div>
            </div>
        </nav>

        <div id="resultMessage" class="alert alert-danger" role="alert">
            <!-- FOR MESSAGE SHOWING -->
        </div>
        
        <div>
            <div id="login-container" class="d-flex justify-content-center">
                <div id="login-box" class="bg-dark rounded w-50 my-4">
                    <h2 class="text-center text-white p-2 border-bottom border-4">Student Registration</h2>
                    <form id="studentSignupForm" method="POST" class="p-3 text-light">
                        <div>
                            <label for="userName" class="form-label">Username </label>
                            <input type="text" name="userName" id="userName" class="form-control">
                            <div id="userNameErr" class="form-text text-danger"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="userPassword" class="form-label">Enter Password </label>
                                <input type="text" name="userPassword" id="userPassword" class="form-control">
                                <div id="userPasswordErr" class="form-text text-danger"></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="userConfirmPassword" class="form-label">Confirm Password </label>
                                <input type="text" name="userConfirmPassword" id="userConfirmPassword" class="form-control">
                                <div id="userConfirmPasswordErr" class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <label for="firstName" class="form-label">Name of the Student</label>
                            <div class="col-sm-4">
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Firstname">
                                <div id="firstNameErr" class="form-text text-danger"></div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Middlename">
                                <div id="middleNameErr" class="form-text text-danger"></div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Lastname">
                                <div id="lastNameErr" class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="gender">Gender : </label>
                            <input type="radio" name="gender" value="1" id="gMale" class="form-check-input">
                            <label for="gMale" class="form-check-label">Male</label>
                            <input type="radio" name="gender" value="2" id="gFeale" class="form-check-input">
                            <label for="gFeale" class="form-check-label">Female</label>
                            <div id="genderErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <div id="emailErr" class="form-text text-danger"></div>
                        </div>
                        <div class="mt-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control">
                            <div id="mobileErr" class="form-text text-danger"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select">
                                    <option value="" selected disabled>select department</option>
                                    <?php echo $departmentSelect; ?>
                                </select>
                                <div id="departmentErr" class="form-text text-danger"></div>
                            </div>
                            <div class="col-sm-4">
                                <label for="college" class="form-label">College</label>
                                <select name="college" id="college" class="form-select">
                                    <option value="" selected disabled>select college</option>
                                    <?php echo $collegeSelect; ?>
                                </select>
                                <div id="collegeErr" class="form-text text-danger"></div>
                            </div>
                            <div class="col-sm-4">
                                <label for="university" class="form-label">University</label>
                                <select name="university" id="university" class="form-select">
                                    <option value="" selected disabled>select university</option>
                                    <?php echo $universitySelect; ?>
                                </select>
                                <div id="universityErr" class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="profilePicture" class="form-label">Profile Picture</label>
                            <input type="file" name="profilePicture" id="profilePicture" class="form-control">
                            <div id="profilePictureErr" class="form-text text-danger"></div>
                            <img id="profilePreview" src="" alt="Profile Preview" height="150" width="250">
                        </div>
                        <div class="mt-4 text-center">
                            <button id="signupBtn" type="submit" class="btn btn-outline-light w-25">Signup</button>
                            <div class="mt-1">
                                <a href="./login.php" class="text-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../lib/js/student_signup.js"></script>
</body>

</html>