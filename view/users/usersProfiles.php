<?php

$user = isset($result["data"]['user']) ? $result["data"]['user'] : null; 


$lastPosts = isset($result["data"]['posts']) ? $result["data"]['posts'] : null; 

$admin = isset($_SESSION['user']) && in_array($_SESSION['user']->getRole(), ['admin', 'administrator']); // Vérifie si la clé 'user' existe dans $_SESSION et si son rôle correspond à 'admin' ou 'administrator'. Stocke le résultat dans $admin


$userBanned = $user && $user->getBan() == 1; 

?>



