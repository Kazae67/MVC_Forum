<?php
$error = $result["data"]['error'] ?? null;
$categories = $result["data"]['categories'];
$admin = isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == 'admin';
?>

<h3>List of categories</h3>

<?php if ($admin) : ?>
    <form action="index.php?ctrl=category&action=addCategory" method="post">
        <label for="categoryLabel">New category :</label>
        <input type="text" name="categoryLabel" id="categoryLabel">
        <input type="submit" name="submit" id="submit" value="add">
    </form>
<?php endif; ?>

<?php if ($categories) : ?>
    <table class="list-categories">
        <thead>
            <tr>
                <th>Category name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td>
                        <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                            <?= $category->getCategoryLabel() ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
