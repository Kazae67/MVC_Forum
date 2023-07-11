<?php
// Récupération des données nécessaires
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;

$admin = isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ["admin", "moderator"]);
?>

<!-- Header avec le bouton de retour, le titre de la catégorie et le bouton pour créer un nouveau topic -->
<div class="header-topic">
  <a title="Go back to categories" href="index.php?ctrl=category" class="button">Back to category list</a>
  <h3>Category: <?= $category->getCategoryLabel() ?></h3>
  <a title="Create a new topic" class="button" href="index.php?ctrl=topic&action=linkAddTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>

<!-- Tableau des topics -->
<?php if ($topics): ?>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Creation date</th>
        <?php if ($admin): ?>
          <th>Admin</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($topics as $topic): ?>
        <tr>
          <td>
            <a title="View topic" href="index.php?ctrl=post&action=listPostByTopic&id=<?= $topic->getId() ?>">
              <?= $topic->getTitle() ?>
            </a>
          </td>
          <td>
            <p title="View profile" class="<?= $topic->getUser()->getRole()?>">
              <a href="index.php?ctrl=security&action=viewUsersProfiles&id=<?= $topic->getUser()->getId() ?>">
                <?= $topic->getUser()->getNickName() ?>
              </a>
            </p>
          </td>
          <td>
            <div class="container-admin">
              <div title="<?= $topic->getIs_Locked() ? "Topic locked" : "Topic closed" ?>">
                <i class="fa-solid fa-lock<?= $topic->getIs_Locked() ? "" : "-open" ?>"></i>
              </div>
            </div>
          </td>
          </td>
          <!-- Options d'ad -->
          <?php if ($admin): ?>
            <td>
              <div class="container-admin">
                <a title="Lock topic" class="admin-lock" href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                  <i class="fa-solid fa-lock"></i>
                </a>
              </div>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<!-- SAUVEGARDE TEST x13 -->
