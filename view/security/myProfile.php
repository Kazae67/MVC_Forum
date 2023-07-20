<?php
$user = $_SESSION["user"];
?>

<p>Nickname: <?= $user->getNickname(); ?></p>
<p>Role: <?= $user->getRole(); ?></p>
<p>Creation date: <?= $user->getUser_registration_date(); ?></p>
<?php
var_dump($user->getUser_registration_date());
?>
<p>Email: <?= $user->getEmail(); ?></p>

<p>Account status: 
<?php if ($user->getBan() == 1) {
    echo "<p>This account is unvalid, you probably have been banned.</p>";
} else {
    echo "This account is valid.";
} ?>
</p>

<?php
var_dump($_SESSION['user']->getId());
?>