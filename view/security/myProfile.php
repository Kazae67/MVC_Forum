<?php
$user = $_SESSION["user"];
?>

<p>Nickname: <?= $user->getNickname(); ?></p>
<p>Role: <?= $user->getRole(); ?></p>
<p>Creation date: <?= $user->getUser_registration_date(); ?></p>
<p>Email: <?= $user->getEmail(); ?></p>

<p>Account status: 
<?php if ($user->getBan() == 1) {
    echo "<p>Your account is unvalid, you must have been banned.</p>";
} else {
    echo "Your account is valid.";
} ?>
</p>