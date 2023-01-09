$("#resultMessage").hide();

$("#bannerForm").on("submit", function (e) {
    e.preventDefault();
    let isValidData = true;
    with (this) {
        if (bannerTitle.value.trim() == "") {
            $("#bannerTitleErr").html("Please enter banner title");
            isValidData = false;
        } else {
            $("#bannerTitleErr").html("");
        }

        let imageExtension = bannerImage.value.split(".").pop().toLowerCase();
        let validFileExtensions = ["jpg", "jpeg"];

        if (update == true && bannerImage.value != "") {
            //UPDATE OLD IMAGE
            if (!validFileExtensions.includes(imageExtension)) {
                isValidData = false;
                $("#bannerImageErr").html(
                    "Please select only .jpg or .jpeg or .png file"
                );
            } else if ($("#bannerImage")[0].files[0].size > 2097152) {
                isValidData = false;
                $("#bannerImageErr").html("Image size must be less than 2 mb");
            } else {
                $("#bannerImageErr").html("");
            }
        } else if (update == false) {
            //ADD NEW IMAGE
            if (!validFileExtensions.includes(imageExtension)) {
                isValidData = false;
                $("#bannerImageErr").html(
                    "Please select only .jpg or .jpeg file"
                );
            } else if ($("#bannerImage")[0].files[0].size > 10000000) {
                isValidData = false;
                $("#bannerImageErr").html("Image size must be less than 2 mb");
            } else {
                $("#bannerImageErr").html("");
            }
        }

        if (bannerStatus.value == "") {
            isValidData = false;
            $("#bannerStatusErr").html("Please select status");
        } else {
            $("#bannerStatusErr").html("");
        }
    }

    if (isValidData) {
        $("#addBannerBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div> &nbsp;Saving'
        );

        let bannerForm = document.getElementById("bannerForm");
        let bannerFormData = new FormData(bannerForm);

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_insert_banner.php",
            data: bannerFormData,
            contentType: false,
            processData: false,
            success: function (result) {
                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#addBannerBtn").html("Save");

                if (result == "Banner inserted successfully") {
                    $("#bannerForm").trigger("reset");
                    $("#resultMessage").removeClass("alert-warning");
                    $("#resultMessage").addClass("alert-success");
                }
            },
        });
    }
});

//FOR IMAGE PREVIEW

if (update) {
    $("#bannerImagePreview").show();
} else {
    $("#bannerImagePreview").hide();
}

$("#bannerImage").change(function () {
    $("#bannerImagePreview").show();
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#bannerImagePreview").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});
