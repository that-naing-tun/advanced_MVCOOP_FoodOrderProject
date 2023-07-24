<?php

class AddressModel
{
    private $id;
    private $street_id;
    private $user_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }



    public function setStreet_id($street_id)
    {
        $this->street_id = $street_id;
    }
    public function getStreet_id()
    {
        return $this->street_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserID()
    {
        return $this->user_id;
    }

    public function toArray()
    {
        return [
            "id" => $this->getID(),
            "street_id" => $this->getStreet_id(),
            "user_id" => $this->getUserID(),
        ];
    }
}
