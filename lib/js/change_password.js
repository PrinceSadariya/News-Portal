$("#resultMsg").hide();
$("#changePassForm").on("submit", function (e) {
    e.preventDefault();

    let isValidData = true;
    with (this) {
        if (oldPassword.value.trim() == "") {
            isValidData = false;
            $("#oldPasswordErr").html("Please enter your current password");
        } else {
            $("#oldPasswordErr").html("");
        }
        let upperCaseLetters = /[A-Z]/g;
        let lowerCaseLetters = /[a-z]/g;
        let numbers = /[0-9]/g;

        if (!newPassword.value.match(lowerCaseLetters)) {
            isValidData = false;
            $("#newPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#newPassword").removeClass("is-valid");
            $("#newPassword").addClass("is-invalid");
        } else if (!newPassword.value.match(upperCaseLetters)) {
            isValidData = false;
            $("#newPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#newPassword").removeClass("is-valid");
            $("#newPassword").addClass("is-invalid");
        } else if (!newPassword.value.match(numbers)) {
            isValidData = false;
            $("#newPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#newPassword").removeClass("is-valid");
            $("#newPassword").addClass("is-invalid");
        } else if (newPassword.value.length < 8) {
            isValidData = false;
            $("#newPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#newPassword").removeClass("is-valid");
            $("#newPassword").addClass("is-invalid");
        } else {
            $("#newPasswordErr").html("");
            $("#newPassword").removeClass("is-invalid");
            $("#newPassword").addClass("is-valid");
        }

        if (newPassword.value != confirmPassword.value) {
            isValidData = false;
            $("#confirmPasswordErr").html("Both password does not match");
        } else {
            $("#confirmPasswordErr").html("");
        }
    }

    if (isValidData) {
        $("#changePassBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>Saving'
        );
        $.ajax({
            method: "POST",
            url: SITE_URL + "view/student/handle_change_password.php",
            data: $("#changePassForm").serialize(),
            success: function (result) {
                $("#resultMsg").html(result);
                $("#resultMsg").show();

                $("#changePassBtn").html("Save");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
