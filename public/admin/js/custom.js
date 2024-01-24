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
});
