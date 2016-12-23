<?php
include_once 'Config.php';
/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 21.12.2016
 * Time: 20:50
 */
class Db
{
    private $host;
    private $user;
    private $pass;
    private $dbname;
    public $dbh;
    private $error;

    public function __construct(){
        /**
         * Set configuration for database connection
         */
        $config = new Config();
        $this->host = $config->getHost();
        $this->user = $config->getUser();
        $this->pass = $config->getPassword();
        $this->dbname = $config->getDatabase();
        $this->dbh = null;
        /**
         * Create PDO connection
         */
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
//            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
//            } catch (PDOException $e) {
//                $this->error = $e->getMessage();
//            }
    }

    public function create_tbl_users()
    {
        try {
            $sql ="CREATE TABLE IF NOT EXISTS `users`(
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
                `email` varchar(50) NOT NULL,
                `password` varchar(100) NOT NULL,
                `last_visit` int(11) NOT NULL)";
            $this->dbh->exec($sql);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * Close database connection
     */
    public function close () {
        $this->dbh = NULL;
    }
}