<?php
require_once '../app/core/Controller.php';

class ProductController extends Controller
{
    private $categoryModel;
    private $colorModel;
    private $sizeModel;
    private $productModel;
    private $productVariantModel;

    private $productImageModel;
    private $discountModel;

    private $genders;

    public function __construct()
    {
        $this->productModel = $this->loadModel('Product');
        $this->categoryModel = $this->loadModel('Category');
        $this->colorModel = $this->loadModel('Color');
        $this->sizeModel = $this->loadModel('Size');
        $this->productVariantModel = $this->loadModel('ProductVariant');
        $this->productImageModel = $this->loadModel('ProductImage');
        $this->discountModel = $this->loadModel('Discount');
        $this->genders = [
            ['id' => '1', 'name' => 'Men'],
            ['id' => '2', 'name' => 'Women']
        ];
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
        $products = $this->productModel->getAllProducts();


        $this->renderView('admin/index', [
            'title' => 'Products',
            'products' => $products,
            'categories' => $this->categoryModel->getAllCategory(),
            'colors' => $this->colorModel->getAllColors(),
            'sizes' => $this->sizeModel->getAllSizes(),
            'genders' => $this->genders,
            'views' => 'admin/product/index',
        ]);
    }

    public function add()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productName = isset($_POST['productName']) ? $_POST['productName'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $categoryId = isset($_POST['category']) ? $_POST['category'] : null;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : 0;

            if (!$productName) {
                $error = 'Product name is required';
            } else if (!$description) {
                $error = 'Description is required';
            } else if (!$categoryId) {
                $error = 'Category is required';
            } else if (!$gender) {
                $error = 'Gender is required';
            } else if (!$price) {
                $error = 'Price is required';
            } else {
                if ($this->productModel->addProduct($productName, $description, $gender, $price, $isActive, $categoryId)) {
                    header('Location: ' . HOME_URL . 'products');
                    exit();
                } else {
                    $error = 'Failed to add product';
                }
            }

        }
        $this->renderView('admin/index', [
            'title' => 'Product',
            'categories' => $this->categoryModel->getAllCategory(),
            'colors' => $this->colorModel->getAllColors(),
            'sizes' => $this->sizeModel->getAllSizes(),
            'genders' => $this->genders,
            'views' => 'admin/product/add',
            'error' => isset($error) ? $error : null,
        ]);
    }

    public function mensProducts()
    {
        $selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : null;
        $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
        $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;
        $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;

        $products = $this->productModel->getMensProduct($sortby, $selectedCategories, $minPrice, $maxPrice);


        foreach ($products as &$product) {
            $product['sizes'] = $this->productVariantModel->getProductSizes($product['id']);
            $product['colors'] = $this->productVariantModel->getProductColors($product['id']);
        }

        unset($product);

        $this->renderView(

            'customer/layout',
            [
                'title' => 'Mens Wear',
                'categories' => $this->categoryModel->getAllCategory(),
                'colors' => $this->colorModel->getAllColors(),
                'sizes' => $this->sizeModel->getAllSizes(),
                'products' => $products,
                'views' => 'customer/products/mens-wear',
                'sortby' => $sortby,
                'selectedCategories' => $selectedCategories
            ]
        );
    }

    public function edit()
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
            $productName = isset($_POST['productName']) ? $_POST['productName'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $categoryId = isset($_POST['category']) ? $_POST['category'] : null;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : 0;

            if (!$productName) {
                $error = 'Product name is required';
            } else if (!$description) {
                $error = 'Description is required';
            } else if (!$categoryId) {
                $error = 'Category is required';
            } else if (!$gender) {
                $error = 'gender';
            } else if (!$price) {
                $error = 'Price is required';
            } else {
                if ($this->productModel->updateProduct($productId, $productName, $description, $gender, $price, $isActive, $categoryId)) {
                    header('Location: ' . HOME_URL . 'products');
                    exit();
                } else {
                    $error = 'Failed to update product';
                }
            }
        }
        $this->renderView('admin/index', [
            'title' => 'Product',
            'product' => $product,
            'categories' => $this->categoryModel->getAllCategory(),
            'colors' => $this->colorModel->getAllColors(),
            'sizes' => $this->sizeModel->getAllSizes(),
            'genders' => $this->genders,
            'views' => 'admin/product/edit_product',
        ]);
    }

    public function womensProducts()
    {
        $this->renderView(

            'customer/layout',
            [
                'title' => 'Womens Wear',
                'views' => 'customer/products/womens-wear'

            ]
        );
    }

    public function getProduct()
    {
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        $product = $this->productModel->getProductDetails($productId);
        $product['sizes'] = $this->productVariantModel->getProductSizes($product['product_id']);
        $product['colors'] = $this->productVariantModel->getProductColors($product['product_id']);
        $product['images'] = $this->productImageModel->getProductImages($product['product_id']);

        $this->renderView(

            'customer/layout',
            [
                'title' => 'Mens Wear',
                'product' => $product,
                'views' => 'customer/products/product-page'
            ]
        );
    }


    public function details()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        $product = $this->productModel->getProductDetails($productId);
        $productVariants = $this->productVariantModel->getVariantsByProductId($productId);
        $productImages = $this->productImageModel->getProductImages($productId);
        $discount = $this->discountModel->getActiveDiscountByProductId($productId);

        $this->renderView(

            'admin/index',
            [
                'title' => 'Products',
                'views' => 'admin/product/view-product',
                'product' => $product,
                'productVariants' => $productVariants,
                'productImages' => $productImages,
                'discount' => $discount
            ]
        );
    }

    public function addDiscount()
    {
        if ((!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true)) {
            header('Location: ' . HOME_URL . 'admin/login');
            exit();
        }
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        $product = $this->productModel->getProductById($productId);
        $discounts = $this->discountModel->getDiscountsByProductId($productId);

        if ($product['product_id'] === null) {
            header('Location: ' . HOME_URL . 'products');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $discount = isset($_POST['discount_percentage']) ? $_POST['discount_percentage'] : null;
            $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
            $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
            $isActive = isset($_POST['is_active']) ? $_POST['is_active'] : 0;

            if (!$discount) {
                $error = 'Discount is required';
            } else {
                if ($this->discountModel->changeDiscountStatus($productId, 0) && $this->discountModel->addDiscount($productId, $discount, $startDate, $endDate, $isActive)) {
                    header('Location: ' . HOME_URL . 'products/add-discount?productId=' . $productId);
                    exit();
                } else {
                    $error = 'Failed to add discount';
                }
            }
        }

        $this->renderView('admin/index', [
            'title' => 'Product',
            'product' => $product,
            'views' => 'admin/product/add-discount',
            'discounts' => $discounts,
            'error' => isset($error) ? $error : null,
        ]);
    }

}
