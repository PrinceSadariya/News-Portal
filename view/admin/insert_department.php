<?php
require './header.php';

//ERROR HANDLING
$departmentId = null;
$departmentName = null;

if (isset($_GET['department_id'])) {
    $departmentId = $_GET['department_id'];

    $departmentObject = new Department();

    $departmentData = $departmentObject->fetchDepartments('department_name', ["department_id" => $departmentId]);

    $departmentName = $departmentData[0]["department_name"];
}

?>

<div class="p-3">
    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <!-- PAGE TITLE -->
    <div>
        <h2 class="text-center text-decoration-underline">
            <?php if (isset($_GET["department_id"])) {
                echo "Edit Department Detail";
            } else {
                echo "Add Department";
            }  ?>
        </h2>
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="departmentForm" method="POST">
                <div class="row mt-3">
                    <label for="departmentName" class="col-sm-2 col-form-label">Department Name : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="departmentId" value="<?php echo $departmentId; ?>">
                        <input type="text" name="departmentName" id="departmentName" class="form-control" value="<?php echo $departmentName; ?>">
                        <div id="departmentNameErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" id="addDepartmentBtn" class="btn btn-success mx-1">Save</button>
                        <a href="./manage_departments.php" class="btn btn-outline-danger mx-1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../lib/js/insert_department.js"></script>
<?php
require './footer.php';
?>