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
            $this->last_visit = getdate();
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

    public function updateLastVisitTime($id)
    {
        try {
            $now = time();
            $sql = "UPDATE users SET last_visit = :now WHERE id = :id";
            $stmt = $this->pdo->dbh->prepare($sql);
            $stmt->bindParam(':now',$now);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
//            $this->pdo->close();
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function logout()
    {
        ob_start();
        setcookie("user_id","",time() - 3600,"/");
        setcookie("last_visit","",time() - 3600,"/");
        setcookie("ip","",time() - 3600,"/");
        unset($_SESSION["user_session"]);
        ob_end_flush();
//        $this->pdo->close();
        return true;
    }

    public function login($umail, $upass)
    {
        try {
            $stmt = $this->pdo->dbh->prepare("SELECT * FROM users WHERE email=:umail LIMIT 1");
            $stmt->execute(array(":umail" => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (md5($upass) == $userRow["password"]) {
                    ob_start();
                    $_SESSION["user_session"] = $userRow["id"];
                    setcookie("user_id", $userRow["id"], time() + 60 * 60, "/");
                    setcookie("last_visit", $userRow["last_visit"], time() + 60 * 3, "/");
                    setcookie("count_errors", 0, time() + 60 * 3, "/");
                    ob_end_flush();
                    $this->updateLastVisitTime($userRow["id"]);
                   return json_encode($userRow, JSON_FORCE_OBJECT);
                } else {
                    return "wrong password";
                }
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}