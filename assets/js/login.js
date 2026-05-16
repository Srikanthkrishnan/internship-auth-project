$(document).ready(function () {

    $("#loginForm").submit(function (e) {

        e.preventDefault();

        $.ajax({

            url: "php/login.php",

            type: "POST",

            dataType: "json",

            data: {
                email: $("#email").val(),
                password: $("#password").val()
            },

            success: function (data) {

                console.log(data);

                if (data.status === "success") {

                    localStorage.setItem(
                        "session_token",
                        data.token
                    );

                    localStorage.setItem(
                        "user_id",
                        data.user_id
                    );

                    Swal.fire({
                        icon: "success",
                        title: "Login Successful",
                        text: "Redirecting..."
                    });

                    setTimeout(() => {
                        window.location.href = "profile.html";
                    }, 1500);

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Login Failed",
                        text: data.message
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