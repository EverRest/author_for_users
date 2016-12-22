<?php
/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 21.12.2016
 * Time: 22:48
 */

/**
 * Creating admin user
 */

session_start();
include_once 'classes/User.php';
//$admin = new User();
//$admin_password = md5('admin');
//$admin->addUser('admin@test.ua','21232f297a57a5a743894a0e4a801fc3');

include_once "scripts/php/init.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Zinit</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="lib/PuzzleCAPTCHA.js/puzzleCAPTCHA.css">
    <style>
        button.btnSubmit {
            margin: 0 auto;
            display: block;
        }

        form {
            padding: 25px 10px;
            border-radius: 10px;
        }

        form, .welcome {
            display: none;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <?echo '<pre>';print_r($_COOKIE);echo '</pre>';?>
<!--        --><?// if(!empty($_COOKIE["user_id"]) AND !empty($_COOKIE["last_visit"])): ?>
        <div class="col-md-3 col-md-offset-6 bg-success welcome">
            <h1>Hello User!</h1>
            <h2>Your id is <span></span></h2>
            <p>Last visit: <span></span><p>
            <button id="logout-btn" class="btn btn-lg btn-info">Log Out</button>
        </div>
<!--        --><?// else: ?>
        <form id="login-form" action="#" class="col-md-8 col-md-offset-2 bg-primary" method="POST">
            <h1>Login Form</h1>
            <hr>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
            </div>
            <div class="form-group">
                <label class="text-uppercase">Are you a human?</label>
            </div>
            <div class="form-group">
                <div id="PuzzleCaptcha"></div>
            </div>
            <br>
            <button type="submit" disabled="true" class="text-uppercase btn btn-lg btn-success btnSubmit">Submit</button>
        </form>
<!--        --><?// endif; ?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="lib/PuzzleCAPTCHA.js/puzzleCAPTCHA.js"></script>
<script>
    $(function() {
        checkingUser();
        var logout_btn =$("#logout-btn");
        var login_form = $("#login-form");
        $("#PuzzleCaptcha").PuzzleCAPTCHA({
            imageURL: "img/captcha.jpg",
            height: "auto",
            width: "auto",
            targetButton: ".btnSubmit"
        });
        $(logout_btn).on("click", function () {
            logout();
            $("#login-form").fadeIn(500);
        });
        $(login_form).validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                password: {
                    required: "Please entry your password",
                    minlength: "Your password is too short"
                },
                email: "Please enter a valid email address"
            },
            submitHandler: function() {
                var user_data = grabData();
                if(ajaxLogin(user_data) == false) {

                }
            }
        });
    });

    function grabData() {
        var email = $("#email").val(),
            password = $("#password").val(),
            cookies = getCookie('count_errors');
        console.log(cookies);
        return {
            email: email,
            password: password,
            count_errors: cookies.count_errors
        };
    }

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function hideForm() {
        $("#email").val("");
        $("#password").val("");
        setTimeout(function () {
            $(".btnSubmit").text("SENT...");
            console.log("success");
        },200);
        toggleEl();
    }

    function toggleEl(){
        $("#login-form").fadeOut(1500);
        $(".welcome").fadeIn(500);
    }

    function logout() {
        $.ajax({
            url: "scripts/php/logout.php",
            type: "POST",
            data: "sucess",
            success: function (response) {
                console.log(response);
                toggleEl();
                }
            });
    }

    function ajaxLogin(user_data) {
        $.ajax({
            url: "scripts/php/login.php",
            type: "POST",
            data: user_data,
            success: function (response) {
                if(response != "false") {
                    hideForm();
                    $(".welcome").fadeIn(500);
                    console.log(response);
                } else {
                    $("#email").val("");
                    $("#password").val("");
                    console.log(response);
                }
            }
        });
    }

    function putCookiesToWelcome () {
        var date,
            id;
    }
    function checkingUser() {
        $.get(
            "/scripts/php/init.php",
            onAjaxSuccess
            );
        function onAjaxSuccess(response) {
            if (response != true) {
                $("#login-form").fadeIn(200);
            } else {
                $(".welcome").fadeIn(200);
            }
        }
    }
</script>
</body>
</html>
