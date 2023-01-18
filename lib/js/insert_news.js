$("#resultMessage").hide();

$("#newsForm").on("submit", function (e) {
    e.preventDefault();
    let isValidData = true;
    with (this) {
        if (newsTitle.value.trim() == "") {
            $("#newsTitleErr").html("Please enter news title");
            isValidData = false;
        } else {
            $("#newsTitleErr").html("");
        }

        if (newsDetail.value.trim() == "") {
            $("#newsDetailErr").html("Please enter news detail");
            isValidData = false;
        } else {
            $("#newsDetailErr").html("");
        }

        if (isNaN(sortOrder.value)) {
            $("#sortOrderErr").html("Please enter numeric value");
            isValidData = false;
        } else {
            $("#sortOrderErr").html("");
        }

        let imageExtension = newsImage.value.split(".").pop().toLowerCase();
        let validFileExtensions = ["jpg", "jpeg"];

        if (update == true && newsImage.value != "") {
            //UPDATE OLD IMAGE
            if (!validFileExtensions.includes(imageExtension)) {
                isValidData = false;
                $("#newsImageErr").html(
                    "Please select only .jpg or .jpeg file"
                );
            } else if ($("#newsImage")[0].files[0].size > 10000000) {
                isValidData = false;
                $("#newsImageErr").html("Image size must be less than 2 mb");
            } else {
                $("#newsImageErr").html("");
            }
        } else if (update == false) {
            //ADD NEW IMAGE
            if (!validFileExtensions.includes(imageExtension)) {
                isValidData = false;
                $("#newsImageErr").html(
                    "Please select only .jpg or .jpeg file"
                );
            } else if ($("#newsImage")[0].files[0].size > 10000000) {
                isValidData = false;
                $("#newsImageErr").html("Image size must be less than 2 mb");
            } else {
                $("#newsImageErr").html("");
            }
        }
    }

    if (isValidData) {
        $("#addNewsBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div> &nbsp;Saving'
        );

        let newsForm = document.getElementById("newsForm");
        let newsFormData = new FormData(newsForm);

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_insert_news.php",
            data: newsFormData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result == "News inserted successfully") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_news.php?success_msg=insert";
                    return;
                }
                if (result == "News updated successfully") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_news.php?success_msg=update";
                    return;
                }

                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#addNewsBtn").html("Save");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});

//FOR PREVIEW IMAGE
if (update) {
    $("#newsImagePreview").show();
} else {
    $("#newsImagePreview").hide();
}

$("#newsImage").change(function () {
    $("#newsImagePreview").show();
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#newsImagePreview").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});
