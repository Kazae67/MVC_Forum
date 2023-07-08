<?php
    namespace App;
    
    class Autoloader{

        // Méthode pour enregistrer l'autoloader
        public static function register(){
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }

        // Méthode d'auto-chargement des classes
        public static function autoload($class){
            // Séparation du nom complet de la classe en plusieurs parties
            $parts = preg_split('#\\\#', $class);

            // Extraction du nom de la classe à partir du tableau de parties
            $className = array_pop($parts);

            // Création du chemin vers la classe avec le séparateur de répertoire
            $path = strtolower(implode(DS, $parts));

            // Nom du fichier de la classe avec extension .php
            $file = $className.'.php';

            // Construction du chemin complet du fichier
            $filepath = BASE_DIR.$path.DS.$file;

            // Vérification de l'existence du fichier et inclusion si nécessaire
            if(file_exists($filepath)){
                require $filepath;
            }
            
        }
    }
