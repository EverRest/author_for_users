<?php
include_once '../../classes/User.php';
if(isset($_POST) AND !empty($_POST['email']) AND !empty($_POST['password'])){
    $user_email = strip_tags($_POST['email']);
    $user_pass = strip_tags($_POST['password']);
    $user = new User();
    $res = $user->login( $user_email, $user_pass);
    if(!empty($res)) {
        echo "success";
    } else {
        echo "false";
    }
} else {
    echo "false";
}