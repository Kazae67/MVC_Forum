<?php
// Récupération des données nécessaires
$topics = $result["data"]["topics"] ?? null;

$admin = isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ["admin", "moderator"]);
?>

<!-- Header avec le bouton de retour et le bouton pour créer un nouveau topic -->
<div class="header-topic">
  <a title="Go back to categories" href="index.php?ctrl=category" class="button">Back to category list</a>
  <h3>All Topics</h3>
  <a title="Create a new topic" class="button" href="index.php?ctrl=topic&action=newTopic">NEW TOPIC</a>
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
      <?php foreach ($topics as $topic):?>
        <?php $topic_id = $topic->getId(); ?> 
        <tr>
          <td><?= $topic_id ?></td>
          <td>
            <a title="View topic" href="index.php?ctrl=post&action=listPostByTopic&id=<?= $topic_id ?>">
              <?= $topic->getTitle() ?>
            </a>
          </td>
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
          <td>
            <div class="container-admin">
              <div title="<?= $topic->getIs_Locked() ? "Topic locked" : "Topic closed" ?>">
              </div>
            </div>
          </td>
          <!-- Options d'adminstrateur -->
          <?php if ($admin): ?>
            <td>
              <div class="container-admin">
                <a title="Lock topic" class="admin-lock" href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic_id ?>">
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