<?php
require './header.php';

//CHECKING FOR SUPERADMIN
$superAdmin = false;
if (isset($_SESSION["superAdmin"]) && $_SESSION["superAdmin"] === true) {
    $superAdmin = true;
}

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["banner_id"])) {
    $deleteId = $_GET["banner_id"];

    $bannerObject = new Banner();
    $bannerData = $bannerObject->fetchBanner('*', ["banner_id" => $deleteId]);

    $bannerImage = $bannerData[0]["banner_image"];

    $deleteSucces = $bannerObject->deleteBanner($deleteId);

    if ($deleteSucces) {
        unlink("../../lib/images/banner/" . $bannerImage);
    }
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        Banner has been deleted
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
if (isset($_GET["success_msg"])) {
?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <?php
        if ($_GET["success_msg"] == "insert") {
            echo "Banner has been inserted successfully";
        } elseif ($_GET["success_msg"] == "update") {
            echo "Banner has been updated successfully";
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">Banner List</h2>
        <div class="text-end">
            <a href="./insert_banner.php" class="btn btn-primary <?php if (!$superAdmin) {
                                                                        echo " disabled ";
                                                                    } ?>"> <span class="fas fa-plus"></span> Add Banner</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table id="bannerTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Banner Image</th>
                        <th>Banner Title</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $bannerObject = new Banner();
                    $allBanner = $bannerObject->fetchBanner();

                    //CHECKING SUPER ADMIN LOGIN
                    $accessBlock = null;
                    $actionClass = " cursor-pointer ";
                    if (!$superAdmin) {
                        $accessBlock = " disabled ";
                        $actionClass = " opacity-25 ";
                    }
                    $i = 0;
                    foreach ($allBanner as $banner) {
                        if ($banner["banner_status"] == 1) {
                            $switchBtn = '<div class="form-check form-switch d-flex justify-content-center">
                        <input class="bannerStatusSwitch form-check-input" type="checkbox" role="switch" id="s' . $banner["banner_id"] . '" checked ' . $accessBlock . '>
                        </div>';
                        } else if ($banner["banner_status"] == 2) {
                            $switchBtn = '<div class="form-check form-switch d-flex justify-content-center">
                        <input class="bannerStatusSwitch form-check-input" type="checkbox" role="switch" id="s' . $banner["banner_id"] . '" ' . $accessBlock . '>
                        </div>';
                        }


                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../../lib/images/banner/<?php echo $banner["banner_image"]; ?>" alt="Banner Image" height="100" width="150"></td>
                            <td><?php echo $banner["banner_title"]; ?></td>
                            <td><?php echo $switchBtn ?></td>

                            <td class="text-center">
                                <span id="e<?php echo $banner["banner_id"]; ?>" class="<?php echo $actionClass; ?> editBtns fas fa-pen text-primary me-2"></span>
                                <span id="d<?php echo $banner["banner_id"]; ?>" class="<?php echo $actionClass; ?> deleteBtns fas fa-trash-can text-danger ms-2"></span>
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

<script>
    let superAdmin = false;
    <?php
    if ($superAdmin) {
    ?>
        superAdmin = true;
    <?php
    }
    ?>
</script>
<script src="../../lib/js/manage_banner.js"></script>

<?php
require './footer.php';
?>