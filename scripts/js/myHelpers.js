/**
 * Created by PROGRAMERIUA on 23.12.2016.
 */

function init () {
    return new cookie;
}

function grabData() {
    var email = $("#email").val(),
        password = $("#password").val();
    return {
        email: email,
        password: password
    };
}

function toggleForm(){
    $("#login-form").fadeOut(300);
    $(".welcome").fadeIn(500);
}

function togglePanel() {
    $(".welcome").fadeOut(300);
    $("#login-form").fadeIn(500);
}

function fillPanel (id,last_visit) {
    $(".welcome h2").find("span").text(id);
    $(".welcome p").find("span").text(last_visit);
}

function ajaxLogout() {
    $.ajax({
        url: "scripts/php/logout.php",
        type: "POST",
        data: "sucess",
        success: function (response) {
            console.log("you're log off!!!");
            location.reload();

        }
    });
}

function clearForm() {
    $("#login-form").find("#email").val("");
    $("#login-form").find("#password").val("");
}

function checking () {
    $.get('scripts/php/checking.php', function (data) {
        console.log(data);
    });
}

function unixToTime(unix) {
    unix = + unix;
    var a = new Date(unix * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    console.log(typeof a);
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var formatted_date = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return formatted_date;
}

function ajaxLogin(user_data) {
    $.ajax({
        url: "scripts/php/login.php",
        type: "POST",
        data: user_data,
        dataType: "json",
        success: function(response) {
            var c = init(),
            options = { expires: 180}
            if(response.id > 0) {
                c.set("count_errors", 0, options);
                c.set("user_id", response.id, options);
                c.set("last_visit", response.last_visit, options);
                fillPanel(response.id, unixToTime(response.last_visit));
                toggleForm();
            } else {
                var f = c.get("count_errors");
                c.set("user_id", 0, options);
                c.set("last_visit", 0, options);
                f = +f;
                f++;
                c.set("count_errors", f, options);
            }
        }
    });
}