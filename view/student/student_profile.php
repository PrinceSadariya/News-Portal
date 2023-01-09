<?php
require './header.php';
?>
<div class="container px-0 bg-light my-2">

    <!-- FOR PROFILE CHANGE SUCCESS MESSAGE SHOWING  -->
    <?php
    if (isset($_GET["profile"]) && $_GET["profile"] == "change") {
    ?>
        <div id="resultMsg" class="alert alert-success alert-dismissible fade show" role="alert">
            Your profile picture has been changed
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
                        <img id="editProfileImage" class="rounded" src="../../lib/images/student_profile/medium/<?php echo $studentProfilePicture; ?>" alt="">
                    </div>
                    <div class="mt-2">
                        <form id="profileChangeForm" action="" method="POST">
                            <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
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

    <div>
        <h2 class="text-center text-decoration-underline">My Profile</h2>
    </div>

    <div class="container px-0 bg-light border rounded  border-4 border-dark">
        <div id="profile-dark-back" class="bg-dark">

        </div>
        <div class="d-flex justify-content-center">
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#profileModal">

                <img id="studentDP" class="rounded-circle" src="../../lib/images/student_profile/small/<?php echo $studentProfilePicture; ?>" alt="">
            </a>

        </div>
        <div class="text-center">
            <p class="fs-5 my-0"><?php echo $userName; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">

                <table class="table table-borderless">
                    <tr>
                        <th>Firstname</th>
                        <th class="text-center">:</th>
                        <td><?php echo $firstName; ?></td>
                    </tr>
                    <tr>
                        <th>Middlename</th>
                        <th class="text-center">:</th>
                        <td><?php echo $middleName; ?></td>
                    </tr>
                    <tr>
                        <th>Lastname</th>
                        <th class="text-center">:</th>
                        <td><?php echo $lastName; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <th class="text-center">:</th>
                        <td><?php echo $userName; ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <th class="text-center">:</th>
                        <td><?php echo ($gender == 1 ? "Male" : "Female"); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th class="text-center">:</th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <th class="text-center">:</th>
                        <td><?php echo $password[0] . '******' . $password[strlen($password) - 1]; ?></td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <th class="text-center">:</th>
                        <td><?php echo $mobile; ?></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <th class="text-center">:</th>
                        <td><?php echo $department; ?></td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <th class="text-center">:</th>
                        <td><?php echo $college; ?></td>
                    </tr>
                    <tr>
                        <th>University</th>
                        <th class="text-center">:</th>
                        <td><?php echo $university; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2">

            </div>
        </div>
        <div class="text-center mb-3">
            <a href="./edit_profile.php" class="btn btn-outline-primary">Edit Profile</a>
            <a href="./change_password.php" class="btn btn-outline-primary">Change Password</a>
            <a href="./<?php echo $_SESSION["activeNav"]; ?>" class="btn btn-outline-danger">Back</a>
        </div>
    </div>
</div>

<script src="../../lib/js/student_profile.js"></script>
<?php
require './footer.php';
?>