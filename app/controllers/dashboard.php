<?php
class dashboard extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }


    public function index()
    {
        $this->view('backend/dashboard');
    }

    public function admin()
    {
        $user = $this->db->readAll('users');
        $data = [
            'user' => $user
        ];
        $this->view('backend/admin', $data);
    }

    public function category()
    {
        $category = $this->db->readAll('tbl_category');
        $data = [
            'category' => $category
        ];
        $this->view('category/table', $data);
    }

    public function createcategory()
    {

        $this->view('category/create');
    }


    public function foods()
    {
        $category = $this->db->readAll('tbl_food');
        $data = [
            'food' => $category
        ];
        $this->view('food/table', $data);
    }

    public function order()
    {
        $order = $this->db->readAll('tbl_order');
        $data = [
            'order' => $order
        ];
        $this->view('order/table', $data);
    }

    public function addfood()
    {
        $category = $this->db->readAll('tbl_category');
        $data = [
            'food' => $category
        ];
        $this->view('food/create', $data);
    }

    public function DeliveryCompany()
    {
        $delivery_company = $this->db->readAll('delivery_company');
        $data = [
            'delivery_company' => $delivery_company
        ];
        $this->view('DeliveryCompany/table', $data);
    }

    public function createDeliveryCompany()
    {
        $this->view('DeliveryCompany/create');
    }


    public function deliveryprice()
    {

        $this->view('deliveryPrice/table');
    }
    public function deliverypriceCreate()
    {

        $this->view('deliveryPrice/create');
    }
}
