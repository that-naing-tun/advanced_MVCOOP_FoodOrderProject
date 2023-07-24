<?php

class DeliveryCompany extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('DeliveryCompanyModel');
        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            // echo $title;
            // exit;
            $msg = "";
            $image = $_FILES['image']['name'];
            $target = "deliveryCompany_images/" . basename($image);

            if (!file_exists('deliveryCompany_images/')) {
                mkdir('deliveryCompany_images/', 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Faild To Upload Image";
            }




            $delivery = new DeliveryCompanyModel();

            $delivery->setCompany_name($title);
            $delivery->setImage($image);

            $iscreated = $this->db->create('delivery_company', $delivery->toArray());
            redirect('dashboard/DeliveryCompany');
        }
    }
}
