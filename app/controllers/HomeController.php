<?php
class HomeController extends Controller
{
    private $productModel;
    private $cartModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel('Product');
        $this->cartModel = $this->loadModel('Cart');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        $bestSellers = $this->productModel->getBestSellers();
        $exclusiveOffers = $this->productModel->getExclusiveOffers();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $items_count = $this->cartModel->getCartItemCount($user_id);
            $_SESSION['items_count'] = $items_count;
        }

        $this->renderView(
            'customer/layout',
            [
                'title' => 'Home',
                'bestSellers' => $bestSellers,
                'exclusiveOffers' => $exclusiveOffers,
                'views' => 'customer/home/home-content',
                'items_count' => isset($items_count) ? $items_count : null,
            ]
        );
    }

}
