<?php
require './header.php';

//OLD DATA RETRIVING
$userName = $studentData[0]["user_name"];
$middleName = $studentData[0]["middle_name"];
$gender = $studentData[0]["gender"];
$password = $studentData[0]["user_password"];
$studentProfilePicture = $studentData[0]["profile_picture"];
$email = $studentData[0]["email"];
$mobile = $studentData[0]["mobile"];
$college = $studentData[0]["college_name"];
$collegeId = $studentData[0]["college_id"];
$department = $studentData[0]["department_name"];
$departmentId = $studentData[0]["department_id"];
$university = $studentData[0]["university_name"];
$universityId = $studentData[0]["university_id"];

$crudObject = new CRUD();

//RETRIVING VALUE FOR DEPARTMENT SELECT TAG
$departmentData = fetchDepartmentData();

$departmentSelect = null;
foreach ($departmentData as $department) {
    if ($department["department_id"] == $departmentId) {
        $departmentSelect .= "<option value='" . $department["department_id"] . "' selected>" . $department["department_name"] . "</option>";
    } else {
        $departmentSelect .= "<option value='" . $department["department_id"] . "'>" . $department["department_name"] . "</option>";
    }
}

//RETRIVING VALUE FOR COLLEGE SELECT TAG
$collegeSelect = null;

$collegeData = fetchCollegeData();
foreach ($collegeData as $college) {
    if ($college["college_id"] == $collegeId) {
        $collegeSelect .= "<option value='" . $college["college_id"] . "' selected>" . $college["college_name"] . ' - ' . $college["college_city"] . "</option>";
    } else {
        $collegeSelect .= "<option value='" . $college["college_id"] . "'>" . $college["college_name"] . ' - ' . $college["college_city"] . "</option>";
    }
}

//RETRIVING VALUE FOR UNIVERSITY SELECT TAG
$universitySelect = null;

$universityData = fetchUniversityData();
foreach ($universityData as $university) {
    if ($university["university_id"] == $universityId) {
        $universitySelect .= "<option value='" . $university["university_id"] . "' selected>" . $university["university_name"] . "</option>";
    } else {
        $universitySelect .= "<option value='" . $university["university_id"] . "'>" . $university["university_name"] . "</option>";
    }
}

?>

<div id="edit-container">
    <div id="resultMessage" class="alert alert-warning" role="alert">

    </div>
    <div>
        <div class="d-flex justify-content-center">
            <div id="edit-box" class="bg-dark rounded w-50 my-4">
                <h2 class="text-center text-white p-2 border-bottom border-4">Edit Profile</h2>
                <form id="editProfileForm" method="POST" class="p-3 text-light">
                    <div>
                        <label for="userName" class="form-label">Username </label>
                        <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                        <input type="text" name="userName" id="userName" class="form-control" value="<?php echo $userName; ?>">
                        <div id="userNameErr" class="form-text text-danger"></div>
                    </div>
                    <div class="mt-3 row">
                        <label for="firstName" class="form-label">Name of the Student</label>
                        <div class="col-sm-4">
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Firstname" value="<?php echo $firstName; ?>">
                            <div id="firstNameErr" class="form-text text-danger"></div>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Middlename" value="<?php echo $middleName; ?>">
                            <div id="middleNameErr" class="form-text text-danger"></div>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Lastname" value="<?php echo $lastName; ?>">
                            <div id="lastNameErr" class="form-text text-danger"></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="gender">Gender : </label>
                        <input type="radio" name="gender" id="gMale" value="1" class="form-check-input" <?php if ($gender == "1") {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                        <label for="gMale" class="form-check-label">Male</label>
                        <input type="radio" name="gender" id="gFeale" value="2" class="form-check-input" <?php if ($gender == "2") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                        <label for="gFeale" class="form-check-label">Female</label>
                        <div id="genderErr" class="form-text text-danger"></div>
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
                        <div id="emailErr" class="form-text text-danger"></div>
                    </div>
                    <div class="mt-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="tel" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile; ?>">
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
                    <div class="mt-4 text-center">
                        <button id="editProfileBtn" type="submit" class="btn btn-outline-light w-25">Save</button>
                        <div class="mt-1">
                            <a href="./student_profile.php" class="text-light">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../../lib/js/edit_student.js"></script>

<?php require './footer.php'; ?>