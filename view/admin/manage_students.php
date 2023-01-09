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

    $studentData = $studentObject->fetchStudents('*', ["student_id" => $studentId]);

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
?>

<!-- MODAL FOR PROFILE IMAGE -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Back</button>
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
            <table class="table table-bordered table-hover">
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
                <?php
                //ACCESS BLOCK
                if (!$superAdmin) {
                    $accessBlock = " opacity-25 ";
                } else {
                    $accessBlock = " cursor-pointer ";
                }
                $crudObject = new CRUD();

                $studentData = $crudObject->fetchDataSql("SELECT * FROM students JOIN departments ON students.department = departments.department_id JOIN colleges ON students.college = colleges.college_id JOIN universities ON students.university = universities.university_id");
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
                        <td><?php echo $student["first_name"] . ' ' . $student["middle_name"] . ' ' . $student["last_name"]; ?></td>
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