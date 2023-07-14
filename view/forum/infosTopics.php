<?php
// Récupération des données nécessaires
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;

// Vérification du rôle de l'utilisateur
$admin = isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ["admin", "moderator"]);
?>

<!-- Header avec le bouton de retour, le titre de la catégorie et le bouton pour créer un nouveau topic -->
<div class="header-infos-topics">
  <a href="index.php?ctrl=category" class="button">Back to the category list</a>
  <h3>Category: <?= $category->getCategoryLabel() ?></h3>
  <a class="button" href="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>

<!-- Liste des topics -->
<?php if ($topics): ?>
  <div class="topic-container">
    <div class="topic-header">
        <span class="topic-author"></span>
        <span class="topic-object"></span>
      <span class="topic-date"></span>
    </div>
    <ul class="topic-list">
      <?php foreach ($topics as $topic): ?>
        <li class="topic-row">
          <a href="index.php?ctrl=post&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
          <p class="<?= $topic->getUser()->getRole()?>">
            <a href="index.php?ctrl=security&action=usersProfiles&id=<?= $topic->getUser()->getId() ?>">
              <?= $topic->getUser()->getNickName() ?>
            </a>
          </p>
          <div class="container-admin-locked">
            <div class="<?= $topic->getLocked()?>">
              <i class="fa-solid <?= $topic->getLocked()?>"></i>
            </div>
          </div>
          <!-- Options d'administration -->
          <?php if ($admin): ?>
            <div class='container-admin'>
              <a class='admin-lock' href='index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>'></a>
            </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>