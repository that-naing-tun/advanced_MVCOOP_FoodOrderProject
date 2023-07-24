<?php

class Order extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('OrderModel');
        $this->db = new Database();
    }

    public function index()
    {
        $this->view('order/table');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deliveryfee_id =   $_POST['price_id'];
            $delivery_company =  $_POST['delivery_company'];
            $user_address = $_POST['user_address'];
            if ($delivery_company == "Company Name" || $deliveryfee_id == "Suitable Price" || $user_address == "Select Address") {
                redirect('pages/order');
                die();
            }

            $food_id = $_POST['food_id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "3";
            $userid = $_POST['user_id'];


            $address = $this->db->getByUserAddress('vw_userprofileupdate', $user_address);
            $addressid = $address['address_id'];


            $order = new OrderModel();

            $order->setFood_id($food_id);
            $order->setQty($qty);
            $order->setTotal($total);
            $order->setOrder_date($order_date);
            $order->setStatus_id($status);
            $order->setUser_id($userid);
            $order->setAddress_id($addressid);
            $order->setDelivery_fee($deliveryfee_id);
            $order->setDelivery_Company($delivery_company);
            // $order->setPhone_Number($user_Ph);

            $iscreated = $this->db->create('tbl_order', $order->toArray());
            redirect('pages/index');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['order_id'];
            $food_id = $_POST['food_id'];
            $qty = $_POST['qty'];
            $total = $_POST['total'];
            $order_date = $_POST['order_date'];
            $status_id = $_POST['status_id'];
            $user_id = $_POST['user_id'];
            $address_id = $_POST['address_id'];
            $deliveryPrice_id = $_POST['deliveryPrice_id'];
            $deliveryCompany_id = $_POST['deliveryCompany_id'];
            // $phone_number = $_POST['phone_number'];


            $order = new OrderModel();
            $order->setId($id);
            $order->setFood_id($food_id);
            $order->setQty($qty);
            $order->setTotal($total);
            $order->setOrder_date($order_date);
            $order->setStatus_id($status_id);
            $order->setUser_id($user_id);
            $order->setAddress_id($address_id);
            $order->setDelivery_fee($deliveryPrice_id);
            $order->setDelivery_Company($deliveryCompany_id);
            // $order->setPhone_Number($phone_number);

            $iscreated = $this->db->update('tbl_order', $order->getId(), $order->toArray());
            redirect('order/table');
        }
    }

    public function foodorder($id)
    {

        $foodId = $this->db->getById('tbl_food', $id);
        $userDetails = $this->db->readAll('users');
        $data = [
            'food' => $foodId
        ];

        $this->view('pages/order', $data);
    }

    public function editorder($id)
    {

        $orderId = $this->db->getViewByID('vw_orderall', $id);
        $data = [
            'order' => $orderId
        ];

        $this->view('order/edit', $data);
    }

    public function destroy($id)
    {

        $order = new OrderModel();

        $order->setId($id);

        $isDestroyed = $this->db->delete('tbl_order', $order->getId());
        // $id = $_POST['id'];
        //$this->db->delete('expenses', $id);
        //setMessage("Expense Data has been Deleted");
        redirect('order/table');
    }
}
