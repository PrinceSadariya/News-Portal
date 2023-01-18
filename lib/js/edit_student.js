$("#resultMessage").hide();

const emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

$("#editProfileForm").on("submit", function (e) {
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
    }
    if (isValidData) {
        $("#editProfileBtn").html(
            '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>Saving'
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "view/student/handle_insert_student.php",
            data: $("#editProfileForm").serialize(),
            success: function (result) {
                if (result == "Profile updated succesfully") {
                    window.location =
                        SITE_URL +
                        "view/student/student_profile.php?profile_update=true";
                    return;
                }

                window.scrollTo(0, 0);
                $("#resultMessage").html(result);
                $("#resultMessage").show();

                $("#editProfileBtn").html("Save");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});

//FOR STUDENT PROFILE PICTURE
