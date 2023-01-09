<?php
require './header.php';

//FOR ERROR HANDLING
$newsId = null;
$newsImage = null;
$newsTitle = null;
$newsDetail = null;
$sortOrder = null;

if (isset($_GET["news_id"])) {
    $newsId = $_GET["news_id"];

    $newsObject = new News();

    $newsData = $newsObject->fetchNews('*', ["news_id" => $newsId]);

    $newsImage = $newsData[0]["news_image"];
    $newsTitle = $newsData[0]["news_title"];
    $newsDetail = $newsData[0]["news_detail"];
    $sortOrder = $newsData[0]["sort_order"];
}
?>

<div class="p-3">
    <div id="resultMessage" class="alert alert-warning">
        <!-- FOR MESSAGE SHOWING -->
    </div>

    <!-- PAGE TITLE -->
    <div>
        <h2 class="text-center text-decoration-underline">
            <?php if (isset($_GET["news_id"])) {
            ?>
                Edit News Detail
            <?php
            } else {
            ?>
                Add News
            <?php
            }  ?>
        </h2>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <div class="w-75">
            <form id="newsForm" method="POST">
                <div class="row mt-3">
                    <label for="newsTitle" class="col-sm-2 col-form-label">News Title : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="newsId" value="<?php echo $newsId; ?>">
                        <input type="text" name="newsTitle" id="newsTitle" class="form-control" value="<?php echo $newsTitle; ?>">
                        <div id="newsTitleErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="newsDetail" class="col-sm-2 col-form-label">News Detail : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <textarea name="newsDetail" id="newsDetail" cols="30" rows="5" class="form-control"><?php echo $newsDetail; ?></textarea>
                        <div id="newsDetailErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="newsImage" class="col-sm-2 col-form-label">News Image : <sup class="text-danger">*</sup></label>
                    <div class="col-sm-10">
                        <input type="file" name="newsImage" id="newsImage" class="form-control" value="">

                        <img id="newsImagePreview" src="<?php if (isset($_GET["news_id"])) {
                                                            echo '../../lib/images/news/' .  $newsImage;
                                                        } ?>" height="150" width="250" class="mt-2" alt="news Image">

                        <div id="newsImageErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="sortOrder" class="col-sm-2 col-form-label">Sort Order : </label>
                    <div class="col-sm-10">
                        <input type="" name="sortOrder" id="sortOrder" class="form-control" value="<?php echo $sortOrder; ?>">
                        <div id="sortOrderErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" id="addNewsBtn" class="btn btn-success mx-1">Save</button>
                        <a href="./manage_news.php" class="btn btn-outline-danger mx-1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    //SETING UPDATE VARIABLE FOR JAVASCRIPTT
    const update = <?php if (isset($_GET["news_id"])) {
                        echo 'true';
                    } else {
                        echo 'false';
                    }
                    ?>
</script>

<script src="../../lib/js/insert_news.js"></script>
<?php
require './footer.php';
?>