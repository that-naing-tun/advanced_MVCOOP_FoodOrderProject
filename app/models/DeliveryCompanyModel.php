<?php

class DeliveryCompanyModel
{
    private $id;
    private $image;
    private $company_name;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }



    public function setimage($image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;
    }

    public function getCompany_name()
    {
        return $this->company_name;
    }

    public function toArray()
    {
        return [
            "id" => $this->getID(),
            "image" => $this->getImage(),
            "company_name" => $this->getCompany_name(),
        ];
    }
}
