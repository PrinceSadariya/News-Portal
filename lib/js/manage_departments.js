//FOR DATA TABLES
$(document).ready(function () {
    var departmentTable = $("#departmentTable").DataTable({
        
        ajax: {
            url: SITE_URL + "api/fetch_departments.php",
            dataSrc: "data",
        },
        columns: [
            {
                data: null,
                searchable: false,
                orderable: false,
            },
            {
                data: "department_id",
            },
            {
                data: "department_name",
            },
            {
                data: null,
                render: function (data) {
                    return (
                        '<span id="e' +
                        data.department_id +
                        '" class="fas fa-pen editbtn text-primary me-3 cursor-pointer"></span><span id="d' +
                        data.department_id +
                        '" class="delbtn fas fa-trash text-danger ms-3 cursor-pointer"></span>'
                    );
                },
            },
        ],
    });

    departmentTable
        .on("order.dt search.dt", function () {
            departmentTable
                .column(0, {
                    search: "applied",
                    order: "applied",
                })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
        })
        .draw();
});

// //FOR EDIT DATA

// let editBtns = document.getElementsByClassName("editBtns");

// Array.from(editBtns).forEach(function (element) {
//     element.addEventListener("click", function (e) {
//         let id = e.target.id.substr(1);

//         window.location =
//             SITE_URL + "view/admin/insert_department.php?department_id=" + id;
//     });
// });

// //FOR DELETE DATA

// let deleteBtns = document.getElementsByClassName("deleteBtns");

// Array.from(deleteBtns).forEach(function (element) {
//     element.addEventListener("click", function (e) {
//         let id = e.target.id.substr(1);
//         if (confirm("Are you sure you want to delete")) {
//             window.location =
//                 SITE_URL +
//                 "view/admin/manage_departments.php?department_id=" +
//                 id;
//         }
//     });
// });

$("#departmentTable tbody").on("click", "span", function () {
    let dataId = this.id.substr(1);
    let action = this.id.substr(0, 1);

    if (action == "e") {
        //FOR EDIT DATA
        window.location = `/view/admin/insert_department.php?department_id=${dataId}`;
    } else if (action == "d") {
        //FOR DELETE DATA
        if (confirm("Are you sure you want to delete")) {
            window.location = `/view/admin/manage_departments.php?department_id=${dataId}`;
        }
    }
});
