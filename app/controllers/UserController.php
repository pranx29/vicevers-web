<?php
require_once '../app/core/Controller.php';

class UserController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
    }

    public function index()
    {
        $customers = $this->userModel->getAllCustomers();
        $this->renderView('admin/index', [
            'title' => 'Users',
            'customers' => $customers,
            'views' => 'admin/customer/index',
        ]);
    }
    public function changeStatus()
    {
        $customer_id = $_GET['customer_id'];
        $status = $_GET['status'];
        $this->userModel->changeStatus($customer_id, $status);
        header('Location: ' . HOME_URL . 'customers');
    }
}
