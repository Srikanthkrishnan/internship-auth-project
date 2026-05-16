console.log("register.js loaded");

//alert("JavaScript Connected");

$(document).ready(function () {

    //alert("jQuery Working");

    $("#registerForm").submit(function (e) {

        e.preventDefault();

        //alert("Form Submitted");

        $.ajax({

            url: "/internship-project/php/register.php",

            type: "POST",

            data: $(this).serialize(),

            success: function (response) {

                console.log(response);

                alert(response);

                window.location.href =
                    "/internship-project/login.html";
            },

            error: function (xhr) {

                console.log(xhr.responseText);

                alert("AJAX Error");
            }

        });

    });

});