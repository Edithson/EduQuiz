<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
    require_once('model/Enseignant_Matiere.php');
    require_once('model/Matiere.php');
}


class Utilisateur
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }

    public function create($email, $nom, $type, $password=null)
    {
        try {
            $new = $this->cnx->prepare('INSERT INTO utilisateur VALUES(?,?,?,?)');
            if (isset($password) && !empty($password)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $new->execute(array($email, $nom, $password, $type));
            }else {
                $password = password_hash('password', PASSWORD_DEFAULT);
                $new->execute(array($email, $nom, $password, $type));
            }

            /**
             * lorsqu'on enrégistre un nouvel utilisateur super_administrateur, ce dernier doit avoir acces a toutes les matiere qui existent dans la base de donnée
             */
            if ($type > 2) {
                $mt = new Matiere();
                $matieres = $mt->readAll();
                while ($matiere = $matieres->fetch()) {
                    Enseignant_Matiere::create($email, $matiere['id']);
                }
            }

            return true;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
        
    }

    public function update($email, $nom, $type, $Aemail)
    {

        try {
            $update = $this->cnx->prepare('UPDATE utilisateur SET nom=?, email=?, type=? WHERE email=?');
            $update->execute(array($nom, $email, $type, $Aemail));
            return 1;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    public function update_password($email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $update = $this->cnx->prepare('UPDATE utilisateur SET mot_de_passe=? WHERE email=?');
        $update->execute(array($password, $email));
    }

    public static function check($email, $password)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $check = false;
        $info = $cnx->prepare('SELECT email, mot_de_passe FROM utilisateur WHERE email=?');
        $info->execute(array($email));
        if ($info->rowCount() > 0) {
            $info = $info->fetch();
            if (password_verify($password, $info['mot_de_passe'])) {
                $check = true;
            }
        }
        return $check;
    }

    public function read($email)
    {
        $info = $this->cnx->prepare('SELECT nom, email, type FROM utilisateur WHERE email=?');
        $info->execute(array($email));
        return $info;
    }

    public function readAll()
    {
        $info = $this->cnx->query('SELECT nom, email, type FROM utilisateur');
        return $info;
    }

    public function read_eng()
    {
        $info = $this->cnx->query('SELECT nom, email, type FROM utilisateur WHERE type=2');
        return $info;
    }

    public function delete($email)
    {
        $delete = $this->cnx->prepare('DELETE FROM utilisateur WHERE email=?');
        $delete->execute(array($email));
    }

}