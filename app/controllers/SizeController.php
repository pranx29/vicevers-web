<?php
require_once '../app/core/Controller.php';

class SizeController extends Controller
{

    private $sizeModel;

    public function __construct()
    {
        $this->sizeModel = $this->loadModel('Size');
    }

    public function index()
    {
        $sizes = $this->sizeModel->getAllSizes();
        $this->renderView('admin/index', [
            'title' => 'Sizes',
            'sizes' => $sizes,
            'views' => 'admin/product/size',
        ]);
    }

    public function add()
    {
        $name = isset($_GET['sizeName']) ? trim($_GET['sizeName']) : '';
        $label = isset($_GET['sizeLabel']) ? trim($_GET['sizeLabel']) : '';

        if (empty($name)) {
            $error = "Size name is required.";
            return;
        }

        try {
            if ($this->sizeModel->addSize($name, $label)) {
                header('Location: ' . HOME_URL . '/products/size');
            } else {
                $error = "Failed to add size.";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }

        echo "Add size";
    }
}
