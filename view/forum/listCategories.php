<?php
// Vérifier si il y a des erreurs dans la réponse
$error = $result["data"]['error'] ?? null;

// Récupérer les catégories de la réponse
$categories = $result["data"]['categories'];

// Vérifier si l'utilisateur actuel est un administrateur
$admin = isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == 'admin';
?>

<!-- Titre  -->
<div class="header-category"> 
    <h3 class="header-category-center">List of categories</h3>
</div>

<!-- Si il y a des catégories, afficher la liste des catégories -->
<?php if ($categories) : ?>
    <table class="list-categories topic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($admin) : ?>
                <tr>
                    <td></td>
                    <td>
                        <form action="index.php?ctrl=category&action=addCategory" method="post">
                            <label for="categoryLabel">New category :</label>
                            <input type="text" name="categoryLabel" id="categoryLabel">
                            <input type="submit" name="submit" id="submit" value="Add">
                        </form>
                    </td>
                    <td></td>
                </tr>
            <?php endif; ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category->getId() ?></td>
                    <td>
                        <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                            <?= $category->getCategoryLabel() ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($admin): ?>
                            <div class="container-admin">
                                <a href="index.php?ctrl=category&action=editCategory&id=<?= $category->getId() ?>">Edit</a>
                                <a href="index.php?ctrl=category&action=deleteCategory&id=<?= $category->getId() ?>">Delete</a>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
