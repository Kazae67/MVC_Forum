<?php
$category = $result["data"]['category'] ?? null;


$userLoggedIn = isset($_SESSION["user"]);
?>

<!-- list -->
<h3>Category list</h3>

    <form action="index.php?ctrl=category&action=addNewCategory" method="post">
        <label for="categoryLabel">New Category :</label>
        <input type="text" name="categoryLabel" id="categoryLabel">
        <input type="submit" name="submit" id="submit" value="new">
    </form>

    <?php if ($categories): foreach ($categories as $category): ?>
    <div class="category-post">
        <p>
            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getTitle() ?>">
                <?= $category->getCategoryLabel() ?>
            </a>
        </p>
    </div>
<?php endforeach; endif; ?>

