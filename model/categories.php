<?php
class categories
{
    private $id = null;
    private $nom = null;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
}
