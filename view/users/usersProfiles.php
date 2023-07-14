<?php
// Vérifie si la clé "user" existe dans $result["data"] et stocke sa valeur dans $user
$user = isset($result["data"]['user']) ? $result["data"]['user'] : null; 

// Vérifie si la clé "posts" existe dans $result["data"] et stocke sa valeur dans $lastPosts
$lastPosts = isset($result["data"]['posts']) ? $result["data"]['posts'] : null; 

$admin = isset($_SESSION['user']) && in_array($_SESSION['user']->getRole(), ['admin', 'administrator']); // Vérifie si la clé 'user' existe dans $_SESSION et si son rôle correspond à 'admin' ou 'administrator'. Stocke le résultat dans $admin

// Vérifie si l'utilisateur est banni
$userBanned = $user && $user->getBan() == 1; 

?>


<?php if ($admin && !$userBanned): ?>

    <a class="button" href="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>">Ban this user</a>
<?php elseif ($admin && $userBanned): ?>

    <a class="button" href="index.php?ctrl=security&action=unbanUser&id=<?= $user->getId() ?>">Unban this user</a>
<?php endif; ?>


