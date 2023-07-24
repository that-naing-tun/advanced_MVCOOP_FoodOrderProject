<?php

require_once APPROOT . '../config/config.php';

class Category extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('CategoryModel');
        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $title = $_POST['title'];
            $msg = "";
            $image = $_FILES['image']['name'];
            $active = $_POST['active'];


            if (empty($title) || empty($image) || empty($active)) {
                redirect('dashboard/createcategory');
                die();
            }


            $target = "category_images/" . basename($image);

            if (!file_exists('category_images/')) {
                mkdir('category_images/', 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Faild To Upload Image";
            }




            $category = new CategoryModel();

            $category->setTitle($title);
            $category->setImage($image);
            // $category->setFeatured($featured);
            $category->setActive($active);

            $iscreated = $this->db->create('tbl_category', $category->toArray());
            redirect('dashboard/category');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];

            $image = $_FILES['image']['name'];
            if ($image) {
                if (!file_exists('category_images/')) {
                    mkdir('category_images/', 0777, true);
                }
                $target = "category_images/" . $image;
                $sourcePath = $_FILES['image']['tmp_name'];
                move_uploaded_file($sourcePath, $target);

                if ($current_image) {
                    $remove_path = "category_images/" . $current_image;
                    if (file_exists($remove_path)) {
                        unlink($remove_path);
                    }
                }
            } else {
                $image = $current_image;
            }

            $active = $_POST['active'];

            $category = new CategoryModel();
            $category->setId($id);
            $category->setTitle($title);
            $category->setImage($image);
            // $category->setFeatured($featured);
            $category->setActive($active);

            $iscreated = $this->db->update('tbl_category', $category->getId(), $category->toArray());
            redirect('dashboard/category');
        }
    }

    public function editcategory($id)
    {
        $id = base64_decode($id);
        //$category = $this->db->readAll('tbl_category'); // 'category' => $category,
        $categoryId = $this->db->getById('tbl_category', $id);
        $data = [

            'categories' => $categoryId
        ];

        $this->view('category/edit', $data);
    }

    public function destroy($id)
    {
        $categoryData = $this->db->getById('tbl_category', $id);
        $categoryImage = $categoryData['image_name'];

        $category = new CategoryModel();

        $category->setId($id);

        $isDestroyed = $this->db->delete('tbl_category', $category->getId());
        if ($isDestroyed) {
            if ($categoryImage) {
                $remove_path = "category_images/" . $categoryImage;
                if (file_exists($remove_path)) {
                    unlink($remove_path);
                }
            }
        }

        redirect('dashboard/category');
    }
}
