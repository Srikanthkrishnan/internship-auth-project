$(document).ready(function () {

    $('#registerBtn').click(function () {

        $.ajax({
            url: 'php/register.php',
            type: 'POST',
            data: {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val()
            },
            success: function (response) {

                let data = JSON.parse(response);

                alert(data.message);

                if (data.status) {
                    window.location.href = 'login.html';
                }
            }
        });
    });
});