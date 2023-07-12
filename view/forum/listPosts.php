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
        $colorClass = $post->getUser()->getRole() == 'normal' ? 'user-name' : 'user-name-red';
        ?>
        
        <div class="post-card">
            <div class="post-header">
              <div class="post-header-left">
                  <a title="Check profile" href="index.php?ctrl=security&action=viewUsersProfiles&id=<?= $post->getUser()->getId() ?>"><?= $post->getUser()->getNickname() ?></a>
                </p>
                <p class="post-date"><?= $post->getPost_creation_date() ?></p>
              </div>
              <div class="post-header-right">
                <?php
                if($admin){

                  if($countPost > 1){
                    echo "<a href='index.php?ctrl=post&action=deletePost&id={$post->getId()}'><p title='delete post'</p></a>";
                  }

                  echo "<a href='index.php?ctrl=post&action=linkToModifyPost&id={$post->getId()}'><p title='modify post'</p></a>";
                }
                ?>
              </div>
            </div>
            <p class="post-text"><?= $post->getText() ?></p>
        </div>
        <?php
      }
    }
    ?>
  </div>


