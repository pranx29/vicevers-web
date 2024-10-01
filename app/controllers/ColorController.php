<?php
require_once '../app/core/Controller.php';

class ColorController extends Controller
{

    private $colorModel;

    public function __construct()
    {
        $this->colorModel = $this->loadModel('Color');
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
        $colors = $this->colorModel->getAllColors();
        $this->renderView('admin/index', [
            'title' => 'Colors',
            'colors' => $colors,
            'views' => 'admin/product/color',
        ]);
    }

    public function add()
    {
        $name = isset($_GET['colorName']) ? trim($_GET['colorName']) : '';
        $hexCode = isset($_GET['colorHex']) ? trim($_GET['colorHex']) : '';

        if (empty($name) || empty($hexCode)) {
            $error = "Both color name and hex code are required.";
            return;
        }

        try {
            if ($this->colorModel->addColor($name, $hexCode)) {
                header('Location: ' . HOME_URL . '/products/color');
            } else {
                $error = "Failed to add color.";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }

        echo "Add color";
    }
}
