<?php

class User
{
    private $id = null;
    private $nom = null;
    private $prenom = null;
    private $email = null;
    private $password = null;
    private $age = null;
    private $type = null;

    // Getter and Setter for $id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter and Setter for $nom
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    // Getter and Setter for $prenom
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    // Getter and Setter for $email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter and Setter for $password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getter and Setter for $age
    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    // Getter and Setter for $type
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function __construct($nom, $prenom, $email, $password, $age, $type)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->age = $age;
        $this->type = $type;
    }
}
