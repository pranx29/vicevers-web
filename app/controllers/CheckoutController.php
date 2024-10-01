<?php

class CheckoutController extends Controller
{

    private $userModel;
    private $contactModel;
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = $this->loadModel('User');
        $this->contactModel = $this->loadModel('Contact');
        $this->cartModel = $this->loadModel('Cart');
        $this->orderModel = $this->loadModel('Order');
    }
    public function index($error = null)
    {
        $user = $this->userModel->getUser($_SESSION['user_id']);
        $contactinfo = $this->contactModel->getContactinfo($_SESSION['user_id']);
        $cartItems = $this->cartModel->getCartProduct($_SESSION['user_id']);

        if (empty(($cartItems))) {
            header('Location: ' . HOME_URL . 'cart');
        }

        $this->renderView(
            'customer/layout',
            [
                'title' => 'Checkout',
                'views' => 'customer/cart/checkout',
                'user' => $user,
                'contactinfo' => $contactinfo,
                'cartItems' => $cartItems,
                'error' => $error
            ]
        );
    }

    public function checkout()
    {

        $user_id = $_SESSION['user_id'];

        $contact_id = isset($_POST['address']) ? $_POST['address'] : null;
        $shippingMethod = isset($_POST['shippingMethod']) ? $_POST['shippingMethod'] : null;
        $cardHolder = isset($_POST['cardHolder']) ? $_POST['cardHolder'] : null;
        $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : null;
        $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : null;
        $expirationDate = isset($_POST['expirationDate']) ? $_POST['expirationDate'] : null;

        if (empty($contact_id) || empty($shippingMethod) || empty($cardHolder) || empty($cardNumber) || empty($cvv) || empty($expirationDate)) {
            $error = 'Please fill all the fields';
        } else {
            $cartId = $this->cartModel->getCartId($user_id);
            $totalAmount = $this->cartModel->getCartTotal($user_id);
            if ($totalAmount !== null) {
                $orderCreated = $this->orderModel->createOrder($user_id, $cartId, $contact_id, $shippingMethod, $totalAmount + 399);
                if ($orderCreated) {
                    header('Location: ' . HOME_URL . 'account/orders');
                    exit();
                } else {
                    $error = 'Order creation failed. Please try again.';
                }
            } else {
                $error = 'Please add items to create order.';
            }
        }

        $this->index($error);

    }
}