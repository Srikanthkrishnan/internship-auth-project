$(document).ready(function () {

    $("#loginForm").submit(function (e) {

        e.preventDefault();

        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        $.ajax({

            url: "php/login.php",
            type: "POST",

            data: {
                email: email,
                password: password
            },

            success: function (response) {

                console.log(response);

                if (response.status === "success") {

                    Swal.fire({
                        icon: "success",
                        title: "Login Success",
                        text: response.message
                    }).then(() => {

                        localStorage.setItem(
                            "session_token",
                            response.token
                        );

                        window.location.href = "profile.html";
                    });

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Login Failed",
                        text: response.message
                    });
                }
            },

            error: function (xhr) {

                console.log(xhr.responseText);

                Swal.fire({
                    icon: "error",
                    title: "AJAX Error",
                    text: "Check console"
                });
            }
        });
    });
});