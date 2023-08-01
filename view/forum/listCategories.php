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
                <?php if ($admin): ?>
                    <th>Actions</th>
                <?php endif; ?>
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
                        <div class="category-name">
                            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                                <?= $category->getCategoryLabel() ?>
                            </a>
                            <?php if ($admin): ?>
                                <form class="edit-form" style="display: none;" action="index.php?ctrl=category&action=editCategory&id=<?= $category->getId() ?>" method="post">
                                    <input type="text" name="categoryLabel" value="<?= $category->getCategoryLabel() ?>">
                                    <input type="submit" name="submit" value="Update">
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                    <?php if ($admin): ?>
                        <td>
                            <div class="container-admin">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="index.php?ctrl=category&action=deleteCategory&id=<?= $category->getId() ?>" class="confirm" data-action="delete"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(e){
            e.preventDefault();
            var $row = $(this).closest('tr');
            $row.find('.category-name a').hide();
            $row.find('.edit-form').show();
        });

        $('.edit-form').submit(function(e){
            e.preventDefault();
            var $form = $(this);
            var url = $form.attr('action');
            var data = $form.serialize();

            $.post(url, data, function(response) {
                location.reload();
            });
        });
    });
</script>
