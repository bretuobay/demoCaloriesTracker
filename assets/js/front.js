/**
 * Created by bretuobay on 18/09/2016.
 */

function registerUser(){

    var data = {
        "email" : $("#email").val(),
        "password" : $("#password").val(),
        "confirm_password" : $("#confirm-password").val()
    };

    if(!data.email|| !data.password){
        alert('No empty fields allowed');
        return;
    }else{

        $.ajax({
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            url: "index.php?section=users&do=register",
            error: function(data){
                console.log(data)
            },
            data: data,
            success: function(data) {
                if(data.success){
                    $("#register").hide();
                    $("#login").show();
                }else{

                    alert('Registration failed!')
                }
            },
            dataType: "json"
        });

    }

}

function loginUser() {

    var data = {
        "email": $('#lemail').val(),
        "password": $('#lpassword').val()
    };

    if(!data.email || !data.password){
        alert('All fields should be filled');
        return
    }

    $.ajax({
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processDataBoolean:false,
        url: "index.php?section=users&do=login",
        error: function (data) {
            console.log(data)
        },
        data: data,
        success: function (data) {

            if (data.success) {
                window.location.replace('dashboard.php');
            }else{
                alert('authentication failed')
            }
        },
        dataType: "json"
    });

}




$( document ).ready(function() {

    $("#login").show();

    $("#register_link").click(function(){

        $("#register").show();
        $("#login").hide();

    });

    $("#login_link").click(function(){
        $("#register").hide();
        $("#login").show();

    });


    $("#register-button").click(function(){
        //event.preventDefault();
        registerUser();

    });

    $("#login-button").click(function(event){
        event.preventDefault();
        loginUser();

    });


});




