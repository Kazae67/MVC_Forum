<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;

class CategoryController extends AbstractController implements ControllerInterface {

    private $categoryManager;

    // Injecter le CategoryManager dans le constructeur pour le réutiliser
    public function __construct() {
        $this->categoryManager = new CategoryManager();
    }

    public function index() {
        $categories = $this->categoryManager->findAll(["categoryLabel", "DESC"]);

        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => compact('categories')
        ];
    }

    public function addCategory() {
        $this->restrictTo('admin');

        if (isset($_POST["submit"])) {
            $categoryLabel = filter_input(INPUT_POST, "categoryLabel", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($categoryLabel) {
                $this->categoryManager->add(["categoryLabel" => $categoryLabel]);
                Session::addFlash('success', "The new category has been correctly added.");
            } else {
                Session::addFlash('error', "Please, provide a valid category label.");
            }
        }

        $this->redirectTo('category', 'index');
    }
}
?>
