<?php
require_once '../app/core/Controller.php';

class CategoryController extends Controller
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = $this->loadModel('Category');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } 
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true) && !isset($_SESSION['user_id'])) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategory();
        $this->renderView('admin/index', [
            'title' => 'Categories',
            'categories' => $categories,
            'views' => 'admin/product/category',
        ]);
    }

    public function add()
    {
        $name = isset($_GET['categoryName']) ? trim($_GET['categoryName']) : '';
        $description = isset($_GET['categoryDescription']) ? trim($_GET['categoryDescription']) : '';

        if (empty($name) || empty($description)) {
            $error = "Both category name and description are required.";
            return;
        }

        try {
            if ($this->categoryModel->addCategory($name, $description)) {
                $this->index();
            } else {
                $error = "Failed to add category.";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }



}