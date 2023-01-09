$.ajax({
    type: "POST",
    url: SITE_URL + "api/fetch_banner.php",
    data: "token=prince_sadariya",
    success: function (result) {
        //CALLING SETBANNERS FUNCTION
        setBanners(result);
    },
});

/**
 * function setBanners()
 *
 * @param bannerData is ajax response
 *
 * it sets the banners from the ajax response data
 */
function setBanners(bannerData) {
    let bannerHtml = `<div id="bannerCarousel" class=" carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">`;
    let i = 0;
    bannerData["data"].forEach((element) => {
        if (i == 0) {
            acticeClass = " active ";
        } else {
            acticeClass = "";
        }
        bannerHtml += ` <div class="carousel-item ${acticeClass}" data-bs-interval="">
                            <img src="../../lib/images/banner/${element["banner_image"]}" class="d-block w-100" alt="Banner Image">
                        </div>`;

        i++;
    });

    bannerHtml += `</div>`;

    bannerData["data"].forEach(() => {
        bannerHtml += `<button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>`;
    });

    bannerHtml += `</div>`;

    $("#banners").html(bannerHtml);
}
