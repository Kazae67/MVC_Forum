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

    public function toLogin()
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
    
    public function login()
    {
        if (!isset($_POST["submit"])) {
            $this->redirectTo('security', 'toLogin');
        }

        $userManager = new UserManager();

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$email || !$password) {
            $this->redirectTo('security', 'toLogin');
        }

        $user = $userManager->findOneByEmail($email);

        if (!$user || $user->getBan() == 1 || !password_verify($password, $user->getPassword())) {
            $this->redirectTo('security', 'toLogin');
        }

        Session::setUser($user);
        Session::addFlash('success', 'sucessful connection');
        $this->redirectTo('security', 'viewProfile');
    }

    
    public function logout()
    {
        if (!$_SESSION["user"]) {
            Session::addFlash('error', 'disconnection failed');
            $this->redirectTo('user', 'index');
        }

        session_destroy();
        $this->redirectTo('security', 'toLogin');
        Session::addFlash('success', 'sucessful disconnection');
    }
}
