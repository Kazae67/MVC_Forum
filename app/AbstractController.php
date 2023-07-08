<?php
    // Namespace
    namespace App;

    // Déclaration d'une classe abstraite, elle ne peut pas être instanciée directement
    abstract class AbstractController{

        
        public function index(){

        }
        
        // Méthode pour rediriger vers une autre page
        public function redirectTo($ctrl = null, $action = null, $id = null){
            // Si le contrôleur n'est pas "home"
            if($ctrl != "home"){
                // Initialisation de l'URL
                $url = "index.php";
                // Ajout du contrôleur à l'URL
                $url = $ctrl ? "/".$ctrl : "";
                // Ajout de l'action à l'URL
                $url.= $action ? "/".$action : "";
                // Ajout de l'id à l'URL
                $url.= $id ? "/".$id : "";
                // Ajout de l'extension à l'URL
                $url.= ".html";
            }
            // Si le contrôleur est "home", l'URL est la racine
            else $url = "/";
            // Redirection vers l'URL
            header("Location: $url");
            // Arrêt du script
            die();

        }

        // Méthode pour restreindre l'accès à un rôle spécifique
        public function restrictTo($role){
            // Si l'utilisateur n'est pas connecté ou n'a pas le rôle requis
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                // Redirection vers la page de connexion
                $this->redirectTo("security", "login");
            }
            return;
        }

    }
