<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class HomeController extends AbstractController implements ControllerInterface {
    private $userManager;

    // Constructeur pour l'injection de dépendance de UserManager
    public function __construct() {
        $this->userManager = new UserManager();
    }

    // Méthode pour la page d'accueil
    public function index() {
        return [
            "view" => VIEW_DIR . "home.php"
        ];
    }

    // Méthode pour afficher la liste des utilisateurs
    public function users() {
        // Restreindre l'accès à cette méthode aux utilisateurs ayant le rôle 'admin'
        $this->restrictTo("admin");

        // Récupérer tous les utilisateurs, triés par date d'inscription décroissante
        $users = $this->userManager->findAll(['user_registration_date', 'DESC']);

        return [
            "view" => VIEW_DIR . "security/users.php",
            "data" => compact('users')
        ];
    }
}

?>
