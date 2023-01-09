<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["department_id"])) {
    $deleteId = $_GET["department_id"];

    $departmentObject = new Department();
    $deleteSucces = $departmentObject->deleteDepartment($deleteId);
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        Department has been deleted
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
            <table id="departmentTable" class="table table-bordered  table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $departmentObject = new Department();
                    $departmentData = $departmentObject->fetchDepartments();
                    $i = 0;
                    foreach ($departmentData as $department) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="text-primary"><?php echo $department['department_id']; ?></td>
                            <td><?php echo $department['department_name']; ?></td>
                            <td class="text-center">
                                <span id="e<?php echo $department["department_id"]; ?>" class="cursor-pointer editBtns fas fa-pen text-primary me-2"></span>
                                <span id="d<?php echo $department["department_id"]; ?>" class="cursor-pointer deleteBtns fas fa-trash-can text-danger ms-2"></span>
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


<script src="../../lib/js/manage_departments.js"></script>

<?php
require './footer.php';
?>