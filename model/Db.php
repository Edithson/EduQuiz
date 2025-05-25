<?php
class Db
{

    protected $host = 'localhost';
    protected $dbname = 'quiz';
    protected $user_name = 'root';
    protected $password = '';
    protected $connexion;

    public function __construct()
    {
        try {
            $this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8',''.$this->user_name.'',''.$this->password.'');
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $e) {
            die('Une erreur s\'est produite lors de la connexion à la base de données<br>'.$e->getMessage());
        }
    }
    public function getCnx()
    {
        return $this->connexion;
    }
    
}

    