<?php
/**
 * Created by PhpStorm.
 * User: PROGRAMERIUA
 * Date: 23.12.2016
 * Time: 11:52
 */
include_once "User.php";

class App
{
    private $app;
    private $expires;


    public function __construct()
    {
        $this->app = new User();
//        $this->app->pdo->close();
    }

    public function init()
    {
        $this->expires = 3 * 60;

        if (!isset($_COOKIE['count_errors']) || empty($_COOKIE['count_errors']) || empty($_COOKIE['user_id'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
//            setcookie('last_visit', 0, 3 * 60 * 10);
//            setcookie('user_id', 0, 3 * 60 * 10);
//            setcookie('count_errors', 0, time() + 3 * 60 * 10);
            setcookie('ip', $ip, time() + 3 * 60 * 10);
        } elseif ( !empty($_COOKIE['id'])) {
            setcookie("login","true", 3 * 60);
        } else {
            $this->check();
        }
    }

    public function login_user()
    {
        if (isset($_POST) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
            $user_email = strip_tags($_POST['email']);
            $user_pass = strip_tags($_POST['password']);
//            $res = $this->app->login($user_email, $user_pass);
//            $newuser = new User();
            $res = $this->app->login($user_email,$user_pass);
            if (!empty($res)) {
                echo $res;
            } else {
                echo json_encode(new \stdClass);
            }
        } else {
            echo FALSE;
        }
    }

    public function logout_user()
    {
        if ($this->app->logout()) {
            $this->app->pdo->dbh = null;
            echo "success";
        }
    }

    public function check()
    {
        if ($_COOKIE['count_errors'] > 0) {
            $this->banned();
            return false;
        } else {
            return true;
        }
    }

    public function banned()
    {
        die("You've been blocked for wrong input!");
    }
}