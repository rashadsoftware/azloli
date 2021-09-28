$(function () {
    function refresh() {
        setTimeout(function () {
            location.reload();
        }, 3000);
    }

    // contact form with ajax
    $("#formContact").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    alert("ok");
                }
            },
        });
    });

    // change password from password to text
    $("#login_eye").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var inputPassword = $("#loginPassword");

        if (inputPassword.attr("type") == "password") {
            inputPassword.attr("type", "text");
        } else {
            inputPassword.attr("type", "password");
        }
    });

    /* Profile Section
    =============================================================================>  */

    // change profile optional
    $("#formProfileOptional").on("submit", function (e) {
        e.preventDefault();

        // change profile optional
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    $("#alert-noti").css("display", "block");
                    $("#alert-noti").removeClass("alert-danger");
                    $("#alert-noti").addClass("alert-success");
                    $("#alert-noti").text(data.msg);

                    refresh();
                }
            },
        });
    });

    // change profile image
    $("#formProfileImage").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    $("#alert-noti").css("display", "block");
                    $("#alert-noti").removeClass("alert-danger");
                    $("#alert-noti").addClass("alert-success");
                    $("#alert-noti").text(data.msg);

                    refresh();
                }
            },
        });
    });

    // change password image
    $("#formProfilePassword").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else if (data.status == 2) {
                    $("#alert-noti").css("display", "block");
                    $("#alert-noti").removeClass("alert-success");
                    $("#alert-noti").addClass("alert-danger");
                    $("#alert-noti").text(data.msg);
                } else {
                    window.location.href = "logout";
                }
            },
        });
    });
});
