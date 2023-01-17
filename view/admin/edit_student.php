<?php
require './header.php';

if (isset($_GET["student_id"])) {
    $studentId = $_GET["student_id"];

    $crudObject = new CRUD();

    $studentData = fetchStudentData($studentId);

    $userName = $studentData[0]["user_name"];
    $firstName = $studentData[0]["first_name"];
    $lastName = $studentData[0]["last_name"];
    $middleName = $studentData[0]["middle_name"];
    $gender = $studentData[0]["gender"];
    $email = $studentData[0]["email"];
    $password = $studentData[0]["user_password"];
    $mobile = $studentData[0]["mobile"];
    $college = $studentData[0]["college_name"];
    $collegeId = $studentData[0]["college_id"];
    $department = $studentData[0]["department_name"];
    $departmentId = $studentData[0]["department_id"];
    $university = $studentData[0]["university_name"];
    $universityId = $studentData[0]["university_id"];

    //FOR DEPARTMENT SELECT TAG
    $departmentSelect = null;

    $departmentData = fetchDepartmentData();
    foreach ($departmentData as $department) {
        if ($department["department_id"] == $departmentId) {
            $departmentSelect .= "<option value='" . $department["department_id"] . "' selected>" . $department["department_name"] . "</option>";
        } else {
            $departmentSelect .= "<option value='" . $department["department_id"] . "'>" . $department["department_name"] . "</option>";
        }
    }

    //FOR COLLEGE SELECT TAG
    $collegeSelect = null;

    $collegeData = fetchCollegeData();
    foreach ($collegeData as $college) {
        if ($college["college_id"] == $collegeId) {
            $collegeSelect .= "<option value='" . $college["college_id"] . "' selected>" . $college["college_name"] . "</option>";
        } else {
            $collegeSelect .= "<option value='" . $college["college_id"] . "'>" . $college["college_name"] . "</option>";
        }
    }

    //FOR UNIVERSITY SELECT TAG
    $universitySelect = null;

    $universityData = fetchUniversityData();
    foreach ($universityData as $university) {
        if ($university["university_id"] == $universityId) {
            $universitySelect .= "<option value='" . $university["university_id"] . "' selected>" . $university["university_name"] . "</option>";
        } else {
            $universitySelect .= "<option value='" . $university["university_id"] . "'>" . $university["university_name"] . "</option>";
        }
    }
}
?>

<div class="p-3">
    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <div>
        <h2 class="text-center text-decoration-underline">
            Edit Student Detail
        </h2>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="editStudent_Admin" method="POST">
                <div>
                    <label for="userName" class="form-label">Username </label>
                    <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                    <input type="text" name="userName" id="userName" class="form-control" value="<?php echo $userName; ?>">
                    <div id="userNameErr" class="form-text text-danger"></div>
                </div>
                <div class="mt-3">
                    <label for="userPassword" class="form-label">Password </label>
                    <input type="text" name="userPassword" id="userPassword" class="form-control" value="<?php echo $password; ?>">
                    <div id="userPasswordErr" class="form-text text-danger"></div>
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

                <div class="text-center mt-4">
                    <button type="submit" id="saveStudentDetail" class="btn btn-success mx-1">Save</button>
                    <a href="./manage_students.php" class="btn btn-outline-danger mx-1">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../lib/js/edit_student_admin.js"></script>
<?php
require './footer.php';
?>