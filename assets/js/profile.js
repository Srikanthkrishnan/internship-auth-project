$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Check Login
    |--------------------------------------------------------------------------
    */

    const token =
        localStorage.getItem("session_token");

    const user_id =
        localStorage.getItem("user_id");

    if (!token) {

        window.location.href =
            "login.html";
    }

    /*
    |--------------------------------------------------------------------------
    | Save Profile
    |--------------------------------------------------------------------------
    */

    $("#profileForm").submit(function (e) {

        e.preventDefault();

        let formData = $(this).serialize();

        formData +=
            "&user_id=" + user_id;

        formData +=
            "&token=" + token;

        $.ajax({

            url: "php/profile.php",

            type: "POST",

            data: formData,

            success: function (response) {

                console.log(response);

                Swal.fire({

                    icon: 'success',

                    title: 'Profile Saved',

                    showConfirmButton: false,

                    timer: 2000

                });

            },

            error: function (xhr) {

                console.log(xhr.responseText);

                Swal.fire({

                    icon: 'error',

                    title: 'Save Failed'

                });

            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    $("#logoutBtn").click(function () {

        localStorage.clear();

        window.location.href =
            "login.html";
    });

});