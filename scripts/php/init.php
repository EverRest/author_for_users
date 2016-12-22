<?php
    include_once '../../classes/User.php';

    initialize();

    function initialize()
    {
        if (!isset($_COOKIE['count_errors'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
            setcookie('count_errors', 0, time() + 180, '/');
            setcookie('ip', $ip, time() + 180, '/');

        } elseif ($_COOKIE['count_errors'] > 2) {
            die("You've been blocked for wrong input!");
        } else {
            check();
        }
    }

    function check()
    {
        $user = new User();
        echo $user->is_loggedin();
    }