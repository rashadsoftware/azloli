$(function () {
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
});
