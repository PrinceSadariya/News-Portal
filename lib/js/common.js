//FOR LOGOUT
$("#adminLogoutBtn").on("click", function () {
    if (confirm("Are You sure you want to logout?")) {
        window.location = SITE_URL + "view/admin/logout.php";
    }
});
$("#studentLogoutBtn").on("click", function () {
    if (confirm("Are You sure you want to logout?")) {
        window.location = SITE_URL + "view/student/logout.php";
    }
});
