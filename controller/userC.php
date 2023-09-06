<?php
require_once('C:/xampp/htdocs/web2/config.php');
include 'C:/xampp/htdocs/web2/model/user.php';
class userC
{

    public function create($user)
    {

        $sql = "INSERT INTO `users`(`nom`, `prenom`, `email`, `password`, `age`, `type`) VALUES (:nom,:prenom, :email, :password , :age , :type)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'age' => $user->getAge(),
                'type' => $user->getType(),
            ]);
            header('Location:users.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }


    public function read()
    {
        $sql = "SELECT * FROM users";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function sort($r)
    {
        $sql = "SELECT * FROM users order by $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function search($r)
    {
        $sql = "SELECT * FROM users where id like '%$r%' or nom like '%$r%' or prenom like '%$r%' or email like '%$r%' ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function reade()
    {
        $sql = "SELECT * FROM users WHERE type='organisateur'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM users WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $u = $liste->fetch();
            return $u;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($user, $id)
    {
        $sql = "UPDATE `users` SET `nom`=:nom,`prenom`=:prenom,`email`=:email,`password`=:password,`age`=:age,`type`=:type WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'age' => $user->getAge(),
                'type' => $user->getType(),
                'id' => $id,

            ]);
            header('Location:users.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) {
            $db = config::getConnexion();
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $sql = "DELETE FROM `users` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:users.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }
}
