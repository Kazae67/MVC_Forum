<?php
$categories = $result["data"]['categories'];
?>

<h3>Category list</h3>


    <form action="index.php?ctrl=category&action=addNewCategory" method="post">
        <label for="categoryLabel">New Category :</label>
        <input type="text" name="categoryLabel" id="categoryLabel">
        <input type="submit" name="submit" id="submit" value="new">
    </form>

    <div class="forum-post-category">
        <p>
            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                <?= $category->getCategoryLabel() ?>
            </a>
        </p>
    </div>
