<?php
/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 22.12.2016
 * Time: 7:36
 */
include_once '../../classes/User.php';
$user = new User();
if($user->logout()) {
    $user->pdo->dbh = null;
    echo "success";
}