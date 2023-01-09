<?php
require './header.php';

//ERROR HANDLING
$universityId = null;
$universityName = null;
$universityCity = null;
$universityState = null;

if (isset($_GET['university_id'])) {
    $universityId = $_GET['university_id'];

    $universityObject = new University();

    $universityData = $universityObject->fetchUniversities('*', ["university_id" => $universityId]);

    $universityName = $universityData[0]["university_name"];
    $universityCity = $universityData[0]["university_city"];
    $universityState = $universityData[0]["university_state"];
}

?>

<div class="p-3">
    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <!-- PAGE TITLE -->
    <div>
        <h2 class="text-center text-decoration-underline">
            <?php if (isset($_GET["university_id"])) {
                echo "Edit University Detail";
            } else {
                echo "Add University";
            }  ?>
        </h2>
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="universityForm" method="POST">
                <div class="row mt-3">
                    <label for="universityName" class="col-sm-2 col-form-label">University Name : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="universityId" value="<?php echo $universityId; ?>">
                        <input type="text" name="universityName" id="universityName" class="form-control" value="<?php echo $universityName; ?>">
                        <div id="universityNameErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="universityCity" class="col-sm-2 col-form-label">City : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" name="universityCity" id="universityCity" class="form-control" value="<?php echo $universityCity; ?>">
                        <div id="universityCityErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="universityState" class="col-sm-2 col-form-label">State : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" name="universityState" id="universityState" class="form-control" value="<?php echo $universityState; ?>">
                        <div id="universityStateErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" id="addUniversityBtn" class="btn btn-success mx-1">Save</button>
                        <a href="./manage_universities.php" class="btn btn-outline-danger mx-1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../lib/js/insert_university.js"></script>
<?php
require './footer.php';
?>