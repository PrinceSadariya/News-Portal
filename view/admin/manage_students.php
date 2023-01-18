<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

//CHECKING FOR SUPERADMIN
$superAdmin = false;
if (isset($_SESSION["superAdmin"]) && $_SESSION["superAdmin"] === true) {
    $superAdmin = true;
}

if (isset($_GET["student_id"])) {
    $studentId = $_GET["student_id"];

    $studentObject = new Student();

    $studentData = $studentObject->fetchStudents('profile_picture', ["student_id" => $studentId]);

    $studentProfile = $studentData[0]["profile_picture"];

    $deleteSucces = $studentObject->deleteStudent($studentId);

    // DELETING STUDENT'S PROFILE PICTURES
    if ($deleteSucces) {
        unlink("../../lib/images/student_profile/small/" . $studentProfile);
        unlink("../../lib/images/student_profile/medium/" . $studentProfile);
        unlink("../../lib/images/student_profile/large/" . $studentProfile);
    }
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        Student Data has been deleted
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
if (isset($_GET["success_msg"])) {
?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <?php
        if ($_GET["success_msg"] == "update") {
            echo "Student data has been updated successfully";
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
if (isset($_GET["profile"]) && $_GET["profile"] == "change") {
?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        Student Profile has been changed
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<!-- MODAL FOR PROFILE IMAGE -->
<div class="modal fade" id="profileModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div id="modalMsg" class="alert alert-warning" role="alert">
                <!-- MESSAGE FOR AJAX RESPONSE -->
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <img id="currentProfile" class="rounded" src="" alt="Profile Image">
                </div>
                <div class="mt-2">
                    <form id="profileChangeForm" action="" method="POST">
                        <input type="hidden" id="studentId" name="studentId" value="">
                        <input type="file" name="profilePicture" id="profilePicture" class="form-control">
                        <div id="profilePictureErr" class="form-text text-danger"></div>
                </div>
                <div class="mt-1 text-end">
                    <button id="changeProfileBtn" type="submit" class="btn btn-success">Change</button>
                    <button id="modalBackBtn" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Back</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">Students List</h2>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table id="studentTable" class="cell-border order-column hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Gender</th>
                        <th>Password</th>
                        <th>Contact Information</th>
                        <th>Education Details</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    //ACCESS BLOCK
                    if ($superAdmin) {
                        $accessBlock = " cursor-pointer ";
                    } else {
                        $accessBlock = " opacity-25 ";
                    }
                    $crudObject = new CRUD();

                    $studentData = fetchStudentData();
                    $i = 0;
                    foreach ($studentData as $student) {
                        $i++;
                        if ($student["gender"] == 1) {
                            $gender = "Male";
                        } else {
                            $gender = "Female";
                        }
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <img id="dp<?php echo $student["student_id"]; ?> " height="150" width="150" class="studentProfilePicture rounded-circle <?php if ($superAdmin) {
                                                                                                                                                            echo " cursor-pointer ";
                                                                                                                                                        } ?>" src="../../lib/images/student_profile/small/<?php echo $student["profile_picture"]; ?>" alt="Profile Picture">
                            </td>
                            <td><?php echo $student["user_name"]; ?></td>
                            <td>
                                <p><span class="fw-bold">Firstname : </span><?php echo $student["first_name"]; ?></p>
                                <p><span class="fw-bold">Middlename : </span><?php echo $student["middle_name"]; ?></p>
                                <p><span class="fw-bold">Lastname : </span><?php echo $student["last_name"]; ?></p>
                            </td>
                            <td><?php echo $gender; ?></td>
                            <td><?php echo $student["user_password"]; ?></td>
                            <td>
                                <p><span class="fw-bold">Email : </span><?php echo $student["email"]; ?></p>
                                <p><span class="fw-bold">Mobile : </span><?php echo $student["mobile"]; ?></p>

                            </td>
                            <td>
                                <p> <span class="fw-bold">Department : </span> <?php echo $student["department_name"]; ?></p>
                                <p> <span class="fw-bold">College : </span> <?php echo $student["college_name"]; ?></p>
                                <p> <span class="fw-bold">University : </span> <?php echo $student["university_name"]; ?></p>
                            </td>
                            <td class="text-center">

                                <span id="e<?php echo $student["student_id"]; ?>" class=" editBtns fas fa-pen text-primary me-2 <?php echo $accessBlock; ?>"></span>
                                <span id="d<?php echo $student["student_id"]; ?>" class=" deleteBtns fas fa-trash-can text-danger ms-2 <?php echo $accessBlock; ?>"></span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let superAdmin = false;
    <?php
    if ($superAdmin) {
    ?>
        superAdmin = true;
    <?php
    }
    ?>
</script>
<script src="../../lib/js/manage_student.js"></script>

<?php
require './footer.php';
?>