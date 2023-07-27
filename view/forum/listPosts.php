<?php
// Vérifie si les données sont définies et les assigne aux variables, sinon assigne null
$posts = $result["data"]['posts'] ?? null;
$topic = $result["data"]['topic'] ?? null;

// Vérifie si l'utilisateur est défini et s'il a un rôle d'administrateur ou de modérateur
$admin = false;
if (isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ['admin', 'moderator'])) {
    $admin = true;
}
?>

<div class="post-container">
    <div class="post-header">
        <div class="post-header-left">
            <h2 class="post-category">
                <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$topic->getCategory()->getId()?>"><?=$topic->getCategory()->getCategoryLabel()?></a>
            </h2>
            <h1 class="post-title">/<?=$topic->getTitle()?></h1>
            <h2 class="post-topic-description">/<?=$topic->getTopic_description()?></h2>
        </div>
        <div class="post-header-right">
            <?php 
            // Si l'utilisateur est un administrateur
            if($admin){
                $action = $topic->getIs_Locked() == 0 ? 'lockTopicFromTopic' : 'unlockTopicFromTopic';
                $title = $topic->getIs_Locked() == 0 ? 'Lock topic' : 'Unlock topic';
                
                echo "<a title='{$title}' href='index.php?ctrl=topic&action={$action}&id={$topic->getId()}'>
                  <i class='icon {$title}'></i>
                </a>";
                
                // Vérifie si l'utilisateur actuel est le créateur du sujet
                if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $topic->getUser()->getId()){
                    echo "<a title='Delete topic' href='index.php?ctrl=topic&action=deleteTopic&id={$topic->getId()}'></a>";
                }
            }
            ?>
        </div>
    </div>

    <div class="forum-posts">
        <?php 
        // Si les publications sont définies
        if($posts){
            $countPost = 0;
            foreach($posts as $post){
                $countPost++;
                ?>
                <div class="post-card">
                    <div class="forum-post-header">
                        <div class="forum-post-header-left">
                            <a title="Check profile" href="index.php?ctrl=security&action=usersProfiles&id=<?= $post->getUser()->getId() ?>"><?= $post->getUser()->getNickname() ?></a>
                            <!-- Vérifie que la date de création du post n'est pas null avant de l'afficher -->
                            <?php if ($post->getPostCreationDate() !== null): ?>
                                <p class="post-date"><?= $post->getPostCreationDate()->format('Y-m-d H:i:s') ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="forum-post-header-right">
                            <?php
                            if($admin){
                                // Si ce n'est pas le premier post, affiche le bouton de suppression
                                if($countPost > 1){
                                    echo "<a href='index.php?ctrl=post&action=deletePost&id={$post->getId()}'><p title='Delete post'</p></a>";
                                }
                                echo "<a href='index.php?ctrl=post&action=linkToModifyPost&id={$post->getId()}'><p title='Modify post'</p></a>";
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

    <?php
    // Si le sujet n'est pas verrouillé, affiche le formulaire de réponse (à mettre dans un fichier newPost)
    if ($topic->getIs_Locked() == 0) { ?>
        <form class="form-add-topic" action="index.php?ctrl=post&action=addPostByTopic&id=<?= $topic->getId() ?>" method="POST">
            <label for="text">Answer</label>
            <textarea rows="5" name="text" id="text"></textarea>
            <input type="submit" name="submit" id="submit" value="Answer">
        </form>
    <?php } ?>
</div>
