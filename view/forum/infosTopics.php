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
<?php endif; ?>

