<?php

class AdminController extends Controller
{
    private $orderModel;
    private $userModel;
    private $productModel;

    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
        $this->orderModel = $this->loadModel('Order');
        $this->productModel = $this->loadModel('Product');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        if (!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true) {
            header('Location: admin/login');
            exit();
        }

        $totalOrders = $this->orderModel->getTotalOrders();
        $totalCustomer = $this->userModel->getTotalCustomers();
        $totalSales = $this->orderModel->getTotalSales();
        $totalProducts = $this->productModel->getTotalProducts();
        $bestSellers = $this->productModel->getThreeBestSellers();
        $lowStockProducts = $this->productModel->getLowStockProducts();
        $monthlySales = $this->orderModel->getMonthlySales();

        $this->renderView(
            'admin/index',
            [
                'title' => 'Dashboard',
                'menuName' => 'Dashboard',
                'views' => 'admin/dashboard',
                'totalOrders' => $totalOrders,
                'totalCustomers' => $totalCustomer,
                'totalSales' => $totalSales,
                'totalProducts' => $totalProducts,
                'bestSellers' => $bestSellers,
                'lowStockProducts' => $lowStockProducts,
                'monthlySales' => $monthlySales,
            ]
        );
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format';
            } elseif (empty($password)) {
                $error = 'Password cannot be empty';
            } else {
                $user_id = $this->userModel->authenticate($email, $password, 'admin');
                if ($user_id !== null && !empty($user_id)) {
                    $_SESSION['admin_id'] = $user_id;
                    $_SESSION['admin_logged_in'] = true;
                    $user = $this->userModel->getUser($_SESSION['admin_id']);
                    $_SESSION['fname'] = $user['fname'];
                    $_SESSION['lname'] = $user['lname'];
                    header('Location: /Ecommerce/admin');
                    exit();
                } else {
                    $error = 'Invalid email or password';
                }
            }
        }

        if ((isset($_SESSION['admin_id']) || isset($_SESSION['admin_logged_in'])) && $_SESSION['admin_logged_in'] === true) {
            header('Location: ' . HOME_URL . '/admin');
            exit();
        } else {
            $this->renderView('admin/login', [
                'title' => 'Login',
                'error' => isset($error) ? $error : null,
            ]);
        }


    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: ' . HOME_URL . 'admin/login');
        exit();
    }

}
