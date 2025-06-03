<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}


class Type
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }


    public static function readAll()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $type = $cnx->query('SELECT DISTINCT * FROM `type`');
        return $type;
    }

}