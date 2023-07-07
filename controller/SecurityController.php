<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

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

    public function register()
    {
        if (!isset($_POST["submit"])) {
            $this->redirectTo('security', 'index');
        }

        $userManager = new UserManager();

        $nickName = filter_input(INPUT_POST, "nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordConfirm = filter_input(INPUT_POST, "passwordConfirm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if (!$nickName || !$password || !$passwordConfirm || !$email) {
            $this->redirectTo('security', 'index');
        }

        if ($userManager->findOneByEmail($email) || $userManager->findOneByNickname($nickName)) {
            $this->redirectTo('security', 'index');
        }

        if ($password != $passwordConfirm) {
            $this->redirectTo('security', 'index');
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $userManager->add(["nickName" => $nickName, "password" => $password, "email" => $email]);

        Session::addFlash('success', 'you are registered !');
        $this->redirectTo('security', 'login');
    }

}
