<?php
require './header.php';

//BOOLEAN FOR DELETE MESSAGE SHOWING
$deleteSucces = false;

if (isset($_GET["news_id"])) {
    $deleteId = $_GET["news_id"];

    $newsObject = new News();
    $newsData = $newsObject->fetchNews('*', ["news_id" => $deleteId]);

    $newsImage = $newsData[0]["news_image"];

    $deleteSucces = $newsObject->deleteNews($deleteId);

    if ($deleteSucces) {
        unlink("../../lib/images/news/" . $newsImage);
    }
}
?>

<?php
if ($deleteSucces) {
?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        News has been deleted
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="p-3">
    <div>
        <h2 class="text-center text-decoration-underline">News List</h2>
        <div class="text-end">
            <a href="./insert_news.php" class="btn btn-primary"> <span class="fas fa-plus"></span> Add news</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive">
            <table class="table table-bordered  table-hover">
                <tr>
                    <th>#</th>
                    <th>News Image</th>
                    <th>News Title</th>
                    <th>News Detail</th>
                    <th>Sort Order</th>
                    <th class="text-center">Action</th>
                </tr>


                <?php
                $newsObject = new News();
                $allNews = $newsObject->fetchNews();
                
                $i = 0;
                foreach ($allNews as $news) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src="../../lib/images/news/<?php echo $news["news_image"]; ?>" alt="news Image" height="100" width="150"></td>
                        <td><?php echo $news["news_title"]; ?></td>
                        <td><?php echo $news["news_detail"]; ?></td>
                        <td><?php echo $news["sort_order"]; ?></td>
                        <td class="text-center">
                            <span id="e<?php echo $news["news_id"]; ?>" class="cursor-pointer editBtns fas fa-pen text-primary me-2"></span>
                            <span id="d<?php echo $news["news_id"]; ?>" class="cursor-pointer deleteBtns fas fa-trash-can text-danger ms-2"></span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script src="../../lib/js/manage_news.js"></script>

<?php
require './footer.php';
?>