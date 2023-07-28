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
  <table class="topic-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Creation date</th>
        <th>Number of posts</th>
        <th>Statut</th>
        <?php if ($admin || isset($_SESSION['user'])): ?>
          <th>Actions</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <!-- ID -->
      <?php foreach ($topics as $topic):?>
        <?php $topic_id = $topic->getId(); ?>
        <?php $isTopicAuthor = isset($_SESSION['user']) && $topic->getUser() !== null && $_SESSION['user']->getId() === $topic->getUser()->getId(); ?>
        <?php if ($isTopicAuthor): ?>
          <?php $authorLockAction = "author-lock"; ?>
          <?php $authorUnlockAction = "author-unlock"; ?>
          <?php $authorDeleteAction = "author-delete"; ?>
        <?php endif; ?>
        <tr class="<?= $topic->getIs_Locked() ? 'locked-topic' : '' ?>"> <!-- Ajoute la classe 'locked-topic' si le sujet est verrouillé -->
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
          <!-- NUMBER OF POSTS -->
          <td><?= $topic->getCountPost() ?></td>
          <!-- IS_LOCKED -->
          <td>
            <?php if ($topic->getIs_Locked()): ?>
              <i class="fa-solid fa-lock"></i>
            <?php else: ?>
              <i class="fa-solid fa-lock-open"></i>
            <?php endif; ?>
          </td>

          <!-- ACTIONS -->
          <?php if ($admin || $isTopicAuthor): ?>
            <td>
              <div class="container-admin">
                <?php if ($topic->getIs_Locked()): ?>
                  <?php if ($admin || $isTopicAuthor): ?>
                    <a title="Unlock topic" class="<?= $authorUnlockAction ?>" href="index.php?ctrl=topic&action=unlockTopicFromTopic&id=<?= $topic_id ?>">
                      <i class="fa-solid fa-unlock"></i>
                    </a>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if ($admin || $isTopicAuthor): ?>
                    <a title="Lock topic" class="<?= $authorLockAction ?>" href="index.php?ctrl=topic&action=lockTopicFromTopic&id=<?= $topic_id ?>">
                      <i class="fa-solid fa-lock"></i>
                    </a>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if ($admin || $isTopicAuthor): ?>
                  <a title="Delete topic" class="<?= $authorDeleteAction ?>" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic_id ?>">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                <?php endif; ?>
              </div>
            </td>
          <?php endif; ?>
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
