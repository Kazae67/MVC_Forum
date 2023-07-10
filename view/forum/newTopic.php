<?php
// Vérifie si une catégorie a été envoyée dans les données de réponse et l'assigne si c'est le cas
$category = $result["data"]['category'] ?? null;

// Vérifie si un utilisateur est connecté
$userLoggedIn = isset($_SESSION["user"]);
?>

<?php if ($userLoggedIn && $category) : ?>
    <!-- NOUVEAU TOPIC -->
    <h3>Add a topic to the category "<?= $category->getCategoryLabel() ?>"</h3>

    <form class="form-new-topic" action="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>" method="POST">
        <label for="title">Topic name</label>
        <input type="text" name="title" id="title">

        <label for="text">Topic description</label>
        <textarea rows="5" name="text" id="text"></textarea>

        <input class="button" type="submit" name="submit" id="submit" value="Create the topic">
    </form>
<?php elseif(!$userLoggedIn) : ?>
    <!-- L'utilisateur n'est pas connecté -->
    <a href="index.php?ctrl=security&action=login">Please log in</a>
<?php else : ?>
    <!-- Pas de catégorie sélectionnée -->
    <p>Please select a category first</p>
<?php endif; ?>
