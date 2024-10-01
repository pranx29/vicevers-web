<?php
require_once '../app/core/Controller.php';

class AccountController extends Controller
{

    private $userModel;
    private $contactModel;
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
        $this->contactModel = $this->loadModel('Contact');
        $this->cartModel = $this->loadModel('Cart');
        $this->orderModel = $this->loadModel('Order');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function account()
    {

        if (!isset($_SESSION['user_id']) && $_SESSION['logged_in'] !== true) {
            header('Location: account/login');
            exit();
        }

        $user = $this->userModel->getUser($_SESSION['user_id']);
        $items_count = $this->cartModel->getCartItemCount($_SESSION['user_id']);
        $_SESSION['items_count'] = $items_count;
        $contactinfo = $this->contactModel->getContactinfo($_SESSION['user_id']);

        $this->renderView('customer/layout', [
            'title' => 'Account',
            'views' => 'customer/auth/account',
            'views2' => 'customer/profile/index',
            'user' => $user,
            'contactInfo' => $contactinfo,
            'error' => isset($error) ? $error : null,
        ]);
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
                $user_id = $this->userModel->authenticate($email, $password, 'customer');
                if ($user_id !== null && !empty($user_id)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['logged_in'] = true;
                    $this->account();
                    exit();
                } else {
                    $error = 'Invalid email or password';
                }
            }
        }
        $this->renderView('customer/layout', [
            'title' => 'Login',
            'views' => 'customer/auth/login',
            'error' => isset($error) ? $error : null,
        ]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            if (empty($fname)) {
                $error = 'First name cannot be empty';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format';
            } elseif (!empty($this->userModel->isEmailExist($email))) {
                $error = 'Email already exists';
            } elseif (empty($password)) {
                $error = 'Password cannot be empty';
            } else {
                $user_id = $this->userModel->register($fname, $lname, $email, $password);
                if ($user_id !== null && !empty($user_id)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['logged_in'] = true;
                    $this->account();
                    exit();
                } else {
                    $error = 'Registration failed. Try again';
                }
            }
        }
        $this->renderView('customer/layout', [
            'title' => 'Login',
            'views' => 'customer/auth/register',
            'error' => isset($error) ? $error : null,
            'fname' => isset($fname) ? $fname : null,
            'lname' => isset($lname) ? $lname : null,
            'email' => isset($email) ? $email : null,
            'password' => isset($password) ? $password : null
        ]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: login');
        exit();
    }

    public function update()
    {
        header('Content-Type: application/json');

        if (isset($_GET['type']) && $_GET['type'] == 'contact') {
            $contactId = isset($_GET['contactId']) ? $_GET['contactId'] : null;
            $phoneNumber = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
            $street = isset($_GET['street']) ? $_GET['street'] : null;
            $city = isset($_GET['city']) ? $_GET['city'] : null;
            $postalCode = isset($_GET['postalCode']) ? $_GET['postalCode'] : null;

            if (empty($phoneNumber)) {
                $response = ['success' => false, 'message' => 'Phone number cannot be empty'];
            } elseif (empty($street)) {
                $response = ['success' => false, 'message' => 'Street cannot be empty'];
            } elseif (empty($city)) {
                $response = ['success' => false, 'message' => 'City cannot be empty'];
            } elseif (empty($postalCode)) {
                $response = ['success' => false, 'message' => 'Postal code cannot be empty'];
            } elseif (empty($contactId)) {
                $response = ['success' => false, 'message' => 'Contact ID cannot be empty'];
            } else {
                if ($this->contactModel->update($contactId, $street, $city, $postalCode, $phoneNumber)) {
                    $response = ['success' => true, 'message' => 'Contact information updated successfully'];
                } else {
                    $response = ['success' => false, 'message' => 'Contact information update failed'];
                }
            }
        } else if (isset($_GET['type']) && $_GET['type'] == 'profile') {
            $fname = isset($_GET['fname']) ? $_GET['fname'] : null;
            $lname = isset($_GET['lname']) ? $_GET['lname'] : null;
            $email = isset($_GET['email']) ? $_GET['email'] : null;

            if (empty($fname)) {
                $response = ['success' => false, 'message' => 'First name cannot be empty'];
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response = ['success' => false, 'message' => 'Invalid email format'];
            } else if (!empty($this->userModel->isEmailExist($email) && ($email !== $this->userModel->getEmail($_SESSION['user_id'])))) {
                $response = ['success' => false, 'message' => 'Email already exists'];
            } else {
                if ($this->userModel->update($_SESSION['user_id'], $fname, $lname, $email)) {
                    $response = ['success' => true, 'message' => 'Profile updated successfully'];
                } else {
                    $response = ['success' => false, 'message' => 'Profile update failed'];
                }
            }
        }

        echo json_encode($response);
    }

    public function orders()
    {
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);
        $this->renderView('customer/layout', [
            'title' => 'Account',
            'views' => 'customer/auth/account',
            'views2' => 'customer/profile/orders',
            'orders' => $orders,
        ]);
    }

    public function orderDetails()
    {
        header('Content-Type: application/json');
        $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;

        if ($orderId) {
            $order = $this->orderModel->getOrderById($orderId);
            $orderItems = $this->orderModel->getOrderItems($orderId);

            if ($order && $orderItems) {
                $response = [
                    'success' => true,
                    'order' => $order,
                    'orderItems' => $orderItems
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Order not found'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Order ID is required' . $orderId
            ];
        }
        echo json_encode($response);
    }


    public function addAddress()
    {
        header('Content-Type: application/json');

        $phoneNumber = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
        $street = isset($_GET['street']) ? $_GET['street'] : null;
        $city = isset($_GET['city']) ? $_GET['city'] : null;
        $postalCode = isset($_GET['postalCode']) ? $_GET['postalCode'] : null;

        if (empty($phoneNumber)) {
            $response = ['success' => false, 'message' => 'Phone number cannot be empty'];
        } elseif (empty($street)) {
            $response = ['success' => false, 'message' => 'Street cannot be empty'];
        } elseif (empty($city)) {
            $response = ['success' => false, 'message' => 'City cannot be empty'];
        } elseif (empty($postalCode)) {
            $response = ['success' => false, 'message' => 'Postal code cannot be empty'];
        } else {
            if ($this->contactModel->add($_SESSION['user_id'], $street, $city, $postalCode, $phoneNumber)) {
                $response = ['success' => true, 'message' => 'Contact information added successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Contact information add failed'];
            }
        }

        echo json_encode($response);
    }
}