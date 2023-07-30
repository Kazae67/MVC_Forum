<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\Manager;

class SecurityController extends AbstractController implements ControllerInterface
{
    private $userManager;

    const SUCCESS_REGISTRATION = 'you are registered !';
    const SUCCESS_LOGIN = 'successful connection';
    const SUCCESS_LOGOUT = 'successful disconnection';
    const ERROR_LOGOUT = 'disconnection failed';
    const SUCCESS_BAN = 'User has been banned';
    const SUCCESS_UNBAN = 'User has been unbanned';

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
        $password_confirmation = $this->filterPost("password_confirmation", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = $this->filterPost("email", FILTER_SANITIZE_EMAIL);
    
        if (!$this->isValidRegistration($nickName, $password, $password_confirmation, $email)) {
            $this->redirectTo('security', 'index');
        }
            
        // Générer la date et l'heure d'aujourd'hui au format Y-m-d H:i:s
        $user_registration_date = date("Y-m-d H:i:s");
    
        // Hasher le mot de passe pour le stockage sécurisé
        $password = password_hash($password, PASSWORD_DEFAULT);
    
        // Ajouter l'utilisateur à la base de données avec la date d'inscription
        $this->userManager->add([
            "nickName" => $nickName,
            "password" => $password,
            "email" => $email,
            "user_registration_date" => $user_registration_date
        ]);
    
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
        $this->redirectTo('security', 'myProfile');
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

    public function myProfile()
    {
        if (!$_SESSION["user"]) {
            Session::addFlash('error', 'You need to login first');
            $this->redirectTo('security', 'login');
        }

        return [
            "view" => VIEW_DIR . "security/myProfile.php",
            "data" => [
                "user" => $_SESSION["user"]
            ]
        ];
    }

    // Méthode pour filtrer les données POST pour éviter les injections
    private function filterPost($key, $filter) {
        return filter_input(INPUT_POST, $key, $filter);
    }

    // Méthode pour valider les données d'enregistrement
    private function isValidRegistration($nickName, $password, $password_confirmation, $email) {
        if (!$nickName || !$password || !$password_confirmation || !$email) {
            return false;
        }

        if ($this->userManager->findOneByEmail($email) || $this->userManager->findOneByNickname($nickName)) {
            return false;
        }

        if ($password != $password_confirmation) {
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

    // Méthode pour voir les profiles
    public function usersProfiles($id)
    {
        // Récupérez l'utilisateur en fonction de son ID
        $user = $this->userManager->findOneById($id);

        if (!$user) {
            Session::addFlash('error', 'User not found');
            $this->redirectTo('security', 'toLogin');
        }

        // Vérifiez si l'utilisateur actuel est un administrateur
        $admin = $_SESSION["user"]->isAdmin();

        return [
            "view" => VIEW_DIR . "security/usersProfiles.php",
            "data" => [
                "user" => $user,
                "admin" => $admin,
            ],
        ];
    }

    public function banUser()
    {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $user = $this->userManager->findOneById($id);

    if (!$user) {
        Session::addFlash('error', 'User not found');
        $this->redirectTo('security', 'toLogin');
        return;
    }

    $this->userManager->banUserById($id);
    Session::addFlash('success', 'User has been banned');

    $this->redirectTo('security', 'usersProfiles', ['id' => $id]);
}


}
