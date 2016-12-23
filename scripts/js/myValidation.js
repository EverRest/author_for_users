/**
 * Created by PROGRAMERIUA on 23.12.2016.
 */
$(document).ready(function () {
    $.getScript("http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js", function () {
        var form = $("#login-form");
        $(form).validate({
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
            }
        });
    })
});
