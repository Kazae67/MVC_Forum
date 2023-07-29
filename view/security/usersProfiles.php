<?php
// Vérifie si la clé "user" existe dans $result["data"] et stocke sa valeur dans $user
$user = isset($result["data"]['user']) ? $result["data"]['user'] : null; 

// Vérifie si la clé "posts" existe dans $result["data"] et stocke sa valeur dans $lastPosts
$lastPosts = isset($result["data"]['posts']) ? $result["data"]['posts'] : null; 

// Vérifie si l'utilisateur est banni
$userBanned = $user && $user->getBan() == 1; 
?>

<?php if ($admin && !$userBanned): ?>
    <!-- Affiche un lien pour bannir l'utilisateur -->
    <a class="button-red" href="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>">Ban this user</a>
<?php elseif ($admin && $userBanned): ?>
    <!-- Affiche un lien pour débannir l'utilisateur -->
    <a class="button-green" href="index.php?ctrl=security&action=unbanUser&id=<?= $user->getId() ?>">Unban this user</a>
<?php endif; ?>

<?php if ($user): ?>
    <!-- Affiche les informations de l'utilisateur -->
    <p>Nickname : <?= $user->getNickname(); ?></p>
    <p>Role : <?= $user->getRole(); ?></p>
    <p>Email: <?= $user->getEmail(); ?></p>
    <p>Register date : <?= $user->getUser_registration_date(); ?></p>
    <!-- Affiche l'état du compte de l'utilisateur -->
    <div style="display:flex; flex-direction:row; align-items:center;">
        <?php if ($userBanned): ?>
            <p class='button'>Account: Banned</p>
        <?php else: ?>
            <p class='button'>Account : Active</p>
        <?php endif; ?>
    </div>
<?php endif; ?>