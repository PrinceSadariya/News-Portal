<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["college_id"])) {
    $deleteId = $_GET["college_id"];

    $studentObject = new Student();
    $studentData = $studentObject->fetchStudents('*', ["college" => $deleteId]);

    if (empty($studentData)) {
        $collegeObject = new College();
        $deleteSucces = $collegeObject->deleteCollege($deleteId);
        $deleteMsg = "College has been deleted";
    } else {
        $deleteMsg = "Operation not permitted, because this college assigned under student's data";
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
            echo "College has been inserted successfully";
        } elseif ($_GET["success_msg"] == "update") {
            echo "College has been updated successfully";
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">College List</h2>
        <div class="text-end">
            <a href="./insert_college.php" class="btn btn-primary"> <span class="fas fa-plus"></span> Add College</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table id="collegeTable" class="cell-border order-column hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>College ID</th>
                        <th>College Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $collegeObject = new College();
                    $collegeData = $collegeObject->fetchColleges();
                    $i = 0;
                    foreach ($collegeData as $college) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="text-primary"><?php echo $college['college_id']; ?></td>
                            <td><?php echo $college['college_name']; ?></td>
                            <td><?php echo $college['college_city']; ?></td>
                            <td><?php echo $college['college_state']; ?></td>
                            <td class="text-center">
                                <span id="e<?php echo $college["college_id"]; ?>" class="cursor-pointer editBtns fas fa-pen text-primary me-2"></span>
                                <span id="d<?php echo $college["college_id"]; ?>" class="cursor-pointer deleteBtns fas fa-trash-can text-danger ms-2"></span>
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

<script src="../../lib/js/manage_colleges.js"></script>

<?php
require './footer.php';
?>