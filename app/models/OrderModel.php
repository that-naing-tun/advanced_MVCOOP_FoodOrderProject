<?php

class OrderModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $food_id;
    private $qty;
    private $total;
    private $order_date;
    private $status_id;
    private $user_id;
    private $address_id;
    private $delivery_fee;
    // private $phone_number;
    private $delivery_company;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setFood_id($food_id)
    {
        $this->food_id = $food_id;
    }
    public function getFood_id()
    {
        return $this->food_id;
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setOrder_date($order_date)
    {
        $this->order_date = $order_date;
    }

    public function getOrder_date()
    {
        return $this->order_date;
    }

    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
    }

    public function getStatus_id()
    {
        return $this->status_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setAddress_id($address_id)
    {
        $this->address_id = $address_id;
    }

    public function getAddress_id()
    {
        return $this->address_id;
    }

    public function setDelivery_fee($delivery_fee)
    {
        $this->delivery_fee = $delivery_fee;
    }

    public function getDelivery_fee()
    {
        return $this->delivery_fee;
    }

    // public function setPhone_Number($phone_number)
    // {
    //     $this->phone_number = $phone_number;
    // }

    // public function getPhone_Number()
    // {
    //     return $this->phone_number;
    // }

    public function setDelivery_Company($delivery_companyid)
    {
        $this->delivery_company = $delivery_companyid;
    }

    public function getDelivery_Company()
    {
        return $this->delivery_company;
    }

    public function toArray()
    {
        return [
            "id" => $this->getID(),
            "food_id" => $this->getFood_id(),
            "qty" => $this->getQty(),
            "total" => $this->getTotal(),
            "order_date" => $this->getOrder_date(),
            "status_id" => $this->getStatus_id(),
            "user_id" => $this->getUser_id(),
            "address_id" => $this->getAddress_id(),
            "delivery_priceID" => $this->getDelivery_fee(),
            // "phone_number" => $this->getPhone_Number(),
            "delivery_companyID" => $this->getDelivery_Company()
        ];
    }
}
