<?php
$category = $result["data"]['category'] ?? null;

$userLoggedIn = isset($_SESSION["user"]);
?>

<?php if ($userLoggedIn && $category) : ?>
    <h3>Add a topic to the category "<?= $category->getCategoryLabel() ?>"</h3>

    <form class="form-new-topic" action="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>" method="POST">
        <label for="title">Topic name</label>
        <input type="text" name="title" id="title">

        <label for="text">Topic description</label>
        <textarea rows="5" name="text" id="text"></textarea>

        <input class="button" type="submit" name="submit" id="submit" value="Create the topic">
    </form>

<?php elseif(!$userLoggedIn) : ?>
    <a href="index.php?ctrl=security&action=login">Please log in</a>
<?php else : ?>
    <p>Please select a category first</p>
<?php endif; ?>