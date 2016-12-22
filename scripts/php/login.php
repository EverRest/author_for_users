<?php
include_once '../../classes/User.php';
if(isset($_POST) AND !empty($_POST['email']) AND !empty($_POST['password']) AND isset($_POST['count_errors'])){
    $user_email = strip_tags($_POST['email']);
    $user_pass = strip_tags($_POST['password']);
    $count_errors = $_POST['count_errors'];
    $user = new User();
    $res = $user->login( $user_email, $user_pass, $count_errors);
    if(!empty($res)) {
        echo $res;
    } else {
        echo "false";
    }
} else {
    echo "false";
}