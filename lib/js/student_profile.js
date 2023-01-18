$("#modalMsg").hide();
$("#profileChangeForm").on("submit", function (e) {
    e.preventDefault();

    let isValidData = true;
    with (this) {
        let imageExtension = profilePicture.value
            .split(".")
            .pop()
            .toLowerCase();
        let validFileExtensions = ["jpg", "jpeg"];

        if (!validFileExtensions.includes(imageExtension)) {
            isValidData = false;
            $("#profilePictureErr").html(
                "Please select only .jpeg , .jpg file"
            );
            $("#profilePicture").addClass("is-invalid");
            $("#profilePicture").removeClass("is-valid");
        } else if ($("#profilePicture")[0].files[0].size > 10000000) {
            isValidData = false;
            $("#profilePictureErr").html("Image size must be less than 2mb");
            $("#profilePicture").addClass("is-invalid");
            $("#profilePicture").removeClass("is-valid");
        } else {
            $("#profilePictureErr").html("");
            $("#profilePicture").addClass("is-valid");
            $("#profilePicture").removeClass("is-invalid");
        }
    }

    if (isValidData) {
        $("#changeProfileBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>Changing'
        );

        let profileChangeForm = document.getElementById("profileChangeForm");
        let profileChangeFormData = new FormData(profileChangeForm);

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/student/handle_change_profile.php",
            data: profileChangeFormData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result == "Student Profile Picture has been Changed") {
                    window.location =
                        SITE_URL +
                        "view/student/student_profile.php?profile=change";
                    return;
                }

                $("#modalMsg").html(result);
                $("#modalMsg").show();

                $("#changeProfileBtn").html("Change");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});

//FOR PREVIEW OF SELECTED IMAGE
$("#profilePicture").change(function () {
    const file = this.files[0];

    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#editProfileImage").attr({
                src: event.target.result,
                height: 400,
                width: 400,
            });
        };
        reader.readAsDataURL(file);
    }
});
