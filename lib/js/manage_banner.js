$("#statusMsg").hide();

//FOR DATA TABLES
$(document).ready(function () {
    $("#bannerTable").dataTable({ paging: false });
});

if (superAdmin) {
    //FOR EDIT DATA

    let editBtns = document.getElementsByClassName("editBtns");

    Array.from(editBtns).forEach(function (element) {
        element.addEventListener("click", function (e) {
            let id = e.target.id.substr(1);

            window.location =
                SITE_URL + "view/admin/insert_banner.php?banner_id=" + id;
        });
    });

    //FOR DELETE DATA

    let deleteBtns = document.getElementsByClassName("deleteBtns");

    Array.from(deleteBtns).forEach(function (element) {
        element.addEventListener("click", function (e) {
            let id = e.target.id.substr(1);
            if (confirm("Are you sure you want to delete")) {
                window.location =
                    SITE_URL + "view/admin/manage_banners.php?banner_id=" + id;
            }
        });
    });

    //FOR STATUS SWITCH
    $(".bannerStatusSwitch").change(function (e) {
        let id = e.target.id.substr(1);

        let status;
        if ($(this).prop("checked") == true) {
            status = 1;
        } else {
            status = 2;
        }

        var statusData = {
            statusSwitch: "change",
            status: status,
            bannerId: id,
        };
        if (confirm("Are you sure you want to change banner status?")) {
            $.ajax({
                type: "POST",
                url: SITE_URL + "view/admin/handle_insert_banner.php",
                data: statusData,
                success: function (result) {
                    $("#statusMsg").html(result);
                    $("#statusMsg").show();
                },
            });
        } else {
            if (status == 1) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        }
    });
}
