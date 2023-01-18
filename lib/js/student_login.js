//ERROR MESSAGE HIDE
$("#errorMsg").hide();

//VALIDATION

const emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

$("#userEmail").keyup(function () {
    if (!emailPattern.test($(this).val())) {
        $("#userEmailErr").html("Invalid Email Format");
    } else {
        $("#userEmailErr").html("");
    }
});

const lowerCaseLetters = /[a-z]/g;
const upperCaseLetters = /[A-Z]/g;
const numbers = /[0-9]/g;

$("#userPassword").keyup(function () {
    let isValid = true;

    if (!$(this).val().match(lowerCaseLetters)) {
        isValid = false;
    }
    if (!$(this).val().match(upperCaseLetters)) {
        isValid = false;
    }
    if (!$(this).val().match(numbers)) {
        isValid = false;
    }
    if ($(this).val().length < 8) {
        isValid = false;
    }

    if (isValid) {
        $("#userPasswordErr").html("");
    } else {
        $("#userPasswordErr").html("Invalid Password Format");
    }
});

//FORM ON SUBMIT
$("#studentLoginForm").on("submit", function (e) {
    e.preventDefault();
    with (this) {
        isValidData = true;

        //FOR EMAIL VALIDATION
        if (!emailPattern.test(userEmail.value)) {
            $("#userEmailErr").html("Invalid Email Format");
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

        if (isValidData) {
            $("#loginBtn").html(
                '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>Login'
            );
            $.ajax({
                method: "POST",
                url: SITE_URL + "/view/student/handle_login.php",
                data: $("#studentLoginForm").serialize(),
                success: function (result) {
                    if (result === "student loggedin") {
                        window.location = SITE_URL + "view/student/index.php";
                        return;
                    }
                    $("#errorMsg").show();
                    $("#errorMsg").html(result);

                    $("#loginBtn").html("Login");
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    }
});
