<?php
require_once("../BD/Mysql.php");

class LoginModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($usr,$password)
    {
        $sql = "SELECT * FROM usuario WHERE usr = '$usr' and password = '$password'";
        $request = $this->select($sql);
        return $request;
    }
}