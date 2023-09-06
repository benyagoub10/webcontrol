<?php
require_once('C:/xampp/htdocs/web2/config.php');
include 'C:/xampp/htdocs/web2/model/categories.php';

class categorieC
{

    //ajouter 
    public function create($categorie)
    {

        $sql = "INSERT INTO `categories`(`nom`) VALUES (:nom)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $categorie->getNom(),
            ]);
            header('Location:categories.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    // afficher
    public function read()
    {
        $sql = "SELECT * FROM categories";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    // trier
    public function sort($r)
    {
        $sql = "SELECT * FROM categories order by $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    // rechercher
    public function search($r)
    {
        $sql = "SELECT * FROM categories where id like '%$r%' or nom like '%$r%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    // supprimer
    public function delete()
    {
        if (isset($_GET['delete'])) {
            $db = config::getConnexion();
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $sql = "DELETE FROM `categories` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:categories.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }
    /// modifier
    public function update($user, $id)
    {
        $sql = "UPDATE `categories` SET `nom`=:nom WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'id' => $id,

            ]);
            header('Location:categories.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    // selection 1 par id 
    public function findone($id)
    {
        $sql = "SELECT * FROM categories WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $t = $liste->fetch();
            return $t;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    // statitstic
    public function stat()
    {
        $sql = "SELECT * FROM categories";
        $db = config::getConnexion();
        try {
            $data = null;
            $i = 0;
            $liste = $db->query($sql);
            foreach ($liste as $l) {
                $id = $l['id'];
                $sql0 = "SELECT nom FROM `categories` WHERE `id` = $id";
                $sql1 = "SELECT count(*) FROM `evenements` WHERE `type` = $id";
                $db = config::getConnexion();
                $count = $db->query($sql1)->fetch();
                $nom = $db->query($sql0)->fetch();
                echo ('<div class="card">
                <div class="card-body"><div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Type ');
                echo ($nom['nom']);
                echo (' </h5>
                  <h4 class="fw-semibold mb-3">un total de ');
                echo ($count['count(*)']);
                echo ('  évenements </h4>
                </div></div>
                </div>');
            }
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
