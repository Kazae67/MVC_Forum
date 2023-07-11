<?php
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;
?>

<div class="header-infos-topics">
  <a href="index.php?ctrl=category" class="button">Back to the category list</a>
  <h3>Category: <?= $category->getCategoryLabel() ?></h3>
  <a class="button" href="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>


