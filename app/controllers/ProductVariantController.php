<?php
require_once '../app/core/Controller.php';
require_once '../app/models/Product.php';
require_once '../app/models/Category.php';
require_once '../app/models/Color.php';
require_once '../app/models/Size.php';
require_once '../app/models/ProductVariant.php';
require_once '../app/models/ProductImage.php';

class ProductVariantController extends Controller
{
    private $categoryModel;
    private $colorModel;
    private $sizeModel;
    private $productVariantModel;
    private $productImageModel;

    private $productModel;

    public function __construct()
    {
        $this->categoryModel = $this->loadModel('Category');
        $this->colorModel = $this->loadModel('Color');
        $this->sizeModel = $this->loadModel('Size');
        $this->productVariantModel = $this->loadModel('ProductVariant');
        $this->productImageModel = $this->loadModel('ProductImage');
        $this->productModel = $this->loadModel('Product');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    }

    public function addVariant()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        $product = $this->productModel->getProductById($productId);

        if ($product['product_id'] === null) {
            header('Location: ' . HOME_URL . 'products');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $colorId = $_POST['color'];
            $sizes = $_POST['size'];
            $imageUrls = json_decode($_POST['imageUrls'], true);

            if (empty($colorId)) {
                $eror = 'Color is required';
            } else if (empty($sizes)) {
                $error = 'Size is required';
            } else {
                $quantityInStock = [];
                foreach ($sizes as $sizeId) {
                    $quantityKey = $sizeId . '_quantity';
                    $quantityInStock[$sizeId] = isset($_POST[$quantityKey]) ? (int) $_POST[$quantityKey] : 0;
                    if (!$this->productVariantModel->addProductVariant($productId, $sizeId, $colorId, $quantityInStock[$sizeId])) {
                        $error = 'Failed to add product variant.';
                        break;
                    }
                }

                // Add product images
                if (!empty($imageUrls)) {
                    foreach ($imageUrls as $imageUrl) {
                        if (!$this->productImageModel->addProductImage($imageUrl, $productId, $colorId)) {
                            $error = 'Failed to add product image.';
                            break;
                        }
                    }
                }

                // Redirect to product details page
                header('Location: ' . HOME_URL . 'products/details?productId=' . $productId);
            }
        }

        $this->renderView('admin/index', [
            'title' => 'Product',
            'categories' => $this->categoryModel->getAllCategory(),
            'colors' => $this->colorModel->getAllColors(),
            'sizes' => $this->sizeModel->getAllSizes(),
            'views' => 'admin/product/add_variant',
            'product' => $product,
            'error' => isset($error) ? $error : null,
        ]);
    }

    public function updateQuantity()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $productVariantId = $_GET['productVariantId'];
        $quantity = $_GET['quantity'];

        if ($quantity < 0) {
            $error = 'Quantity must be greater than or equal to 0.';
            return;
        }

        if ($this->productVariantModel->updateQuantity($productVariantId, $quantity)) {
            header('Location: ' . HOME_URL . 'products/details?productId=' . $_GET['productId']);
            exit();
        } else {
            $error = 'Failed to update quantity.';
        }
    }
}
