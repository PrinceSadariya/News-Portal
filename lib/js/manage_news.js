//FOR DATA TABLES
$(document).ready(function () {
    $("#newsTable").dataTable({ paging: false });
});

//FOR EDIT DATA

let editBtns = document.getElementsByClassName("editBtns");

Array.from(editBtns).forEach(function (element) {
    element.addEventListener("click", function (e) {
        let id = e.target.id.substr(1);

        window.location = SITE_URL + "view/admin/insert_news.php?news_id=" + id;
    });
});

//FOR DELETE DATA

let deleteBtns = document.getElementsByClassName("deleteBtns");

Array.from(deleteBtns).forEach(function (element) {
    element.addEventListener("click", function (e) {
        let id = e.target.id.substr(1);
        if (confirm("Are you sure you want to delete")) {
            window.location =
                SITE_URL + "view/admin/manage_news.php?news_id=" + id;
        }
    });
});
