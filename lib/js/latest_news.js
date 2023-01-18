$.ajax({
    type: "POST",
    url: SITE_URL + "api/fetch_news.php",
    data: "token=prince_sadariya",
    success: function (result) {
        setNewsCard(result);
    },
    error: function (error) {
        console.log(error);
    },
});

function setNewsCard(newsDetails) {
    let newsHtml = "";

    for (const news of newsDetails["data"]) {
        let date = new Date(`${news["created_date"]}`);
        let newsDetail = news["news_detail"].substr(0, 300);
        let postedDate =
            date.getDate() +
            "-" +
            (date.getMonth() + 1) +
            "-" +
            date.getFullYear();
        newsHtml += `<a class='text-decoration-none text-dark' href="news_detail.php?news_id=${
            news["news_id"]
        }"> <div class="d-flex flex-column flex-md-row gap-2 rounded shadow shadow-sm bg-light">
                        <div>
                            <img src="../../lib/images/news/${
                                news["news_image"]
                            }" alt="News Image" class="rounded-start img-thumbnail">
                        </div>
                        <div>
                            <div class="p-2">
                                <h2 class="border-bottom border-2">${news[
                                    "news_title"
                                ].substr(0, 100)}. . .</h2>
                                <p class="card-text">${newsDetail} . . . . .</p>
                                <p class="text-muted text-end">Posted on : ${postedDate}</p>
                            </div>
                        </div>
                    </div> </a>`;
    }

    $("#news-container").html(newsHtml);
}
