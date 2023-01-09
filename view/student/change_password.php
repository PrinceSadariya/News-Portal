<?php
require './header.php';
?>

<div class="container p-3">

    <div class="mt-4 row bg-light rounded shadow p-3 w-100">

        <div id="resultMsg" class="alert alert-warning " role="alert">
            <!-- MESSAGE SHOWING FOR AJAX RESPONSE -->
        </div>
        
        <div class="col-md-8">
            <div class="text-center">
                <h2>Change Password</h2>
                <div class="mt-4 text-muted">
                    <p>Password must contain</p>
                    <div class="mt-2 ">
                        <div>
                            <span class="fas fa-check text-success"></span><span> at lease one uppercase</span>
                        </div>
                        <div>
                            <span class="fas fa-check text-success"></span><span> at lease one lowercase</span>
                        </div>
                        <div>
                            <span class="fas fa-check text-success"></span><span> at lease one number</span>
                        </div>
                        <div>
                            <span class="fas fa-check text-success"></span><span> at lease 8 character</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <form id="changePassForm" method="post" class="text-center">
                <div class="mb-3">
                    <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                    <label for="oldPassword" class="form-label">Enter Your Current Password</label>
                    <input type="text" name="oldPassword" id="oldPassword" class="form-control">
                    <div id="oldPasswordErr" class="text-danger form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="text" name="newPassword" id="newPassword" class="form-control">
                    <div id="newPasswordErr" class="text-danger form-text"></div>

                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="text" name="confirmPassword" id="confirmPassword" class="form-control">
                    <div id="confirmPasswordErr" class="text-danger form-text"></div>
                </div>
                <div>
                    <button type="submit" id="changePassBtn" class="btn btn-primary w-100">Save</button>
                </div>
                <div class="mt-2">
                    <a href="./student_profile.php" class="text-dark">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../lib/js/change_password.js"></script>
<?php
require './footer.php';
?>