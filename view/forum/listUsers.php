<?php
$users = $result['data']['users'] ?? null;
$admin = $_SESSION['user']->getRole() == 'admin';
?>

<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Date d'inscription</th>
            <th>Role</th>
            <th>Statut</th>
            <?php if ($admin) : ?><th>Admin</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) :
            if ($user->getRole() == 'admin' || $user->getRole() == 'moderator') {
                continue;
            }
        ?>
            <tr>
                <td><?= $user->getNickname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getUser_registration_date() ?></td>
                <td><?= $user->getRole() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
