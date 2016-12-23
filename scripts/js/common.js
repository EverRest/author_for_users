/**
 * Created by PROGRAMERIUA on 23.12.2016.
 */
$(document).ready(function (){
    $(function() {
        var logout_btn =$("#logout-btn");
        var login_form = $("#login-form");
        var welcome = $(".welcome");

        var c = init(),
            id = + c.get('user_id'),
            date = unixToTime(c.get('last_visit')),
            errors = c.get('count_errors'),
            loggedin = c.get('login');

        console.log(c);

        if (id > 0 && date != "") {
            $(".welcome h2 span").text(id);
            $(".welcome p span").text(date);
            $(welcome).fadeIn();
        } else {
            $(login_form).fadeIn();
        }

        $(login_form).find("button").on("click", function (e) {
            var user_data = grabData();
            clearForm();
            e.preventDefault();
            ajaxLogin(user_data);
            var c = init();
            c.errors = + c.get("count_errors");
            if (c.errors > 0) {
                window.location.replace("http://google.com");
            }
        });

        $(logout_btn).on("click", function () {
            ajaxLogout();
            togglePanel();
        });

    });
});
