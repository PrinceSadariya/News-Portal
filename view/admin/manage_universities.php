<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["university_id"])) {
    $deleteId = $_GET["university_id"];

    $universityObject = new University();
    $deleteSucces = $universityObject->deleteUniversity($deleteId);
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        University has been deleted
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
            <table class="table table-bordered table-hover">
                <tr>
                    <th>#</th>
                    <th>University ID</th>
                    <th>University Name</th>
                    <th>City</th>
                    <th>State</th>
                    <th class="text-center">Action</th>
                </tr>

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
            </table>
        </div>
    </div>
</div>

<script src="../../lib/js/manage_universities.js"></script>

<?php
require './footer.php';
?>