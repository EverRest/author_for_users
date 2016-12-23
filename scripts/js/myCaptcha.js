/**
 * Created by PROGRAMERIUA on 23.12.2016.
 */
$(document).ready(function (){
    $("#PuzzleCaptcha").PuzzleCAPTCHA({
        imageURL: "img/captcha.jpg",
        height: "auto",
        width: "auto",
        targetButton: ".btnSubmit"
    });
});