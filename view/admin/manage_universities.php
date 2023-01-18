<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["university_id"])) {
    $deleteId = $_GET["university_id"];

    $studentObject = new Student();
    $studentData = $studentObject->fetchStudents('student_id', ["university" => $deleteId]);

    if (empty($studentData)) {
        $universityObject = new University();
        $deleteSucces = $universityObject->deleteUniversity($deleteId);
        $deleteMsg = "University has been deleted";
    } else {
        $deleteMsg = "Operation not permitted, because this university assigned under student's data";
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
            echo "University has been inserted successfully";
        } elseif ($_GET["success_msg"] == "update") {
            echo "University has been updated successfully";
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">University List</h2>
        <div class="text-end">
            <a href="./insert_university.php" class="btn btn-primary"> <span class="fas fa-plus"></span> Add University</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table id="universityTable" class="cell-border order-column hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>University ID</th>
                        <th>University Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $universityObject = new University();
                    $universityData = $universityObject->fetchUniversities();
                    $i = 0;
                    foreach ($universityData as $university) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="text-primary"><?php echo $university['university_id']; ?></td>
                            <td><?php echo $university['university_name']; ?></td>
                            <td><?php echo $university['university_city']; ?></td>
                            <td><?php echo $university['university_state']; ?></td>
                            <td class="text-center">
                                <span id="e<?php echo $university["university_id"]; ?>" class="cursor-pointer editBtns fas fa-pen text-primary me-2"></span>
                                <span id="d<?php echo $university["university_id"]; ?>" class="cursor-pointer deleteBtns fas fa-trash-can text-danger ms-2"></span>
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

<script src="../../lib/js/manage_universities.js"></script>

<?php
require './footer.php';
?>