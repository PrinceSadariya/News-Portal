//HIDING ERROR MESSAGE
$("#resultMessage").hide();

$("#universityForm").on("submit", function (e) {
    e.preventDefault();

    //FOR VALIDATION
    let isValidData = true;
    with (this) {
        if (universityName.value.trim() == "") {
            isValidData = false;
            $("#universityNameErr").html("Please enter university name");
        } else {
            $("#universityNameErr").html("");
        }
        if (universityCity.value.trim() == "") {
            isValidData = false;
            $("#universityCityErr").html("Please enter university city");
        } else {
            $("#universityCityErr").html("");
        }
        if (universityState.value.trim() == "") {
            isValidData = false;
            $("#universityStateErr").html("Please enter university state");
        } else {
            $("#universityStateErr").html("");
        }
    }

    if (isValidData) {
        //PROCCESING BUTTON SHOW
        $("#addUniversityBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div> &nbsp;Saving'
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_insert_university.php",
            data: $("#universityForm").serialize(),
            success: function (result) {
                if (result == "University has been inserted") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_universities.php?success_msg=insert";
                    return;
                }
                if (result == "University has been updated") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_universities.php?success_msg=update";
                    return;
                }

                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#addUniversityBtn").html("Save");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
