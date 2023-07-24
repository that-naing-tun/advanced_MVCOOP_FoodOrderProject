<?php

class DeliveryPrice extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('DeliveryPriceModel');
        $this->db = new Database();
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $city_id = $_POST['city'];
            $township_id = $_POST['township'];
            $street_id = $_POST['street_name'];

            if ($city_id == "Select City" || $township_id == "Select Township" || $street_id == "Select Street Name") {
                redirect('dashboard/deliverypriceCreate');
                echo "<div><p>Please choose Address City ,Township and street</p></div>";
                // setMessage('error', "Please choose Address City ,Township and street");
                die();
            }

            $deliveryCompany_id = $_POST['company_id'];
            $deliveryPrice_id = $_POST['price_id'];


            $deliveryprice = new DeliveryPriceModel();

            $deliveryprice->setCity_ID($city_id);
            $deliveryprice->setTownship_ID($township_id);
            $deliveryprice->setStreet_ID($street_id);
            $deliveryprice->setDeliveryCompany_ID($deliveryCompany_id);
            $deliveryprice->setDeliveryPrice_ID($deliveryPrice_id);


            $iscreated = $this->db->create('delivery_price', $deliveryprice->toArray());
            redirect('dashboard/deliveryPrice');
        }
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['deliveryPrice_id'];
            $city_id = $_POST['city_id'];
            $township_id = $_POST['township_id'];
            $street_id = $_POST['street_id'];
            $deliveryCompany_id = $_POST['deliveryCompany_id'];
            $deliveryPrice_id = $_POST['price_id'];
            // $phone_number = $_POST['phone_number'];


            $deliveryprice = new DeliveryPriceModel();
            $deliveryprice->setId($id);
            $deliveryprice->setCity_ID($city_id);
            $deliveryprice->setTownship_ID($township_id);
            $deliveryprice->setStreet_ID($street_id);
            $deliveryprice->setDeliveryCompany_ID($deliveryCompany_id);
            $deliveryprice->setDeliveryPrice_ID($deliveryPrice_id);

            $iscreated = $this->db->update('delivery_price', $deliveryprice->getId(), $deliveryprice->toArray());
            redirect('dashboard/deliveryPrice');
        }
    }

    public function editdeliveryPrice($id)
    {

        $deliveryPrice_Id = $this->db->getViewByDeliveryID('vw_deliveryprice', $id);
        $data = [
            'delivery_price' => $deliveryPrice_Id
        ];

        $this->view('deliveryPrice/edit', $data);
    }
}
