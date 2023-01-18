<?php

require './header.php';

if (!isset($_GET["news_id"])) {
    header("Location: " . SITE_URL . "view/student/latest_news.php");
    exit;
}
$newsId = $_GET["news_id"];
?>

<div id="newsContainer" class="container bg-light py-3">
    <!-- NEWS COMING FROM AJAX CALL -->
</div>

<script>
    //FOR TAKING ACCESS OF PHP VARIABLE IN JAVASCRIPT
    var news_id = <?php echo $newsId; ?>
</script>
<script src="../../lib/js/news_detail.js"></script>

<?php
require './footer.php';
?>