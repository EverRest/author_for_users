<?php

/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 21.12.2016
 * Time: 20:46
 */

include_once "Db.php";

class User
{
    private $id;
    private $email;
    private $password;
    private $last_visit;
    public $pdo;

    public function __construct(){
        $this->pdo = new Db();
        $this->pdo->create_tbl_users();
    }

    public function addUser($email,$pass)
    {
        try {
            $this->email = $email;
            $this->password = $pass;
            $this->last_visit = getdate()[0];
            $sql = "INSERT INTO users(
                    email,
                    password,
                    last_visit) VALUES (
                    :email, 
                    :password, 
                    :last_visit)";

            $stmt = $this->pdo->dbh->prepare($sql);

            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":last_visit", $this->last_visit);

            $stmt->execute();
            $this->pdo->close();
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }
    public function is_loggedin()
    {
        if(isset($_COOKIE["user_info"]))
        {
            return true;
        }
    }

    public function updateLastVisitTime($id)
    {
        try {
            $now = getdate()[0];
            $sql = "UPDATE users SET last_visit = :now,
            WHERE id = :user_id";
            $stmt = $this->pdo->dbh->prepare($sql);
            $stmt->bindParam(':now',$now);
            $stmt->bindParam(':user_id',$id);
            $stmt->execute();
            $this->pdo->close();
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function logout()
    {
        ob_start();
        setcookie("user_id","",time() - 3600,"/");
        setcookie("last_visit","",date() - 3600,"/");
        setcookie("ip","",time() - 3600,"/");
        unset($_SESSION["user_session"]);
        ob_end_flush();
        session_destroy();
        $this->pdo->close();
        return true;
    }
    public function login($umail,$upass)
    {
        if ( $count_errors = $_COOKIE["count_errors"] < 2 )
        {
            try {
                $stmt = $this->pdo->dbh->prepare("SELECT * FROM users WHERE email=:umail LIMIT 1");
                $stmt->execute(array(":umail" => $umail));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($stmt->rowCount() > 0) {
                    if (md5($upass) == $userRow["password"]) {
                        ob_start();
                        $_SESSION["user_session"] = $userRow["id"];
                        setcookie("user_id", $userRow["id"], time() + 600, "/");
                        setcookie("last_visit", $userRow["last_visit"], time() + 600, "/");
                        setcookie("count_errors", 0, time() + 180, "/");
                        ob_end_flush();
                        $this->updateLastVisitTime($userRow["id"]);
                        $this->pdo->close();
                        return json_encode($userRow, JSON_FORCE_OBJECT);
                    } else {
                        $count_errors++;
                        setcookie("count_errors", $count_errors, time() + 180, "/");
                        return false;
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            die("You've been blocked for wrong input!");
        }
    }
}