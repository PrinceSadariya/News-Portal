//HIDING ERROR MESSAGE
$("#resultMessage").hide();

$("#collegeForm").on("submit", function (e) {
    e.preventDefault();

    //FOR VALIDATION
    let isValidData = true;
    with (this) {
        if (collegeName.value.trim() == "") {
            isValidData = false;
            $("#collegeNameErr").html("Please enter college name");
        } else {
            $("#collegeNameErr").html("");
        }
        if (collegeCity.value.trim() == "") {
            isValidData = false;
            $("#collegeCityErr").html("Please enter college city");
        } else {
            $("#collegeCityErr").html("");
        }
        if (collegeState.value.trim() == "") {
            isValidData = false;
            $("#collegeStateErr").html("Please enter college state");
        } else {
            $("#collegeStateErr").html("");
        }
    }

    if (isValidData) {
        //PROCCESING BUTTON SHOW
        $("#addCollegeBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div> &nbsp;Saving'
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_insert_college.php",
            data: $("#collegeForm").serialize(),
            success: function (result) {
                if (result == "College has been inserted") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_colleges.php?success_msg=insert";
                    return;
                }
                if (result == "College has been updated") {
                    window.location =
                        SITE_URL +
                        "view/admin/manage_colleges.php?success_msg=update";
                    return;
                }

                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#addCollegeBtn").html("Save");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
