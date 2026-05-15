$(document).ready(function () {

    $('#loginBtn').click(function () {

        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#password').val()
            },
            success: function (response) {

                let data = JSON.parse(response);

                if (data.status) {

                    localStorage.setItem('token', data.token);
                    localStorage.setItem('user_id', data.user_id);

                    window.location.href = 'profile.html';

                } else {
                    alert(data.message);
                }
            }
        });
    });
});