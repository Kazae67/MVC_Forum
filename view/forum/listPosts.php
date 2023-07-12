<?php
$posts = $result["data"]['posts'] ?? null;
$topic = $result["data"]['topic'] ?? null;
?>

<div class="post-container">
  <div class="post-header">
      <h2 class="post-category"><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$topic->getCategory()->getId()?>"><?=$topic->getCategory()->getCategoryLabel()?></a></h2>
      <h1 class="post-title">/<?=$topic->getTitle()?></h1>
    </div>
</div>