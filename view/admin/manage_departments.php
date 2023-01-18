<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["department_id"])) {
    $deleteId = $_GET["department_id"];

    $studentObject = new Student();
    $studentData = $studentObject->fetchStudents('student_id', ["department" => $deleteId]);

    if (empty($studentData)) {
        $departmentObject = new Department();
        $deleteSucces = $departmentObject->deleteDepartment($deleteId);
        $deleteMsg = "Department has been deleted";
    } else {
        $deleteMsg = "Operation not permitted, because this department assigned under student's data";
        $deleteSucces = true;
    }
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <?php echo $deleteMsg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}

if (isset($_GET["success_msg"])) {
?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <?php
        if ($_GET["success_msg"] == "insert") {
            echo "Department has been inserted successfully";
        } elseif ($_GET["success_msg"] == "update") {
            echo "Department has been updated successfully";
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">Department List</h2>
        <div class="text-end">
            <a href="./insert_department.php" class="btn btn-primary"> <span class="fas fa-plus"></span> Add Department</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table id="departmentTable" class="cell-border order-column hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                  
                </tbody>

            </table>
        </div>
    </div>
</div>


<script src="../../lib/js/manage_departments.js"></script>

<?php
require './footer.php';
?>