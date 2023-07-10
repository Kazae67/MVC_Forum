<?php
    // Vérifier si il y a des erreurs dans la réponse
    $error = $result["data"]['error'] ?? null;

    // Récupérer les catégories de la réponse
    $categories = $result["data"]['categories'];

    // Vérifier si l'utilisateur actuel est un administrateur
    $admin = isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == 'admin';
?>

<h3>List of categories</h3>

<!-- Si l'utilisateur est un administrateur, afficher le formulaire d'ajout de catégorie -->
<?php if ($admin) : ?>
    <form action="index.php?ctrl=category&action=addCategory" method="post">
        <label for="categoryLabel">New category :</label>
        <input type="text" name="categoryLabel" id="categoryLabel">
        <input type="submit" name="submit" id="submit" value="Add">
    </form>
<?php endif; ?>

<!-- Si il y a des catégories, afficher la liste des catégories -->
<?php if ($categories) : ?>
    <table class="list-categories">
        <thead>
            <tr>
                <th>Category name</th>
            </tr>
        </thead>
        <tbody>
            <!-- Parcourir chaque catégorie et afficher son nom -->
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
