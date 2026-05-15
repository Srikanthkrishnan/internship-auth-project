$(document).ready(function () {

    $("#registerForm").submit(function (e) {
        e.preventDefault();

        let name = $("#name").val();
        let email = $("#email").val();
        let password = $("#password").val();

        $.ajax({
            url: "php/register.php",
            type: "POST",
            dataType: "json",

            data: {
                name: name,
                email: email,
                password: password
            },

            success: function (response) {

                console.log(response);

                if (response.status === "success") {

                    alert(response.message);

                    window.location.href = "login.html";

                } else {

                    alert(response.message);
                }
            },

            error: function (xhr, status, error) {

                console.log(xhr.responseText);

                alert("AJAX Error");
            }
        });

    });

});