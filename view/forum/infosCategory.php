<?php
// On assigne les catégories ou une liste vide si aucune catégorie n'est présente
$categories = $result["data"]['categories'] ?? [];
?>

<!-- LISTE DES CATÉGORIES -->
<h3>Category list</h3>

<form action="index.php?ctrl=category&action=addNewCategory" method="post">
    <label for="categoryLabel">New Category:</label>
    <input type="text" name="categoryLabel" id="categoryLabel">
    <input type="submit" name="submit" id="submit" value="Add">
</form>

<?php foreach ($categories as $category) : ?>
    <div class="category-post">
        <p>
            <!-- Le lien dirige vers la liste des sujets de la catégorie -->
            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getTitle() ?>">
                <?= $category->getCategoryLabel() ?>
            </a>
            <?php
            ?>
        </p>
    </div>
<?php endforeach; ?>
