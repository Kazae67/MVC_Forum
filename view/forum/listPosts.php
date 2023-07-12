<?php
$posts = $result["data"]['posts'] ?? null;
$topic = $result["data"]['topic'] ?? null;

$admin = false;

if (isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ['admin', 'moderator'])) {
    $admin = true;
}
?>
<div class="post-container">
  <div class="post-header">
      <h2 class="post-category"><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$topic->getCategory()->getId()?>"><?=$topic->getCategory()->getCategoryLabel()?></a></h2>
      <h1 class="post-title">/<?=$topic->getTitle()?></h1>
    </div>
<?php 
    if($admin){
    $action = $topic->getIs_Locked() == 0 ? 'lockTopicFromTopic' : 'lockTopicFromTopic';
    $title = $topic->getIs_Locked() == 0 ? 'Vérouiller le sujet' : 'Déverouiller le sujet';
    
    echo "<a title='{$title}' href='index.php?ctrl=topic&action={$action}&id={$topic->getId()}'></a>";
    
    if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $topic->getUser()->getId()){
        echo "<a title='delete topic' href='index.php?ctrl=topic&action=deleteTopic&id={$topic->getId()}'></a>";
    }
}
?>
</div>

<div class="forum-posts">
    <?php 
    if($posts){
      $countPost = 0;
      foreach($posts as $post){
        $countPost++;
        ?>

  </div>


