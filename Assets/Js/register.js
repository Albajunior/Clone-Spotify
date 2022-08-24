$(document).ready(function(){
    $("#hideLogIn").click(function(){
        $("#registerForm").show();
        $("#loginForm").hide();
    })

    $("#hideRegister").click(function(){
        $("#registerForm").hide();
        $("#loginForm").show();
    })
});

