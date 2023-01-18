//ERROR MESSAGE HIDING
$("#errorMsg").hide();

//ON SIGNUP FORM SUBMIT
$("#signupForm").on("submit", function (e) {
    e.preventDefault();

    let isValidData = true;

    const emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

    const lowerCaseLetters = /[a-z]/g;
    const upperCaseLetters = /[A-Z]/g;
    const numbers = /[0-9]/g;

    with (this) {
        if (userRole.value.trim() == "") {
            $("#userRoleErr").html("Please select your role");
        } else {
            $("#userRoleErr").html("");
        }

        if (userName.value.trim() == "") {
            isValidData = false;
            $("#userNameErr").html("Please enter username");
        } else {
            $("#userNameErr").html("");
        }

        //FOR EMAIL VALIDATION
        if (!emailPattern.test(userEmail.value)) {
            $("#userEmailErr").html("Please enter valid email");
            isValidData = false;
        } else {
            $("#userEmailErr").html("");
        }

        //FOR PASSWORD VALIDATION
        let isValidPassword = true;
        if (!userPassword.value.match(lowerCaseLetters)) {
            isValidPassword = false;
        }
        if (!userPassword.value.match(upperCaseLetters)) {
            isValidPassword = false;
        }
        if (!userPassword.value.match(numbers)) {
            isValidPassword = false;
        }
        if (userPassword.value.length < 8) {
            isValidPassword = false;
        }

        if (isValidPassword) {
            $("#userPasswordErr").html("");
        } else {
            $("#userPasswordErr").html("Invalid Password Format");
            isValidData = false;
        }

        if (confirmPassword.value != userPassword.value) {
            isValidData = false;
            $("#confirmPasswordErr").html("Both passwords does not match");
        } else {
            $("#confirmPasswordErr").html("");
        }
    }

    if (isValidData) {
        $("#signupBtn").html(
            '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>&nbsp;'
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/admin/handle_signup.php",
            data: $("#signupForm").serialize(),
            success: function (result) {
                $("#errorMsg").html(result);
                $("#errorMsg").show();

                $("#signupBtn").html("Signup");

                if (result === "Account created successfully") {
                    $("#errorMsg").removeClass("alert-danger");
                    $("#errorMsg").addClass("alert-success");
                    $("#signupForm").trigger("reset");
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
