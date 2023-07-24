<?php

class Address extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('AddressModel');
        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            redirect('dashboard/category');
        }
    }
}
