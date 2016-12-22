/**
 * Created by Pavlo on 21.12.2016.
 */

$(function() {
    var login_form = $("#login-form");
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
        submitHandler: function(form) {
            console.log('true');
            $("#login-form").fadeOut(1000);
        }
    });
});
