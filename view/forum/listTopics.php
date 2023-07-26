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
  <a title="Create a new topic" class="button" href="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>

<!-- Tableau des topics -->
<?php if ($topics): ?>
  <table>
    <thead>
      <tr>
        <th>ID</th> 
        <th>Title</th>
        <th>Author</th>
        <th>Creation date</th>
        <?php if ($admin): ?>
          <th>Admin</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <!-- ID -->
      <?php foreach ($topics as $topic):?>
        <?php $topic_id = $topic->getId(); ?> 
        <tr>
          <td><?= $topic_id ?></td>
          <!-- TITLE -->
          <td>
            <a title="View topic" href="index.php?ctrl=post&action=listPostByTopic&id=<?= $topic_id ?>">
              <?= $topic->getTitle() ?>
            </a>
          </td>
          <!-- USER -->
          <td>
            <?php if ($topic->getUser() !== null): ?>
              <p title="View profile" class="<?= $topic->getUser()->getRole() ?>">
                <a href="index.php?ctrl=security&action=usersProfiles&id=<?= $topic->getUser()->getId() ?>">
                  <?= $topic->getUser()->getNickName() ?>
                </a>
              </p>
            <?php else: ?>
              <p>No user available</p>
            <?php endif; ?>
          </td>
          <!-- CREATION DATE -->
          <td>
            <?php
            $topicCreationDate = $topic->getTopic_creation_date();
            if (is_a($topicCreationDate, 'DateTime')) {
                echo $topicCreationDate->format('Y-m-d H:i:s');
            } else {
                echo 'Invalid date';
            }
            ?>
          </td>
          <!-- IS_LOCKED options admin -->
          <td>
            <div class="container-admin">
              <?php if ($topic->getIs_Locked()): ?>
                <div title="Topic locked">
                  <i class="fa-solid fa-lock"></i>
                </div>
              <?php else: ?>
                <div title="Topic open">
                  <i class="fa-solid fa-lock-open"></i>
                </div>
              <?php endif; ?>
              <?php if ($admin): ?>
                <?php if ($topic->getIs_Locked()): ?>
                  <a title="Unlock topic" class="admin-unlock" href="index.php?ctrl=topic&action=unlockTopicFromTopic&id=<?= $topic_id ?>">
                    <i class="fa-solid fa-unlock"></i>
                  </a>
                <?php else: ?>
                  <a title="Lock topic" class="admin-lock" href="index.php?ctrl=topic&action=lockTopicFromTopic&id=<?= $topic_id ?>">
                    <i class="fa-solid fa-lock"></i>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<!-- débugage -->
<?php
// if (isset($_SESSION['debug'])) {
//   echo "<pre>";
//   var_dump($_SESSION['debug']);
//   echo "</pre>";
// }
?>