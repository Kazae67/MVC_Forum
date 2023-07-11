<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{
    private $userManager;

    const SUCCESS_REGISTRATION = 'you are registered !';
    const SUCCESS_LOGIN = 'successful connection';
    const SUCCESS_LOGOUT = 'successful disconnection';
    const ERROR_LOGOUT = 'disconnection failed';

    // Injecter UserManager via le constructeur pour faciliter la réutilisation
    public function __construct() {
        $this->userManager = new UserManager();
    }

    // Renvoyer la vue pour l'inscription
    public function index() {
        return [
            "view" => VIEW_DIR . "security/register.php"
        ];
    }

    // Renvoyer la vue pour la connexion, avec la liste des utilisateurs
    // La fonction compact est utilisée pour créer un tableau associatif à partir de la variable $users
    public function toLogin() {
        $users = $this->userManager->findAll(["user_registration_date", "DESC"]);
        return [
            "view" => VIEW_DIR . "security/login.php",
            "data" => compact('users') 
        ];
    }

    // Cette méthode s'occupe de l'enregistrement d'un nouvel utilisateur
    // Les méthodes isValidRegistration, filterPost sont introduites pour améliorer la lisibilité et la maintenabilité du code
    public function register() {
        if (!isset($_POST["submit"])) {
            $this->redirectTo('security', 'index');
        }

        $nickName = $this->filterPost("nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $this->filterPost("password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordConfirm = $this->filterPost("passwordConfirm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = $this->filterPost("email", FILTER_SANITIZE_EMAIL);

        if (!$this->isValidRegistration($nickName, $password, $passwordConfirm, $email)) {
            $this->redirectTo('security', 'index');
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->userManager->add(["nickName" => $nickName, "password" => $password, "email" => $email]);

        Session::addFlash('success', self::SUCCESS_REGISTRATION);
        $this->redirectTo('security', 'login');
    }

    // Cette méthode s'occupe de la connexion d'un utilisateur
    // Les méthodes isValidLogin, isValidUser, filterPost sont introduites pour améliorer la lisibilité et la maintenabilité du code
    public function login() {
        if (!isset($_POST["submit"])) {
            $this->redirectTo('security', 'toLogin');
        }

        $email = $this->filterPost("email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $this->filterPost("password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$this->isValidLogin($email, $password)) {
            $this->redirectTo('security', 'toLogin');
        }

        $user = $this->userManager->findOneByEmail($email);

        if (!$this->isValidUser($user, $password)) {
            $this->redirectTo('security', 'toLogin');
        }

        Session::setUser($user);
        Session::addFlash('success', self::SUCCESS_LOGIN);
        $this->redirectTo('security', 'viewProfile');
    }

    // Cette méthode s'occupe de la déconnexion d'un utilisateur
    public function logout() {
        if (!$_SESSION["user"]) {
            Session::addFlash('error', self::ERROR_LOGOUT);
            $this->redirectTo('user', 'index');
        }

        session_destroy();
        Session::addFlash('success', self::SUCCESS_LOGOUT);
        $this->redirectTo('security', 'toLogin');
    }

    // Méthode pour filtrer les données POST pour éviter les injections
    private function filterPost($key, $filter) {
        return filter_input(INPUT_POST, $key, $filter);
    }

    // Méthode pour valider les données d'enregistrement
    private function isValidRegistration($nickName, $password, $passwordConfirm, $email) {
        if (!$nickName || !$password || !$passwordConfirm || !$email) {
            return false;
        }

        if ($this->userManager->findOneByEmail($email) || $this->userManager->findOneByNickname($nickName)) {
            return false;
        }

        if ($password != $passwordConfirm) {
            return false;
        }

        return true;
    }

    // Méthode pour valider les données de connexion
    private function isValidLogin($email, $password) {
        if (!$email || !$password) {
            return false;
        }
        return true;
    }

    // Méthode pour valider un utilisateur
    private function isValidUser($user, $password) {
        if (!$user || $user->getBan() == 1 || !password_verify($password, $user->getPassword())) {
            return false;
        }
        return true;
    }
}
//save
