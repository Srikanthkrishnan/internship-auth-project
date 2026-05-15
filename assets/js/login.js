$(document).ready(function(){

    $("#loginForm").submit(function(e){

        e.preventDefault();

        $.ajax({

            url: "assets/php/login.php",

            type: "POST",

            data: {

                email: $("#email").val(),

                password: $("#password").val()

            },

            success: function(response){

                let data = JSON.parse(response);

                alert(data.message);

                if(data.status === "success"){

                    localStorage.setItem(
                        "user_email",
                        $("#email").val()
                    );

                    window.location.href = "profile.html";

                }

            }

        });

    });

});