<?php

/**
 * Created by PhpStorm.
 * User: Pavlo
 * Date: 22.12.2016
 * Time: 9:33
 */
class Config
{
    private $ht = "localhost";
    private $usr = "root";
    private $pss = "";
    private $db = "zinit_db";

    public function getHost()
    {
        return $this->ht;
    }

    public function getUser()
    {
        return $this->usr;
    }

    public function getPassword()
    {
        return $this->pss;
    }

    public function getDatabase()
    {
        return $this->db;
    }
}