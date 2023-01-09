<?php
require './header.php';

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/News.php';

//ERROR HANDLING
$newsDetail = null;
$newsId = null;
$newsImage = null;
$newsTitle = null;

if (isset($_GET["news_id"])) {
    $newsId = $_GET["news_id"];

    $newsObject = new News();

    $newsData = $newsObject->fetchNews('*', ["news_id" => $newsId]);

    $newsTitle = $newsData[0]["news_title"];
    $newsDetail = $newsData[0]["news_detail"];
    $newsImage = $newsData[0]["news_image"];
    $newsDate = date("d-m-Y", strtotime($newsData[0]["created_date"]));
}
?>
<div class="container bg-light py-3">
    <div class="border-bottom border-4">
        <h2><?php echo $newsTitle; ?></h2>
    </div>
    <div class="text-center mt-4">
        <img class="img-thumbnail" src="../../lib/images/news/<?php echo $newsImage; ?>" alt="News Image">
    </div>
    <div>
        <p class="text-end text-muted">- Posted on : <?php echo $newsDate; ?></p>
    </div>
    <div class="mt-4 text-justify">
        <?php echo $newsDetail; ?>
    </div>
    <div class="mt-4 text-center">
        <a class="btn btn-outline-primary">Share</a>
        <a href="./latest_news.php" class="btn btn-outline-danger">Back</a>
    </div>
</div>

<script src="../../lib/js/latest_news.js"></script>
<?php
require './footer.php';
?>