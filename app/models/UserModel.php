<?php

class UserModel
{
    // Access Modifier = public, private, protected
    private $name;
    private $email;
    private $phonenumber;
    private $password;
    private $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setPhoneNumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }
    public function getPhoneNumber()
    {
        return $this->phonenumber;
    }


    public function toArray()
    {
        return [
            "id" => $this->getID(),
            "name" => $this->getName(),
            "phone_number" => $this->getPhoneNumber(),
            "email" => $this->getEmail(),
            "password" => $this->getPassword()
        ];
    }
}
