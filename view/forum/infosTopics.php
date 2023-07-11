<?php
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;
?>

<div class="header-infos-topics">
  <a href="index.php?ctrl=category" class="button">Back to the category list</a>
  <h3>Category: <?= $category->getCategoryLabel() ?></h3>
  <a class="button" href="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>

<?php if ($topics): ?>
  <div class="topic-container">
    <div class="topic-head">
        <span class="topic-author"></span>
      <span class="topic-object"></span>
      <span class="topic-date"></span>
    </div>
        <ul class="topic-list">
      <?php foreach ($topics as $topic): ?>
        <li class="infos-topic">
          <a href="index.php?ctrl=post&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
          <p class="<?= $topic->getUser()->getRole() === "normal" ? "user-name" : "user-name-red" ?>">
            <a href="index.php?ctrl=security&action=viewUsersProfiles&id=<?= $topic->getUser()->getId() ?>">
              <?= $topic->getUser()->getNickname() ?>
            </a>
          </p>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

