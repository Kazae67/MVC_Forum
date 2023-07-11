<?php
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;

$admin = isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ["admin", "moderator"]);
?>

<div class="header-topic">
  <a title="Go back to categories" href="index.php?ctrl=category" class="button">Back to category list</a>
  <h3>Category: <?= $category->getCategoryLabel() ?></h3>
  <a title="Create a new topic" class="button" href="index.php?ctrl=topic&action=linkAddTopic&id=<?= $category->getId() ?>">NEW TOPIC</a>
</div>
