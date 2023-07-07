<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;

class CategoryController extends AbstractController implements ControllerInterface {
    public function index() {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(["categoryLabel", "DESC"]);

        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => compact('categories')
        ];
    }

    public function addNewCategory() {
        if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRole() !== "admin") {
            Session::addFlash('error', "Please, log in before adding a new category.");
            $this->redirectTo('category', 'index');
        }
    }
    
}