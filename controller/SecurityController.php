<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class SecurityController extends AbstractController implements ControllerInterface
{
    public function index()
    {
        return [
            "view" => VIEW_DIR . "security/register.php"
        ];
    }

    public function linkToLogin()
    {
        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "security/login.php",
            "data" => [
                "users" => $userManager->findAll(["user_registration_date", "DESC"])
            ]
        ];
    }

}
