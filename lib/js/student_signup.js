//HIDING PROFILE PREVIEW IMAGE
$("#profilePreview").hide();
$("#resultMessage").hide();

const emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

$("#studentSignupForm").on("submit", function (e) {
    e.preventDefault();

    let isValidData = true;

    with (this) {
        if (userName.value.trim() == "") {
            isValidData = false;
            $("#userNameErr").html("Please enter username");
            $("#userName").removeClass("is-valid");
            $("#userName").addClass("is-invalid");
        } else {
            $("#userName").removeClass("is-invalid");
            $("#userName").addClass("is-valid");
            $("#userNameErr").html("");
        }

        //VALIDATION FOR AT LEAST ONE LOWERCASE,UPPERCASE AND MINIMUM 8 CHARACTERS
        let lowerCaseLetters = /[a-z]/g;
        let upperCaseLetters = /[A-Z]/g;
        let numbers = /[0-9]/g;

        if (!userPassword.value.match(lowerCaseLetters)) {
            isValidData = false;
            $("#userPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#userPassword").removeClass("is-valid");
            $("#userPassword").addClass("is-invalid");
        } else if (!userPassword.value.match(upperCaseLetters)) {
            isValidData = false;
            $("#userPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#userPassword").removeClass("is-valid");
            $("#userPassword").addClass("is-invalid");
        } else if (!userPassword.value.match(numbers)) {
            isValidData = false;
            $("#userPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#userPassword").removeClass("is-valid");
            $("#userPassword").addClass("is-invalid");
        } else if (userPassword.value.length < 8) {
            isValidData = false;
            $("#userPasswordErr").html(
                "must be requrie at lease one uppercase , one lowercase , one number and minimum 8 characters"
            );
            $("#userPassword").removeClass("is-valid");
            $("#userPassword").addClass("is-invalid");
        } else {
            $("#userPasswordErr").html("");
            $("#userPassword").removeClass("is-invalid");
            $("#userPassword").addClass("is-valid");
        }

        if (userConfirmPassword.value.trim() == "") {
            isValidData = false;
            $("#userConfirmPasswordErr").html("Password cannot be empty");
            $("#userConfirmPassword").removeClass("is-valid");
            $("#userConfirmPassword").addClass("is-invalid");
        } else if (userPassword.value != userConfirmPassword.value) {
            isValidData = false;
            $("#userConfirmPasswordErr").html("Both password does not match");
            $("#userConfirmPassword").removeClass("is-valid");
            $("#userConfirmPassword").addClass("is-invalid");
        } else {
            $("#userConfirmPasswordErr").html("");
            $("#userConfirmPassword").removeClass("is-invalid");
            $("#userConfirmPassword").addClass("is-valid");
        }

        if (firstName.value.trim() == "") {
            isValidData = false;
            $("#firstNameErr").html("Please enter first name");
            $("#firstName").addClass("is-invalid");
            $("#firstName").removeClass("is-valid");
        } else {
            $("#firstNameErr").html("");
            $("#firstName").addClass("is-valid");
            $("#firstName").removeClass("is-invalid");
        }

        if (middleName.value.trim() == "") {
            isValidData = false;
            $("#middleNameErr").html("Please enter middle name");
            $("#middleName").addClass("is-invalid");
            $("#middleName").removeClass("is-valid");
        } else {
            $("#middleNameErr").html("");
            $("#middleName").addClass("is-valid");
            $("#middleName").removeClass("is-invalid");
        }

        if (lastName.value.trim() == "") {
            isValidData = false;
            $("#lastNameErr").html("Please enter last name");
            $("#lastName").addClass("is-invalid");
            $("#lastName").removeClass("is-valid");
        } else {
            $("#lastNameErr").html("");
            $("#lastName").addClass("is-valid");
            $("#lastName").removeClass("is-invalid");
        }
        if (gender.value.trim() == "") {
            isValidData = false;
            $("#genderErr").html("Please select gender");
        } else {
            $("#genderErr").html("");
        }

        if (email.value.trim() == "") {
            isValidData = false;
            $("#emailErr").html("Please enter email");
            $("#email").addClass("is-invalid");
            $("#email").removeClass("is-valid");
        } else if (!emailPattern.test(email.value)) {
            isValidData = false;
            $("#emailErr").html("Invalid email format");
            $("#email").addClass("is-invalid");
            $("#email").removeClass("is-valid");
        } else {
            $("#emailErr").html("");
            $("#email").addClass("is-valid");
            $("#email").removeClass("is-invalid");
        }

        if (mobile.value.length != 10) {
            isValidData = false;
            $("#mobileErr").html("Please enter valid mobile number");
            $("#mobile").addClass("is-invalid");
            $("#mobile").removeClass("is-valid");
        } else {
            $("#mobileErr").html("");
            $("#mobile").addClass("is-valid");
            $("#mobile").removeClass("is-invalid");
        }

        if (department.value == "") {
            isValidData = false;
            $("#departmentErr").html("Please select department");
            $("#department").addClass("is-invalid");
            $("#department").removeClass("is-valid");
        } else {
            $("#departmentErr").html("");
            $("#department").addClass("is-valid");
            $("#department").removeClass("is-invalid");
        }

        if (college.value == "") {
            isValidData = false;
            $("#collegeErr").html("Please select college");
            $("#college").addClass("is-invalid");
            $("#college").removeClass("is-valid");
        } else {
            $("#collegeErr").html("");
            $("#college").addClass("is-valid");
            $("#college").removeClass("is-invalid");
        }

        if (university.value == "") {
            isValidData = false;
            $("#universityErr").html("Please select universty");
            $("#university").addClass("is-invalid");
            $("#university").removeClass("is-valid");
        } else {
            $("#universityErr").html("");
            $("#university").addClass("is-valid");
            $("#university").removeClass("is-invalid");
        }

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
        $("#signupBtn").html(
            '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>&nbsp;'
        );

        let studentForm = document.getElementById("studentSignupForm");
        let studentFormData = new FormData(studentForm);

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/student/handle_insert_student.php",
            data: studentFormData,
            contentType: false,
            processData: false,
            success: function (result) {
                window.scrollTo(0, 0);
                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#signupBtn").html("Signup");
                if (result == "Student data has been inserted") {
                    window.location = SITE_URL + "view/student/index.php";
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});

//FOR PROFILE PICTURE PREVIEW
$("#profilePicture").change(function () {
    $("#profilePreview").show();
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#profilePreview").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});
