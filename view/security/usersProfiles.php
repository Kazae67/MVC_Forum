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

            <p class='button'>Banned</p>
        <?php else: ?>

            <p class='button'>Active</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<ul>Last posts :
    <?php if ($lastPosts): ?>
        <?php foreach ($lastPosts as $post): ?>
            <!-- Affiche les détails des derniers messages -->
            <div class="forum-last-post">
                <li><?= $post->getTopic()->getTitle(); ?></li>
                <li class="post-date"><?= $post->getPost_creation_date() ?></li>
                <li><?= $post->getText() ?></li><br>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Affiche un message s'il n'y a pas de dernier message -->
        <p>PThere's not last message</p>
    <?php endif; ?>
</ul>