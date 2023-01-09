<?php
require './header.php';

//FOR ERROR HANDLING
$bannerId = null;
$bannerImage = null;
$bannerTitle = null;
$bannerStatus = null;

if (isset($_GET["banner_id"])) {
    $bannerId = $_GET["banner_id"];

    $bannerObject = new Banner();

    $bannerData = $bannerObject->fetchBanner('*', ["banner_id" => $bannerId]);

    $bannerImage = $bannerData[0]["banner_image"];
    $bannerTitle = $bannerData[0]["banner_title"];
    $bannerStatus = $bannerData[0]["banner_status"];
}
?>

<div class="p-3">

    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <!-- PAGE TITLE -->
    <div>
        <h2 class="text-center text-decoration-underline">
            <?php if (isset($_GET["banner_id"])) {
            ?>
                Edit Banner Detail
            <?php
            } else {
            ?>
                Add Banner
            <?php
            }  ?>
        </h2>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="bannerForm" method="POST">
                <div class="row mt-3">
                    <label for="bannerTitle" class="col-sm-2 col-form-label">Banner Title : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="bannerId" value="<?php echo $bannerId; ?>">
                        <input type="text" name="bannerTitle" id="bannerTitle" class="form-control" value="<?php echo $bannerTitle; ?>">
                        <div id="bannerTitleErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="bannerImage" class="col-sm-2 col-form-label">Banner Image : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="file" name="bannerImage" id="bannerImage" class="form-control" value="">
                        <img id="bannerImagePreview" src="<?php if (isset($_GET["banner_id"])) {
                                                                echo '../../lib/images/banner/' . $bannerImage;
                                                            } ?>" height="150" width="250" class="mt-2" alt="Banner Image">
                        <div id="bannerImageErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label class="col-sm-2 col-form-label">Status : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <div class="mt-2">
                            <input class="form-check-input" type="radio" name="bannerStatus" id="bannerActive" value="1" <?php if ($bannerStatus == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                            <label class="form-check-label" for="bannerActive">
                                Active
                            </label>
                            <input class="form-check-input" type="radio" name="bannerStatus" id="bannerInactive" value="2" <?php if ($bannerStatus == 2) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                            <label class="form-check-label" for="bannerInactive">
                                Inactive
                            </label>
                            <div id="bannerStatusErr" class="form-text text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" id="addBannerBtn" class="btn btn-success mx-1">Save</button>
                        <a href="./manage_banners.php" class="btn btn-outline-danger mx-1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // SET UPDATE VARIABLE FOR JAVASCRIPT
    const update = <?php if (isset($_GET["banner_id"])) {
                        echo 'true';
                    } else {
                        echo 'false';
                    }
                    ?>
</script>

<script src="../../lib/js/insert_banner.js"></script>
<?php
require './footer.php';
?>