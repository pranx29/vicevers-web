<?php
class CartController extends Controller
{

    private $cartModel;
    private $productVariantModel;
    private $userId;
    public function __construct()
    {
        $this->cartModel = $this->loadModel('Cart');
        $this->productVariantModel = $this->loadModel('ProductVariant');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
        } else {
            $this->userId = null;
        }
    }

    public function index()
    {
        $cartProducts = $this->cartModel->getCartProduct($this->userId);
        $this->renderView(
            'customer/layout',
            [
                'title' => 'Cart',
                'cartProducts' => $cartProducts,
                'views' => 'customer/cart/view-cart',
            ]
        );
    }

    public function add()
    {
        header('Content-Type: application/json');
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        $colorId = isset($_GET['colorId']) ? $_GET['colorId'] : null;
        $sizeId = isset($_GET['sizeId']) ? $_GET['sizeId'] : null;
        $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

        $productVariantId = $this->productVariantModel->getVariantId($productId, $sizeId, $colorId);
        $response = ['success' => false, 'message' => ''];

        try {
            if ($productVariantId) {
                if ($this->userId) {
                    $cartId = $this->cartModel->getCartId($this->userId);
                    if ($this->cartModel->addCartItem($cartId, $productVariantId, $quantity)) {
                        $response['success'] = true;
                        $response['message'] = 'Product added to cart';
                        $_SESSION['items_count'] = $this->cartModel->getCartItemCount($this->userId);
                    } else {
                        $response['message'] = 'Failed to add product to cart';
                    }
                } else {
                    //TODO write code to add cart item to session when user is not logged in
                    $response['success'] = false;
                    $response['message'] = 'Please login to add product to cart';
                }
            } else {
                $response['message'] = 'Product variant not found';
            }
        } catch (Exception $e) {
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
        echo json_encode($response);
    }

    public function remove()
    {
        header('Content-Type: application/json');
        $cart_item_id = isset($_GET['cartItemId']) ? $_GET['cartItemId'] : null;
        $response = ['success' => false, 'message' => ''];

        try {
            if ($this->cartModel->removeCartItem($cart_item_id)) {
                $response['success'] = true;
                $response['message'] = 'Product removed from cart';
                $_SESSION['items_count'] = $this->cartModel->getCartItemCount($this->userId);
            } else {
                $response['message'] = 'Failed to remove product from cart';
            }
        } catch (Exception $e) {
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
        echo json_encode($response);
    }

    public function update()
    {
        header('Content-Type: application/json');
        $cart_item_id = isset($_GET['cartItemId']) ? $_GET['cartItemId'] : null;
        $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;
        $response = ['success' => false, 'message' => ''];

        try {
            if ($this->cartModel->updateCartItem($cart_item_id, $quantity)) {
                $response['success'] = true;
                $response['message'] = 'Cart updated';
                $_SESSION['items_count'] = $this->cartModel->getCartItemCount($this->userId);
            } else {
                $response['message'] = 'Failed to update cart';
            }
        } catch (Exception $e) {
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
        echo json_encode($response);
    }

}