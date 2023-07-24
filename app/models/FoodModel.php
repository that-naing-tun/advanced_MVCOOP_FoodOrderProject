<?php

class FoodModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $title;
    private $image;
    private $featured;
    private $active;
    private $description;
    private $price;
    private $categoryid;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }
    public function getFeatured()
    {
        return $this->featured;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
    public function getActive()
    {
        return $this->active;
    }

    public function setDescription($id)
    {
        $this->description = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPrice($id)
    {
        $this->price = $id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setCategoryid($id)
    {
        $this->categoryid = $id;
    }

    public function getCategoryid()
    {
        return $this->categoryid;
    }


    public function toArray()
    {
        return [
            "id" => $this->getID(),
            "title" => $this->getTitle(),
            "description" => $this->getDescription(),
            "price" => $this->getPrice(),
            "image_name" => $this->getImage(),
            "category_id" => $this->getCategoryid(),
            "featured" => $this->getFeatured(),
            "active" => $this->getActive()

        ];
    }
}
