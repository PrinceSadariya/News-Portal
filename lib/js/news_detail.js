$.ajax({
    type: "POST",
    url: SITE_URL + "api/fetch_news.php",
    data: "token=prince_sadariya&news_id=" + news_id,
    success: function (result) {
        setNewsDetails(result);
    },
    error: function (error) {
        console.log(error);
    },
});

function setNewsDetails(newsData) {
    let news = newsData["data"][0];

    let newsHtml = `<div class="border-bottom border-4">
                        <h2>${news["news_title"]}</h2>
                    </div>
                    <div class="text-center mt-4">
                        <img class="img-thumbnail" src="../../lib/images/news/${news["news_image"]}" alt="News Image">
                    </div>
                    <div>
                        <p class="text-end text-muted">- Posted on : ${news["created_date"]}</p>
                    </div>
                    <div class="mt-4 text-justify">
                    ${news["news_detail"]}
                    </div>
                    <div class="mt-4 text-center">
                        <a class="btn btn-outline-primary">Share</a>
                        <a href="./latest_news.php" class="btn btn-outline-danger">Back</a>
                    </div>`;

    $("#newsContainer").html(newsHtml);
}
