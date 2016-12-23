<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 21.12.2016
 * Time: 22:48
 */

/**
 * Creating admin user
 */
include_once 'scripts/php/init.php';
include_once 'scripts/php/checking.php';
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
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-4 bg-success welcome jumbotron">
            <h3 class="text-center">Hello User!</h3>
            <h2 class="text-center">Your id is <span></span></h2>
            <p class="text-center">Last visit: <span></span><p>
            <button id="logout-btn" class="center-block btn btn-lg btn-info">Log Out</button>
        </div>
        <form id="login-form" action="#" class="col-md-4 col-md-offset-4 bg-primary" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
            </div>
            <div class="form-group">
                <div id="PuzzleCaptcha"></div>
            </div>
            <button type="submit" disabled="true" class="text-uppercase btn btn-lg btn-success btnSubmit">Submit</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="lib/PuzzleCAPTCHA.js/puzzleCAPTCHA.js"></script>
<script src="lib/myCookiesLib/cookieLib.js"></script>

<script src="scripts/js/myCaptcha.js"></script>
<script src="scripts/js/myHelpers.js"></script>
<script src="scripts/js/myValidation.js"></script>
<script src="scripts/js/common.js"></script>
</body>
</html>
