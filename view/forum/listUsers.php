<?php
$users = $result['data']['users'] ?? null;
$admin = $_SESSION['user']->getRole() == 'admin';
?>

<table>
    <thead>
        <tr>
            <th>Nickname</th>
            <th>Email</th>
            <th>Registration date</th>
            <th>Role</th>
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
