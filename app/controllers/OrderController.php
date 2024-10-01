<?php
require_once '../app/core/Controller.php';

class OrderController extends Controller
{
    private $orderModel;
    private $contactModel;

    public function __construct()
    {
        $this->orderModel = $this->loadModel('Order');
        $this->contactModel = $this->loadModel('Contact');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } 
    }

    public function index()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $orders = $this->orderModel->getAllOrders();
        $this->renderView('admin/index', [
            'title' => 'Orders',
            'orders' => $orders,
            'views' => 'admin/order/index',
        ]);
    }

    public function details()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $orderId = $_GET['orderId'];
        $order = $this->orderModel->getOrderById($orderId);
        $orderItems = $this->orderModel->getOrderItems($orderId);
        $delivery = $this->contactModel->getDeliveryDetails($orderId);
        $this->renderView('admin/index', [
            'title' => 'Order Details',
            'order' => $order,
            'orderItems' => $orderItems,
            'delivery' => $delivery,
            'views' => 'admin/order/view-order',
        ]);
    }

    public function updateStatus()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $orderId = $_GET['orderId'];
        $status = $_GET['status'];

        if (empty($orderId)) {
            $error = 'Order ID is required';
        } else if (empty($status)) {
            $error = 'Status is required';
        } else {
            $this->orderModel->updateStatus($orderId, $status);
            header('Location: ' . HOME_URL . '/orders/details?orderId=' . $orderId);
        }
    }

}
