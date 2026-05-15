$(document).ready(function () {

    let user_id = localStorage.getItem('user_id');

    if (!user_id) {
        window.location.href = 'login.html';
    }

    $('#saveProfileBtn').click(function () {

        $.ajax({
            url: 'php/profile.php',
            type: 'POST',
            data: {
                user_id: user_id,
                age: $('#age').val(),
                dob: $('#dob').val(),
                contact: $('#contact').val()
            },
            success: function (response) {

                let data = JSON.parse(response);
                alert(data.message);
            }
        });
    });

    $('#logoutBtn').click(function () {

        $.ajax({
            url: 'php/logout.php',
            type: 'POST',
            data: {
                token: localStorage.getItem('token')
            },
            success: function () {

                localStorage.clear();
                window.location.href = 'login.html';
            }
        });
    });
});