<?php
require_once('C:/xampp/htdocs/web2/config.php');
include 'C:/xampp/htdocs/web2/model/evenements.php';
include 'C:/xampp/htdocs/web2/controller/userC.php';
include 'C:/xampp/htdocs/web2/controller/categorieC.php';

class evenementC
{

    public function create($evenement)
    {

        $sql = "INSERT INTO `evenements`(`nom`, `description`, `type`,`lieu`, `ide`) VALUES (:nom,:description, :type, :lieu ,:ide )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $evenement->getNom(),
                'description' => $evenement->getDescription(),
                'ide' => $evenement->getIde(),
                'type' => $evenement->getType(),
                'lieu' => $evenement->getLieu(),
            ]);
            header('Location:evenements.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function participer($u, $f)
    {
        $sql = "INSERT INTO `par`(`idu`, `idp`) VALUES (:a,:b)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'a' => $u,
                'b' => $f,
            ]);
            header('Location:mesevenment.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function deletep()
    {
        if (isset($_GET['del'])) {
            $db = config::getConnexion();
            if (isset($_GET['del'])) {
                $id = $_GET['del'];
                $sql = "DELETE FROM `par` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:mesevenment.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function readp($id)
    {
        $sql = "SELECT * FROM par WHERE `idu` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM evenements";
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
        $sql = "SELECT * FROM evenements where id like '%$r%' or nom like '%$r%' or description like '%$r%'";
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
        $sql = "SELECT * FROM evenements order by $r";
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
        $sql = "SELECT * FROM evenements WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $f = $liste->fetch();
            return $f;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) {
            $db = config::getConnexion();
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $sql = "DELETE FROM `evenements` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:evenements.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function update($evenement, $id)
    {
        $sql = "UPDATE `evenements` SET `nom`=:nom,`description`=:description,`type`=:type,`lieu`=:lieu WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $evenement->getNom(),
                'description' => $evenement->getDescription(),
                'type' => $evenement->getType(),
                'lieu' => $evenement->getLieu(),
                'id' => $id,

            ]);
            header('Location:evenements.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
