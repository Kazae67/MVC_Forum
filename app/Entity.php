<?php
    namespace App;

    abstract class Entity{
/* (1) La méthode "hydrate" prend un paramètre appelé "$data", 
       qui est supposé être un tableau associatif contenant les données à hydrater dans l'objet. 
       La méthode parcourt chaque élément du tableau avec une boucle "foreach".
   (2) À chaque itération de la boucle, la clé de l'élément est stockée dans la variable "$field".
   (3) La valeur est stockée dans la variable "$value".
   (4) La ligne suivante divise la clé en utilisant le caractère "_" comme séparateur. 
       Par exemple, si la clé est "marque_id", alors la variable "$fieldArray" contiendra le tableau ["marque", "id"]. 
       Cette étape est effectuée en utilisant la fonction "explode" de PHP.
   (5) La prochaine condition vérifie si le deuxième élément du tableau "$fieldArray" existe et est égal à "id". 
       Cela indique qu'il s'agit d'une référence à une autre entité. 
       Par exemple, si la clé est "marque_id", cela signifie qu'il y a une relation avec une autre entité appelée "Marque". 
       Dans ce cas, le code construit dynamiquement le nom de la classe du gestionnaire correspondant à cette entité en utilisant 
       la première partie de la clé (en majuscule) suivie de "Manager". 
       Par exemple, pour "marque_id", le nom de classe serait "MarqueManager".
   (6) Ensuite, le code construit le nom complet de la classe du gestionnaire en concaténant la chaîne "Model\Managers" 
       avec le nom de classe du gestionnaire calculé précédemment. 
       Le séparateur de répertoire "DS" est utilisé pour représenter le séparateur de chemin de fichier approprié pour le système d'exploitation.
   (7) Une fois que le nom complet de la classe du gestionnaire est obtenu, une nouvelle instance de cette classe est créée en utilisant l'opérateur "new".
   (8) Ensuite, la méthode "findOneById" du gestionnaire est appelée avec la valeur associée à la clé dans le tableau "$data". 
       Cela suppose que le gestionnaire possède une méthode "findOneById" qui récupère les données de l'entité référencée par l'ID.
       La valeur de la clé est mise à jour avec le résultat de l'appel à la méthode "findOneById". 
       Cela signifie que la valeur originale (qui était un ID) est remplacée par l'objet de l'entité référencée.
   (9) Ensuite, le code construit dynamiquement le nom de la méthode "setter" à appeler en utilisant la première partie de la clé (en majuscule) précédée de "set". 
       Par exemple, pour la clé "marque_id", le nom de la méthode serait "setMarque".
   (10)Le code vérifie si la méthode calculée existe dans l'objet actuel en utilisant la fonction "method_exists" de PHP.
       Si la méthode existe, elle est appelée avec la valeur mise à jour en tant que paramètre. 
   (11)Cela permet de définir la valeur de la propriété de l'objet correspondante à l'aide du setter approprié.
   (12)La méthode "hydrate" se termine une fois que toutes les paires clé-valeur du tableau "$data" ont été traitées.
*/
        protected function hydrate($data){ // (1)

            foreach($data as $field => $value){

                //field = marque_id (2)
                //fieldarray = ['marque','id']
                $fieldArray = explode("_", $field); // (4)

                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){ // (5)
                    $manName = ucfirst($fieldArray[0])."Manager";
                    $FQCName = "Model\Managers".DS.$manName; // (6)
                    
                    $man = new $FQCName(); // (7)
                    $value = $man->findOneById($value); // (3), (8)
                }
                //fabrication du nom du setter à appeler (ex: setMarque)
                $method = "set".ucfirst($fieldArray[0]); // (9)
               
                if(method_exists($this, $method)){ // (10)
                    $this->$method($value); // (11)
                }

            }
        } // (11)
        
        public function getClass(){
            return get_class($this);
        }
    }