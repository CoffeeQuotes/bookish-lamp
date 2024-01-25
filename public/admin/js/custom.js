$(document).ready(function () {
    // Setup ajax header (for csrf token)
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // Check admin password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            type: "post",
            url: "/admin/check-current-password",
            data: { current_password: current_password },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifyCurrentPassword")
                        .html("Current password is incorrect")
                        .css("color", "red");
                } else if (resp == "true") {
                    $("#verifyCurrentPassword")
                        .html("Current password is correct")
                        .css("color", "green");
                }
            },
            error: function () {
                alert("error");
            },
        });
    });

    // Update CMS Page Status
    $(document).on("click", ".updatePageStatus", function () {
        var status = $(this).children("i").attr("status");
        // alert(status);
        var page_id = $(this).attr("page_id");

        $.ajax({
            type: "post",
            url: "/admin/update-cms-pages-status",
            data: { status: status, page_id: page_id },
            success: function (resp) {
                if (resp["status"] == 1) {
                    $("#page-" + page_id).html(
                        "<i class='text-success fas fa-toggle-on' status='active'></i>"
                    );
                } else if (resp["status"] == 0) {
                    $("#page-" + page_id).html(
                        "<i class='text-danger fas fa-toggle-off' status='inactive'></i>"
                    );
                }
            },
            error: function () {
                alert("error");
            },
        });
    });
});
