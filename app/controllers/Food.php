<?php

require_once APPROOT . '../config/config.php';

class Food extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('FoodModel');
        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $msg = "";
            $image = $_FILES['image']['name'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            if (
                empty($title) || empty($description) || empty($price) || empty($category) ||
                empty($image) || empty($featured) || empty($active)
            ) {
                redirect('dashboard/addfood');
                die();
            }

            $target = "food_images/" . basename($image);
            if (!file_exists('food_images/')) {
                mkdir('food_images/', 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Faild To Upload Image";
            }


            $food = new FoodModel();

            $food->setTitle($title);
            $food->setDescription($description);
            $food->setPrice($price);
            $food->setImage($image);
            $food->setCategoryid($category);
            $food->setFeatured($featured);
            $food->setActive($active);

            $iscreated = $this->db->create('tbl_food', $food->toArray());
            redirect('dashboard/foods');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $categoryId = $_POST['category'];
            $current_image = $_POST['current_image'];

            $image = $_FILES['image']['name'];
            if ($image) {
                if (!file_exists('food_images/')) {
                    mkdir('food_images/', 0777, true);
                }
                $target = "food_images/" . $image;
                $sourcePath = $_FILES['image']['tmp_name'];
                move_uploaded_file($sourcePath, $target);

                if ($current_image) {
                    $remove_path = "food_images/" . $current_image;
                    if (file_exists($remove_path)) {
                        unlink($remove_path);
                    }
                }
            } else {
                $image = $current_image;
            }

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            $food = new FoodModel();
            $food->setId($id);
            $food->setTitle($title);
            $food->setDescription($description);
            $food->setPrice($price);
            $food->setImage($image);
            $food->setCategoryid($categoryId);
            $food->setFeatured($featured);
            $food->setActive($active);

            $iscreated = $this->db->update('tbl_food', $food->getId(), $food->toArray());
            redirect('dashboard/foods');
        }
    }

    public function editFood($id)
    {
        $id = base64_decode($id);
        $category = $this->db->readAll('tbl_category');
        $foodId = $this->db->getById('tbl_food', $id);
        $data = [
            'category' => $category,
            'food' => $foodId
        ];

        $this->view('food/edit', $data);
    }

    public function destroy($id)
    {
        $foodData = $this->db->getById('tbl_food', $id);
        $foodImage = $foodData['image_name'];

        $food = new FoodModel();

        $food->setId($id);

        $isDestroyed = $this->db->delete('tbl_food', $food->getId());
        if ($isDestroyed) {
            if ($foodData) {
                $remove_path = "food_images/" . $foodImage;
                if (file_exists($remove_path)) {
                    unlink($remove_path);
                }
            }
        }

        redirect('dashboard/foods');
    }
}
