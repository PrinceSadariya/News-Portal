<?php
require './header.php';

//ERROR HANDLING
$collegeId = null;
$collegeName = null;
$collegeCity = null;
$collegeState = null;

if (isset($_GET['college_id'])) {
    $collegeId = $_GET['college_id'];

    $collegeObject = new College();

    $collegeData = $collegeObject->fetchColleges('*', ["college_id" => $collegeId]);

    $collegeName = $collegeData[0]["college_name"];
    $collegeCity = $collegeData[0]["college_city"];
    $collegeState = $collegeData[0]["college_state"];
}

?>

<div class="p-3">
    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <!-- PAGE TITLE  -->
    <div>
        <h2 class="text-center text-decoration-underline">
            <?php if (isset($_GET["college_id"])) {
                echo "Edit College Detail";
            } else {
                echo "Add College";
            }  ?>
        </h2>
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="collegeForm" method="POST">
                <div class="row mt-3">
                    <label for="collegeName" class="col-sm-2 col-form-label">College Name : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="collegeId" value="<?php echo $collegeId; ?>">
                        <input type="text" name="collegeName" id="collegeName" class="form-control" value="<?php echo $collegeName; ?>">
                        <div id="collegeNameErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="collegeCity" class="col-sm-2 col-form-label">City : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" name="collegeCity" id="collegeCity" class="form-control" value="<?php echo $collegeCity; ?>">
                        <div id="collegeCityErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="collegeState" class="col-sm-2 col-form-label">State : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" name="collegeState" id="collegeState" class="form-control" value="<?php echo $collegeState; ?>">
                        <div id="collegeStateErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" id="addCollegeBtn" class="btn btn-success mx-1">Save</button>
                        <a href="./manage_colleges.php" class="btn btn-outline-danger mx-1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../lib/js/insert_college.js"></script>
<?php
require './footer.php';
?>