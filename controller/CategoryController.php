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

    // La méthode deleteCategory
    public function deleteCategory() {
        $this->restrictTo('admin');

        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        if ($id) {
            $this->categoryManager->delete($id);
            Session::addFlash('success', "The category has been successfully deleted.");
        } else {
            Session::addFlash('error', "Please, provide a valid category id.");
        }

        $this->redirectTo('category', 'index');
    }


    // Méthode pour editer une catégorie
    public function editCategory() {
        $this->restrictTo('admin');
    
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryLabel = filter_input(INPUT_POST, "categoryLabel", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if ($id && $categoryLabel) {
                $this->categoryManager->update($id, $categoryLabel);
                Session::addFlash('success', "The category has been successfully updated.");
                $this->redirectTo('category', 'index');
            } else {
                Session::addFlash('error', "Please, provide a valid category id and label.");
            }
        } else {
            $category = $this->categoryManager->findOneById($id);
    
            if (!$category) {
                Session::addFlash('error', "The category does not exist.");
                $this->redirectTo('category', 'index');
            }
    
            return [
                "view" => VIEW_DIR . "forum/editCategory.php",
                "data" => compact('category')
            ];
        }
    }
    
}
?>
