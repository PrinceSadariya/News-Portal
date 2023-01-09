//HIDING ERROR MESSAGE
$("#resultMessage").hide();

$("#departmentForm").on("submit", function (e) {
    e.preventDefault();

    //FOR VALIDATION
    let isValidData = true;
    with (this) {
        if (departmentName.value.trim() == "") {
            isValidData = false;
            $("#departmentNameErr").html("Please enter department name");
        } else {
            $("#departmentNameErr").html("");
        }
    }

    if (isValidData) {
        //PROCCESING BUTTON SHOW
        $("#addDepartmentBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div> &nbsp;Saving'
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_insert_department.php",
            data: $("#departmentForm").serialize(),
            success: function (result) {
                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#addDepartmentBtn").html("Save");

                if (result == "Department has been inserted") {
                    $("#departmentForm").trigger("reset");

                    $("#resultMessage").removeClass("alert-warning");
                    $("#resultMessage").addClass("alert-success");
                }
            },
        });
    }
});
