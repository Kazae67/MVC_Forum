<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class HomeController extends AbstractController implements ControllerInterface {
    public function index() {
        return [
            "view" => VIEW_DIR . "home.php"
        ];
    }

    public function users() {
        $this->restrictTo("role");

        return [
            "view" => VIEW_DIR . "security/users.php",
            "data" => [
                "users" => (new UserManager())->findAll(['user_registration_date', 'DESC'])
            ]
        ];
    }
}
?>
