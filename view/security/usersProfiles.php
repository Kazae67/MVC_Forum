<script src="public/js/alertConfirm.js"></script>
<?php
// Vérifie si la clé "user" existe dans $result["data"] et stocke sa valeur dans $user
$user = isset($result["data"]['user']) ? $result["data"]['user'] : null; 

// Vérifie si la clé "admin" existe dans $result["data"] et stocke sa valeur dans $admin
$admin = isset($result["data"]['admin']) ? $result["data"]['admin'] : null;

// Vérifie si la clé "posts" existe dans $result["data"] et stocke sa valeur dans $lastPosts
$lastPosts = isset($result["data"]['posts']) ? $result["data"]['posts'] : null; 

// Vérifie si l'utilisateur est banni
$userBanned = $user && $user->getBan() == 1; 
?>

<?php if ($admin && !$userBanned): ?>
    <!-- Affiche un lien pour bannir l'utilisateur -->
    <a class="button-red confirm" data-action="ban" href="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>">Ban this user</a>
<?php elseif ($admin && $userBanned): ?>
    <!-- Affiche un lien pour débannir l'utilisateur -->
    <a class="button-green confirm" data-action="unban" href="index.php?ctrl=security&action=unbanUser&id=<?= $user->getId() ?>">Unban this user</a>
<?php endif; ?>

<?php if ($admin): ?>
    <!-- Affiche une liste déroulante pour changer le rôle de l'utilisateur -->
    <form action="index.php" method="get">
        <input type="hidden" name="ctrl" value="security">
        <input type="hidden" name="id" value="<?= $user->getId() ?>">
        <select class="confirm" data-action="change role of" name="action" id="roleSelect">
            <option value="">Select role</option>
            <option value="setUserRole">Set as User</option>
            <option value="setAdminRole">Set as Admin</option>
        </select>
        <button type="submit" id="roleSubmit" style="display: none;">Submit</button>
    </form>
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
            <p class='button'>Account: This account is unvalid, probably have been banned.</p>
        <?php else: ?>
            <p class='button'>Account status: This account is valid.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>
