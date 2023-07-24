<?php

class Pages extends Controller
{

    private $db;
    public function __construct()
    {
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function index()
    {
        $category = $this->db->readAll('tbl_category');
        $food = $this->db->readAll('tbl_food');
        $data = [
            'food' => $food,
            'category' => $category
        ];
        $this->view('pages/index', $data);
    }

    public function categories()
    {
        $category = $this->db->readAll('tbl_category');
        $data = [
            'category' => $category
        ];
        $this->view('pages/categories', $data);
    }

    public function foods()
    {
        $food = $this->db->readAll('tbl_food');
        $data = [
            'food' => $food
        ];
        $this->view('pages/foods', $data);
    }


    public function login()
    {
        $this->view('pages/login');
    }

    public function register()
    {
        $this->view('pages/register');
    }

    public function order()
    {
        $this->view('pages/order');
    }

    public function township()
    {
        $this->view('pages/township_list');
    }


    public function street()
    {
        $this->view('pages/street_name_list');
    }

    public function profile()
    {
        $this->view('pages/profile');
    }

    public function update_profile()
    {
        $this->view('pages/update_profile');
    }

    public function address()
    {
        $this->view('pages/address_list');
    }

    public function price()
    {
        $this->view('pages/price_list');
    }

    public function view_order()
    {
        $this->view('pages/view_order');
    }

    // public function townshipname()
    // {
    //     $this->view('pages/townshipName_list');
    // }

    // public function streetName()
    // {
    //     $this->view('pages/streetNameList');
    // }
}
