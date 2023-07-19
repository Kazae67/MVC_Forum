<?php
    // Récupération des utilisateurs à partir de la réponse
    $users = $result['data']['users'] ?? null;

    // Vérifie si l'utilisateur actuel est un administrateur
    $isAdmin = $_SESSION['user']->getRole() == 'admin';
?>

<!-- Table utilisateur  -->
<table>
    <thead>
        <tr>
            <th>Nickname</th>
            <th>Email</th>
            <th>Registration date</th>
            <th>Role</th>
            <?php if ($isAdmin) echo "<th>Admin</th>"; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        // Boucle à travers chaque utilisateur
        foreach ($users as $user) :
            // Si l'utilisateur est un administrateur ou un modérateur, il n'est pas affiché
            if ($user->getRole() == 'admin' || $user->getRole() == 'moderator') {
                continue;
            }

            // Affiche les informations de l'utilisateur
            echo "<tr>
                <td>{$user->getNickname()}</td>
                <td>{$user->getEmail()}</td>
                <td>{$user->getUser_registration_date()}</td>
                <td>{$user->getRole()}</td>
            </tr>";
        endforeach;

        ?>
    </tbody>
</table>
