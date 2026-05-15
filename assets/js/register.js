// $(document).ready(function () {

//     $('#registerBtn').click(function () {

//         $.ajax({
//             url: 'php/register.php',
//             type: 'POST',
//             data: {
//                 name: $('#name').val(),
//                 email: $('#email').val(),
//                 password: $('#password').val()
//             },
//             success: function (response) {

//                 let data = JSON.parse(response);

//                 alert(data.message);

//                 if (data.status) {
//                     window.location.href = 'login.html';
//                 }
//             }
//         });
//     });
// });


$(document).ready(function () {

    $("#registerForm").submit(function (e) {

        e.preventDefault();

        $.ajax({

            url: "assets/php/register.php",

            type: "POST",

            data: {

                name: $("#name").val(),

                email: $("#email").val(),

                password: $("#password").val()

            },

            success: function (response) {

                console.log(response);

                let data = JSON.parse(response);

                alert(data.message);

                if (data.status === "success") {

                    window.location.href = "login.html";

                }

            },

            error: function (xhr, status, error) {

                console.log(error);

                alert("Something went wrong");

            }

        });

    });

});